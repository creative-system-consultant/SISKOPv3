<?php

namespace App\Http\Traits;

use DB;

trait sendNotification
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
    **/

    public function sendWS($msg, $phone,$name,$icno)
    {
        $user_id    = "";
        //$cust       = $this->customer()->select("mobile_num","icno","name")->first();
        $phone_num  = $cust->mobile_num;
        $icno       = $cust->icno;
        $name       = $cust->name;
        $sql =  "EXEC [SISKOPv3b].[SYSTM].[SP_INSERT_MSG_QUEUE] ".
                "'896', ".                              // @user_id                     CHAR(5), 
                "'1001', ".                             // @exec_seq_no                 SMALLINT, 
                "'".now()."', ".                        // @rpt_date                    DATE,
                "'W', ".                                // @msg_type                    CHAR(1),
                "'L', ".                                // @msg_priority                CHAR(1),
                "'Financing Application Approved', ".   // @msg_purpose                 VARCHAR(50),
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
}
