<?php

namespace App\Models;

use App\Http\Traits\HasCoop;
use App\Http\Traits\HasCustomer;
use App\Http\Traits\HasFiles;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ApplyDividend extends Model implements Auditable
{
    use HasCoop;
    use HasCustomer;
    use HasFiles;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "SISKOP.APPLY_DIVIDEND";
    protected $guarded = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function approvals()
    {
        return $this->morphMany(Approval::class,'approval');
    }

    public function current_approval()
    {
        return $this->approvals()->where('order', $this->step)->first();
    }

    public function current_approval_role()
    {
        return CoopRoleGroup::find($this->current_approval()->group_id);
    }

    public function balance()
    {
        return $this->dividend_total - $this->total_apply();
    }

    public function total_apply()
    {
        return $this->div_cash_apply + $this->div_share_apply + $this->div_contri_apply;
    }

    public function total_approved()
    {
        return $this->div_cash_approved + $this->div_share_approved + $this->div_contri_approved;
    }

    public function remove_approvals()
    {
        $approval = $this->approvals;
        foreach ($approval as $key => $value) {
            $value->delete();
        }
        return true;
    }

    public function clear_approvals($order = NULL)
    {
        if ($order != NULL){
            $approval = $this->approvals()->where('order', $order)->get();
        } else {
            $approval = $this->approvals;
        }

        foreach ($approval as $key => $value) {
            if ($value->role_id == 1 || $value->role_id == 2){ 
                $value->user_id = NULL; 
                $value->type    = NULL;
            }
            $value->note = NULL;
            $value->vote = NULL;
        }
    }

    public function make_approvals()
    {
        $CoopApproval = CoopApproval::where([['approval_type', 'apply_dividend'],['coop_id',$this->coop_id]])->first();
        if ($CoopApproval != NULL){
            $CoopApprovalRoles = CoopApprovalRole::where([['coop_id', $this->coop_id],['approval_id', $CoopApproval->id]])->orderBy('order')->get();
        } else {
            return NULL;
        }

        $count = 1;
        foreach ($CoopApprovalRoles as $key => $value) {

            if ($value->sys_role->name == 'APPROVER' || $value->sys_role->name == 'COMMITTEE'){
                foreach ($value->rolegroup->users as $key1 => $value1){
                    $approval = $this->approvals()->firstOrCreate(['order' => $count,'type' => 'vote'.$key1+1]);
                    $approval->group_id = $value->role_id;
                    $approval->rules    = $value->rules;
                    $approval->user_id  = $value1->user_id;
                    $approval->role_id  = $value->sys_role->id;
                    $approval->type     = 'vote'.$key1+1;
                    $approval->note     = NULL;
                    $approval->vote     = NULL;
                    $approval->save();
                }
            } else {

                $approval = $this->approvals()->firstOrCreate(['order' => $count]);
                $approval->group_id = $value->role_id;
                $approval->rules    = $value->rules;
                $approval->user_id  = NULL;
                $approval->role_id  = $value->sys_role->id;
                $approval->type     = NULL;
                $approval->note     = NULL;
                $approval->vote     = NULL;
                $approval->save();

                $count++;
            }
        }

        return '';
    }

    public function approval_vote_id($type = 3)
    {
        return explode(',',$this->approvals()->where([['order', $this->step],['role_id',$type]])->select('user_id')->get()->implode('user_id',','));
    }

    public function approval_unvoted_id($type = 3)
    {
        return explode(',',$this->approvals()->where([['order', $this->step],['vote', NULL],['role_id',$type]])->select('user_id')->get()->implode('user_id',','));
    }

    public function count_vote($type = 3)
    {
        return $this->approvals()->whereNotNull('vote')->where('role_id', $type)->count();
    }

    public function count_unvote($type = 3)
    {
        return $this->approvals()->whereNull('vote')->where('role_id', $type)->count();
    }

    public function vote_result($type = 3)
    {
        return $this->count_approved($type) >= $this->count_refuse($type) ? TRUE : FALSE;
    }

    public function count_approved($type = 3)
    {
        return $this->approvals()->where([['vote','lulus'],['role_id', $type]])->count();
    }

    public function count_refuse($type = 3)
    {
        return $this->approvals()->where([['vote','gagal'],['role_id', $type]])->count();
    }

    public function sendWS($msg)
    {
        /**
         *  Parameter to program.
         *  @user_id                     - ID used to logged in to system
         *  @exec_seq_no                 - default 1001
         *  @rpt_date                    - operation date
         *  @msg_type                    - follow below definition
         *          Message Type (@msg_type) :
         *              W-Whatsapp only
         *              S-SMS only
         *              E-Email only
         *              A-Email, SMS and Whatsapp
         *              B-Email and SMS
         *              C-Email and Whatsapp
         *              D-Whatsapp and SMS
         *  @msg_priority                - H-High / M-Medium / L-Low
         *  @msg_purpose                 - free text describing purpose of message
         *  @email                            - customer email
         *  @phone                            - customer phone number
         *  @cif_no                           - CIF
         *  @generic_key                 - any key about this message, it could be Account No, IC No, SAG No. etc
         *  @notice_msg_email_subject         - email subject
         *  @notice_msg_email            - contents of the email
         *  @notice_msg_wasap            - contents of the whatsapp
         *  @notice_msg_sms              - contents of the SMS
         *  @cust_name                   - customer name
         *  @cust_id_no                  - customer identity no  
         * 
         * **/
        $user_id    = "";
        $cust       = $this->customer()->select("mobile_num","icno","name")->first();
        $phone_num  = $cust->mobile_num;
        $icno       = $cust->icno;
        $name       = $cust->name;
        $sql =  "EXEC [SISKOP].[SYSTM].[SP_INSERT_MSG_QUEUE] ".
                "'896', ".                              // @user_id                     CHAR(5), 
                "'1001', ".                             // @exec_seq_no                 SMALLINT, 
                "'".now()."', ".                        // @rpt_date                    DATE,
                "'W', ".                                // @msg_type                    CHAR(1),
                "'L', ".                                // @msg_priority                CHAR(1),
                "'Divident Application Approved', ".    // @msg_purpose                 VARCHAR(50),
                "'', ".                                 // @email                       VARCHAR(100),
                "'".$phone_num."', ".                   // @phone                       VARCHAR(20),
                "'1', ".                                // @cif_no                      VARCHAR(15),
                "'".$icno."', ".                        // @generic_key                 VARCHAR(17),
                "'', ".                                 // @notice_msg_email_subject    VARCHAR(200),
                "'', ".                                 // @notice_msg_email            VARCHAR(2000),
                "'".$msg."', ".                         // @notice_msg_wasap            VARCHAR(2000),
                "'', ".                                 // @notice_msg_sms              VARCHAR(2000),
                "'".$name."', ".                        // @cust_name                   VARCHAR(100),
                "'".$icno."'";                          // @cust_id_no                  VARCHAR(20)
        DB::select(DB::raw($sql));
    }

    public function sendSMS($msg)
    {
        /**
         *  Parameter to program.
         *  @user_id                     - ID used to logged in to system
         *  @exec_seq_no                 - default 1001
         *  @rpt_date                    - operation date
         *  @msg_type                    - follow below definition
         *          Message Type (@msg_type) :
         *              W-Whatsapp only
         *              S-SMS only
         *              E-Email only
         *              A-Email, SMS and Whatsapp
         *              B-Email and SMS
         *              C-Email and Whatsapp
         *              D-Whatsapp and SMS
         *  @msg_priority                - H-High / M-Medium / L-Low
         *  @msg_purpose                 - free text describing purpose of message
         *  @email                            - customer email
         *  @phone                            - customer phone number
         *  @cif_no                           - CIF
         *  @generic_key                 - any key about this message, it could be Account No, IC No, SAG No. etc
         *  @notice_msg_email_subject         - email subject
         *  @notice_msg_email            - contents of the email
         *  @notice_msg_wasap            - contents of the whatsapp
         *  @notice_msg_sms              - contents of the SMS
         *  @cust_name                   - customer name
         *  @cust_id_no                  - customer identity no  
         * 
         * **/
        $user_id    = "";
        $cust       = $this->customer()->select("mobile_num","icno","name")->first();
        $phone_num  = $cust->mobile_num;
        $icno       = $cust->icno;
        $name       = $cust->name;
        $sql =  "EXEC [SISKOP].[SYSTM].[SP_INSERT_MSG_QUEUE] ".
                "'896', ".                              // @user_id                     CHAR(5), 
                "'1001', ".                             // @exec_seq_no                 SMALLINT, 
                "'".now()."', ".                        // @rpt_date                    DATE,
                "'S', ".                                // @msg_type                    CHAR(1),
                "'L', ".                                // @msg_priority                CHAR(1),
                "'Divident Application Approved', ".    // @msg_purpose                 VARCHAR(50),
                "'', ".                                 // @email                       VARCHAR(100),
                "'".$phone_num."', ".                   // @phone                       VARCHAR(20),
                "'1', ".                                // @cif_no                      VARCHAR(15),
                "'".$icno."', ".                        // @generic_key                 VARCHAR(17),
                "'', ".                                 // @notice_msg_email_subject    VARCHAR(200),
                "'', ".                                 // @notice_msg_email            VARCHAR(2000),
                "'', ".                                 // @notice_msg_wasap            VARCHAR(2000),
                "'".$msg."', ".                         // @notice_msg_sms              VARCHAR(2000),
                "'".$name."', ".                        // @cust_name                   VARCHAR(100),
                "'".$icno."'";                          // @cust_id_no                  VARCHAR(20)
        DB::select(DB::raw($sql));
    }

    public function sendEmail($subject,$msg)
    {
        /**
         *  Parameter to program.
         *  @user_id                     - ID used to logged in to system
         *  @exec_seq_no                 - default 1001
         *  @rpt_date                    - operation date
         *  @msg_type                    - follow below definition
         *          Message Type (@msg_type) :
         *              W-Whatsapp only
         *              S-SMS only
         *              E-Email only
         *              A-Email, SMS and Whatsapp
         *              B-Email and SMS
         *              C-Email and Whatsapp
         *              D-Whatsapp and SMS
         *  @msg_priority                - H-High / M-Medium / L-Low
         *  @msg_purpose                 - free text describing purpose of message
         *  @email                            - customer email
         *  @phone                            - customer phone number
         *  @cif_no                           - CIF
         *  @generic_key                 - any key about this message, it could be Account No, IC No, SAG No. etc
         *  @notice_msg_email_subject         - email subject
         *  @notice_msg_email            - contents of the email
         *  @notice_msg_wasap            - contents of the whatsapp
         *  @notice_msg_sms              - contents of the SMS
         *  @cust_name                   - customer name
         *  @cust_id_no                  - customer identity no  
         * 
         * **/
        $user_id    = "";
        $cust       = $this->customer()->select("email","icno","name")->first();
        $email      = $cust->email;
        $icno       = $cust->icno;
        $name       = $cust->name;
        $sql =  "EXEC [SISKOP].[SYSTM].[SP_INSERT_MSG_QUEUE] ".
                "'896', ".                              // @user_id                     CHAR(5), 
                "'1001', ".                             // @exec_seq_no                 SMALLINT, 
                "'".now()."', ".                        // @rpt_date                    DATE,
                "'E', ".                                // @msg_type                    CHAR(1),
                "'L', ".                                // @msg_priority                CHAR(1),
                "'Divident Application Approved', ".    // @msg_purpose                 VARCHAR(50),
                "'".$email."', ".                       // @email                       VARCHAR(100),
                "'', ".                                 // @phone                       VARCHAR(20),
                "'1', ".                                // @cif_no                      VARCHAR(15),
                "'".$icno."', ".                        // @generic_key                 VARCHAR(17),
                "'".$subject."', ".                     // @notice_msg_email_subject    VARCHAR(200),
                "'".$msg."', ".                         // @notice_msg_email            VARCHAR(2000),
                "'', ".                                 // @notice_msg_wasap            VARCHAR(2000),
                "'', ".                                 // @notice_msg_sms              VARCHAR(2000),
                "'".$name."', ".                        // @cust_name                   VARCHAR(100),
                "'".$icno."'";                          // @cust_id_no                  VARCHAR(20)
        DB::select(DB::raw($sql));
    }

}