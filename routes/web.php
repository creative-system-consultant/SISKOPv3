<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\RedirectController;
use App\Http\Livewire\Page\Admin\Maintenance\Bank\BankList;
use App\Http\Livewire\Page\Admin\Maintenance\Bank\BankCreate;
use App\Http\Livewire\Page\Admin\Maintenance\Bank\BankEdit;
use App\Http\Livewire\Page\Admin\Maintenance\Country\CountryList;
use App\Http\Livewire\Page\Admin\Maintenance\Country\CountryCreate;
use App\Http\Livewire\Page\Admin\Maintenance\Country\CountryEdit;
use App\Http\Livewire\Page\Admin\Maintenance\Education\EducationList;
use App\Http\Livewire\Page\Admin\Maintenance\Education\EducationCreate;
use App\Http\Livewire\Page\Admin\Maintenance\Education\EducationEdit;
use App\Http\Livewire\Page\Admin\Maintenance\Gender\GenderList;
use App\Http\Livewire\Page\Admin\Maintenance\Gender\GenderCreate;
use App\Http\Livewire\Page\Admin\Maintenance\Gender\GenderEdit;
use App\Http\Livewire\Page\Admin\Maintenance\Marital\MaritalList;
use App\Http\Livewire\Page\Admin\Maintenance\Marital\MaritalCreate;
use App\Http\Livewire\Page\Admin\Maintenance\Marital\MaritalEdit;
use App\Http\Livewire\Page\Admin\Maintenance\Race\RaceList;
use App\Http\Livewire\Page\Admin\Maintenance\Race\RaceCreate;
use App\Http\Livewire\Page\Admin\Maintenance\Race\RaceEdit;
use App\Http\Livewire\Page\Admin\Maintenance\Religion\ReligionList;
use App\Http\Livewire\Page\Admin\Maintenance\Religion\ReligionCreate;
use App\Http\Livewire\Page\Admin\Maintenance\Religion\ReligionEdit;
use App\Http\Livewire\Page\Admin\Maintenance\State\StateList;
use App\Http\Livewire\Page\Admin\Maintenance\State\StateCreate;
use App\Http\Livewire\Page\Admin\Maintenance\State\StateEdit;
use App\Http\Livewire\Page\Admin\Maintenance\Title\TitleList;
use App\Http\Livewire\Page\Admin\Maintenance\Title\TitleCreate;
use App\Http\Livewire\Page\Admin\Maintenance\Title\TitleEdit;
use App\Http\Livewire\Page\Admin\Maintenance\Relationship\RelationshipList;
use App\Http\Livewire\Page\Admin\Maintenance\Relationship\RelationshipCreate;
use App\Http\Livewire\Page\Admin\Maintenance\Relationship\RelationshipEdit;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\RetrieveAccount;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\ComponentDoc;
use App\Http\Livewire\Page\Admin\coop\coopAdmin;
use App\Http\Livewire\Page\Admin\Coop\CoopCreate;
use App\Http\Livewire\Page\Admin\Customer\CustomerCoop;
use App\Http\Livewire\Page\Admin\Maintenance\AddMaintenance;
use App\Http\Livewire\Page\Admin\Maintenance\EditMaintenance;
use App\Http\Livewire\Page\Admin\Maintenance\ListMaintenance;
use App\Http\Livewire\Page\Admin\Role\RoleGroupCreate;
use App\Http\Livewire\Page\Admin\Role\RoleGroupManagement;
use App\Http\Livewire\Page\Admin\SpecialAid\CreateSpecialAid;
use App\Http\Livewire\Page\Admin\SpecialAid\EditSpecialAid;
use App\Http\Livewire\Page\Admin\SpecialAid\ListSpecialAid;
use App\Http\Livewire\Page\Application\ApplicationList\Contribution;
use App\Http\Livewire\Page\Application\ApplicationList\Sell_ExchangeShare;
use App\Http\Livewire\Page\Application\ApplicationList\Share;
use App\Http\Livewire\Page\Application\ApplicationList\SpecialAid;
use App\Http\Livewire\Page\Application\ApplicationList\Withdrawal_Contribution;
use App\Http\Livewire\Page\Application\ApplySpecialAid\Apply_SpecialAid;
use App\Http\Livewire\Page\Home;
use App\Http\Livewire\Page\Profile\Index;
use App\Http\Livewire\Page\Reporting\ListReport;
use App\Http\Livewire\Page\Reporting\UserReporting;
use App\Http\Livewire\Page\Executive\Customer\SearchCustomer;
use App\Http\Livewire\Page\Executive\Customer\EditCustomer;
use App\Http\Livewire\Page\Application\ApplyContribution\Apply_Contribution;
use App\Http\Livewire\Page\Application\ApplySellExchangeShare\Apply_Sell_ExchangeShare;
use App\Http\Livewire\Page\Application\ApplyShare\Apply_Share;
use App\Http\Livewire\Page\Application\ApplyWithdrawContribution\Apply_WithdrawContribution;
use App\Http\Livewire\Page\Executive\Approval\Contribution\ContributionApproval;
use App\Http\Livewire\Page\Executive\Approval\Contribution\ContributionChecker;
use App\Http\Livewire\Page\Executive\Approval\Contribution\ContributionCommittee;
use App\Http\Livewire\Page\Executive\Approval\Contribution\ContributionMaker;
use App\Http\Livewire\Page\Executive\Approval\SellShare\SellShareApproval;
use App\Http\Livewire\Page\Executive\Approval\SellShare\SellShareChecker;
use App\Http\Livewire\Page\Executive\Approval\SellShare\SellShareCommittee;
use App\Http\Livewire\Page\Executive\Approval\SellShare\SellShareMaker;
use App\Http\Livewire\Page\Executive\Approval\Share\ShareApproval;
use App\Http\Livewire\Page\Executive\Approval\Share\ShareChecker;
use App\Http\Livewire\Page\Executive\Approval\Share\ShareCommittee;
use App\Http\Livewire\Page\Executive\Approval\Share\ShareMaker;
use App\Http\Livewire\Page\Executive\Approval\SpecialAid\SpecialAidApproval;
use App\Http\Livewire\Page\Executive\Approval\SpecialAid\SpecialAidChecker;
use App\Http\Livewire\Page\Executive\Approval\SpecialAid\SpecialAidCommittee;
use App\Http\Livewire\Page\Executive\Approval\SpecialAid\SpecialAidMaker;
use App\Http\Livewire\Page\Executive\Approval\WithdrawContribution\WithdrawalContributionApproval;
use App\Http\Livewire\Page\Executive\Approval\WithdrawContribution\WithdrawalContributionChecker;
use App\Http\Livewire\Page\Executive\Approval\WithdrawContribution\WithdrawalContributionCommittee;
use App\Http\Livewire\Page\Executive\Approval\WithdrawContribution\WithdrawalContributionMaker;
use App\Http\Livewire\Page\Notification\notification;
use App\Http\Livewire\Page\Financing\Apply_Financing;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [RedirectController::class,'index']);

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});

Route::get('password/reset', Email::class)->name('password.request');
Route::get('password/reset/{token}', Reset::class)->name('password.reset');
Route::get('retrieve-account', RetrieveAccount::class)->name('retrieve-account');

//----------------------------- page routes -------------------------------//
Route::middleware('auth')->group(function () {
    Route::get('home', Home::class)->name('home');

    //------------------------ Auth ------------------------------//
    Route::get('email/verify', Verify::class)->middleware('throttle:6,1')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)->middleware('signed')->name('verification.verify');
    Route::get('password/confirm', Confirm::class)->name('password.confirm');
    Route::post('logout', LogoutController::class)->name('logout');

    //profile
    Route::get('profile', Index::class)->name('profile');
    Route::get('Index', Index::class)->name('Index');

    //--------------------------------- Notification ---------------------------------//
    Route::get('/notification', notification::class)->name('notification');
    //------------------------------- End Notification -------------------------------//


    //------------------------------- Applications -------------------------------//
    //Applications > Special Aid
    Route::get('/applySpecialAid', Apply_SpecialAid::class)->name('special-aid.apply');

    //Applications > Add Share
    Route::get('/applyShare', Apply_Share::class)->name('share.apply');

    //Applications > Sell/Exchange Share
    Route::get('/applySellShare', Apply_Sell_ExchangeShare::class)->name('share.sell');

    //Application > Add Contribution
    Route::get('/applyContribution', Apply_Contribution::class)->name('contribution.apply');

    //Application > W/D Contribution
    Route::get('/withdrawContribution', Apply_WithdrawContribution::class)->name('contribution.withdraw');
    //------------------------------- End Applications ---------------------------//


    //------------------------ admin ------------------------------//
    //Admin > Role > Role Group
    Route::prefix('User')->group(function(){
        Route::get('RoleGroup', RoleGroupManagement::class)->name('user.rolegroup');
        Route::get('CreateGroup', RoleGroupCreate::class)->name('user.creategroup');
        Route::get('EditGroup/{uuid}', RoleGroupCreate::class)->name('user.editgroup');
    });


    Route::prefix('admin/maintenance')->group(function(){
        //Admin > Maintenance > Special Aid
        Route::prefix('specialAid')->group(function(){
            Route::get('/', ListSpecialAid::class)->name('special_aid.list');
            Route::get('create', CreateSpecialAid::class)->name('special_aid.create');
            Route::get('edit/{uuid}', EditSpecialAid::class)->name('special_aid.edit');
        });
        Route::prefix('coop')->group(function(){
            Route::get('/', CoopAdmin::class)->name('coop.list');
            Route::get('create', CoopCreate::class)->name('coop.create');
            Route::get('edit/{coop_id}', CoopCreate::class)->name('coop.edit');
        });
        Route::prefix('CustCoop')->group(function(){
            Route::get('/', CustomerCoop::class)->name('coop.cust');
        });

        //Admin > Maintenance > sample
        Route::get('list-maintenance', ListMaintenance::class)->name('list-maintenance');
        Route::get('add-maintenance', AddMaintenance::class)->name('add-maintenance');
        Route::get('edit-maintenance/{id}', EditMaintenance::class)->name('edit-maintenance');

        //Admin > Maintenance > Bank
        Route::prefix('bank')->group(function(){
            Route::get('/', BankList::class)->name('bank.list');
            Route::get('create', BankCreate::class)->name('bank.create');
            Route::get('edit/{id}', BankEdit::class)->name('bank.edit');
        });

        //Admin > Maintenance > Education
        Route::prefix('education')->group(function(){
            Route::get('/', EducationList::class)->name('education.list');
            Route::get('create', EducationCreate::class)->name('education.create');
            Route::get('edit/{id}', EducationEdit::class)->name('education.edit');
        });

        //Admin > Maintenance > Country
        Route::prefix('country')->group(function(){
            Route::get('/', CountryList::class)->name('country.list');
            Route::get('create', CountryCreate::class)->name('country.create');
            Route::get('edit/{id}', CountryEdit::class)->name('country.edit');
        });

        //Admin > Maintenance >  cust_title
        Route::prefix('title')->group(function(){
            Route::get('/', TitleList::class)->name('title.list');
            Route::get('create', TitleCreate::class)->name('title.create');
            Route::get('edit/{id}', TitleEdit::class)->name('title.edit');
        });

        //Admin > Maintenance > race
        Route::prefix('race')->group(function(){
            Route::get('/', RaceList::class)->name('race.list');
            Route::get('create', RaceCreate::class)->name('race.create');
            Route::get('edit/{id}', RaceEdit::class)->name('race.edit');
        });

        //Admin > Maintenance > Religion
        Route::prefix('religion')->group(function(){
            Route::get('/', ReligionList::class)->name('religion.list');
            Route::get('create', ReligionCreate::class)->name('religion.create');
            Route::get('edit/{id}', ReligionEdit::class)->name('religion.edit');
        });

        //Admin > Maintenance > State
        Route::prefix('state')->group(function(){
            Route::get('/', StateList::class)->name('state.list');
            Route::get('create', StateCreate::class)->name('state.create');
            Route::get('edit/{id}', StateEdit::class)->name('state.edit');
         });

        //Admin > Maintenance > Gender
        Route::prefix('gender')->group(function(){
            Route::get('/', GenderList::class)->name('gender.list');
            Route::get('create', GenderCreate::class)->name('gender.create');
            Route::get('edit/{id}', GenderEdit::class)->name('gender.edit');
        });

        //Admin > Maintenance > Relationship
        Route::prefix('relationship')->group(function(){
            Route::get('/', RelationshipList::class)->name('relationship.list');
            Route::get('create', RelationshipCreate::class)->name('relationship.create');
            Route::get('edit/{id}', RelationshipEdit::class)->name('relationship.edit');
         });

        //Admin > Maintenance > Marital
        Route::prefix('marital')->group(function(){
            Route::get('/', MaritalList::class)->name('marital.list');
            Route::get('create', MaritalCreate::class)->name('marital.create');
            Route::get('edit/{id}', MaritalEdit::class)->name('marital.edit');
        });
        
    });
    //----------------------- end Admin -------------------------------------//


    //----------------------- Executive -------------------------------------//
    Route::prefix('exec')->group(function(){
        //Exec > edit customer
        Route::prefix('/editcustomer')->group(function(){
            Route::get('search', SearchCustomer::class)->name('customer.search');
            Route::get('edit/{uuid}', EditCustomer::class)->name('customer.edit');
        });
    
        //Exec > Application List
        Route::prefix('applicationList')->group(function(){
            Route::get('/', function(){
                return view('livewire.page.application.application-list.application-list');
            })->name('application.list');

            Route::get('/specialAid/{uuid}', [SpecialAid::class, 'showApplication'])->name('application.specialAid');

            Route::get('/share/{uuid}', [Share::class, 'showApplication'])->name('application.share');

            Route::get('/sellShare/{uuid}', [Sell_ExchangeShare::class, 'showApplication'])->name('application.sell');

            Route::get('/addContribution/{uuid}', [Contribution::class, 'showApplication'])->name('application.contribution');

            Route::get('/withdrawContribution/{uuid}', [Withdrawal_Contribution::class, 'showApplication'])->name('application.withdrawal');
        }); 

        Route::prefix('approval')->group(function(){
            //Exec > approval > specialAid
            Route::prefix('specialAid')->group(function(){
                Route::get('maker/{uuid}', SpecialAidMaker::class)->name('specialAid.maker');
                Route::get('checker/{uuid}', SpecialAidChecker::class)->name('specialAid.checker');
                Route::get('committee/{uuid}', SpecialAidCommittee::class)->name('specialAid.committee');
                Route::get('approval/{uuid}', SpecialAidApproval::class)->name('specialAid.approval');
            });

            //Exec > approval > share
            Route::prefix('share')->group(function(){
                Route::get('maker/{uuid}', ShareMaker::class)->name('share.maker');
                Route::get('checker/{uuid}', ShareChecker::class)->name('share.checker');
                Route::get('committee/{uuid}', ShareCommittee::class)->name('share.committee');
                Route::get('approval/{uuid}', ShareApproval::class)->name('share.approval');
            });

            //Exec > approval > sell/exchange share
            Route::prefix('sellShare')->group(function(){
                Route::get('maker/{uuid}', SellShareMaker::class)->name('sellShare.maker');
                Route::get('checker/{uuid}', SellShareChecker::class)->name('sellShare.checker');
                Route::get('committee/{uuid}', SellShareCommittee::class)->name('sellShare.committee');
                Route::get('approval/{uuid}', SellShareApproval::class)->name('sellShare.approval');
            });

            Route::prefix('contribution')->group(function(){
                Route::get('maker/{uuid}', ContributionMaker::class)->name('contribution.maker');
                Route::get('checker/{uuid}', ContributionChecker::class)->name('contribution.checker');
                Route::get('committee/{uuid}', ContributionCommittee::class)->name('contribution.committee');
                Route::get('approval/{uuid}', ContributionApproval::class)->name('contribution.approval');
            });

            Route::prefix('withdrawContribution')->group(function(){
                Route::get('maker/{uuid}', WithdrawalContributionMaker::class)->name('withdrawal.maker');
                Route::get('checker/{uuid}', WithdrawalContributionChecker::class)->name('withdrawal.checker');
                Route::get('committee/{uuid}', WithdrawalContributionCommittee::class)->name('withdrawal.committee');
                Route::get('approval/{uuid}', WithdrawalContributionApproval::class)->name('withdrawal.approval');
            }); 
        });

    });
    //----------------------- End Executive --------------------------------//

    //Financing > Apply

    Route::get('/applyFinancing', Apply_Financing::class)->name('financing.apply');

    //----------------------- Reporting ------------------------------------//
    //Report > Sample
    Route::get('list-reporting', ListReport::class)->name('list-reporting');
    Route::get('user-reporting', UserReporting::class)->name('user-reporting');
    //----------------------- End Reporting --------------------------------//

});

//-------------- component doc -------------------//
Route::get('doc', ComponentDoc::class)->name('doc');
