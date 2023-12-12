<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\RedirectController;
use App\Http\Livewire\ComponentDoc;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\RetrieveAccount;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\Page\Admin\Approval\ApprovalAdmin;
use App\Http\Livewire\Page\Admin\Approval\Financing as ApprovalFinancing;
use App\Http\Livewire\Page\Admin\coop\ClientAdmin;
use App\Http\Livewire\Page\Admin\Coop\ClientCreate;
use App\Http\Livewire\Page\Admin\Customer\CustomerCoop;
use App\Http\Livewire\Page\Admin\Maintenance\AddMaintenance;
use App\Http\Livewire\Page\Admin\Maintenance\EditMaintenance;
use App\Http\Livewire\Page\Admin\Maintenance\ListMaintenance;
use App\Http\Livewire\Page\Admin\Maintenance\Bank\BankList;
use App\Http\Livewire\Page\Admin\Maintenance\Bank\BankCreate;
use App\Http\Livewire\Page\Admin\Maintenance\Bank\BankEdit;
use App\Http\Livewire\Page\Admin\Maintenance\Country\CountryList;
use App\Http\Livewire\Page\Admin\Maintenance\Country\CountryCreate;
use App\Http\Livewire\Page\Admin\Maintenance\Country\CountryEdit;
use App\Http\Livewire\Page\Admin\Maintenance\Education\EducationList;
use App\Http\Livewire\Page\Admin\Maintenance\Education\EducationCreate;
use App\Http\Livewire\Page\Admin\Maintenance\Education\EducationEdit;
use App\Http\Livewire\Page\Admin\Maintenance\Financing\CalculationTypeList;
use App\Http\Livewire\Page\Admin\Maintenance\Financing\CalculationTypeCreate;
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
use App\Http\Livewire\Page\Admin\Membership\MembershipAdmin;
use App\Http\Livewire\Page\Admin\Product\ProductList;
use App\Http\Livewire\Page\Admin\Product\ProductCreate;
use App\Http\Livewire\Page\Admin\Product\ProductEdit;
use App\Http\Livewire\Page\Admin\Role\RoleGroupCreate;
use App\Http\Livewire\Page\Admin\Role\RoleGroupManagement;
use App\Http\Livewire\Page\Admin\SpecialAid\CreateSpecialAid;
use App\Http\Livewire\Page\Admin\SpecialAid\ListSpecialAid;
use App\Http\Livewire\Page\Application\ApplicationList\Contribution;
use App\Http\Livewire\Page\Application\ApplicationList\SellExchangeShare;
use App\Http\Livewire\Page\Application\ApplicationList\Share;
use App\Http\Livewire\Page\Application\ApplicationList\SpecialAid;
use App\Http\Livewire\Page\Application\ApplicationList\WithdrawalContribution;
use App\Http\Livewire\Page\Application\ApplySpecialAid\ApplySpecialAid;
use App\Http\Livewire\Page\Application\Membership\NewMembership;
use App\Http\Livewire\Page\Home;
use App\Http\Livewire\Page\Profile\Index;
use App\Http\Livewire\Page\Reporting\ListReport;
use App\Http\Livewire\Page\Reporting\UserReporting;
use App\Http\Livewire\Page\Executive\Customer\SearchCustomer;
use App\Http\Livewire\Page\Executive\Customer\EditCustomer;
use App\Http\Livewire\Page\Application\ApplyContribution\ApplyContribution;
use App\Http\Livewire\Page\Application\ApplySellExchangeShare\ApplySellExchangeShare;
use App\Http\Livewire\Page\Application\ApplyShare\ApplyShare;
use App\Http\Livewire\Page\Application\ApplyWithdrawContribution\ApplyWithdrawContribution;
use App\Http\Livewire\Page\Executive\Approval\Contribution\ContributionApproval;
use App\Http\Livewire\Page\Executive\Approval\Contribution\ContributionChecker;
use App\Http\Livewire\Page\Executive\Approval\Contribution\ContributionCommittee;
use App\Http\Livewire\Page\Executive\Approval\Contribution\ContributionMaker;
use App\Http\Livewire\Page\Executive\Approval\Membership\Maker as MembershipMaker;
use App\Http\Livewire\Page\Executive\Approval\Membership\Checker as MembershipChecker;
use App\Http\Livewire\Page\Executive\Approval\Membership\Committee as MembershipCommittee;
use App\Http\Livewire\Page\Executive\Approval\Membership\Approver as MembershipApprover;
use App\Http\Livewire\Page\Executive\Approval\Membership\Resolution as MembershipResolution;
use App\Http\Livewire\Page\Executive\Approval\BuyShare\Approver as ShareApprover;
use App\Http\Livewire\Page\Executive\Approval\BuyShare\Checker as ShareChecker;
use App\Http\Livewire\Page\Executive\Approval\BuyShare\Committee as ShareCommittee;
use App\Http\Livewire\Page\Executive\Approval\BuyShare\Maker as ShareMaker;
use App\Http\Livewire\Page\Executive\Approval\BuyShare\Resolution as ShareResolution;
use App\Http\Livewire\Page\Executive\Approval\SellShare\SellShareApproval;
use App\Http\Livewire\Page\Executive\Approval\SellShare\SellShareChecker;
use App\Http\Livewire\Page\Executive\Approval\SellShare\SellShareCommittee;
use App\Http\Livewire\Page\Executive\Approval\SellShare\SellShareMaker;
use App\Http\Livewire\Page\Executive\Approval\SpecialAid\SpecialAidApproval;
use App\Http\Livewire\Page\Executive\Approval\SpecialAid\SpecialAidChecker;
use App\Http\Livewire\Page\Executive\Approval\SpecialAid\SpecialAidCommittee;
use App\Http\Livewire\Page\Executive\Approval\SpecialAid\SpecialAidMaker;
use App\Http\Livewire\Page\Executive\Approval\WithdrawContribution\WithdrawalContributionApproval;
use App\Http\Livewire\Page\Executive\Approval\WithdrawContribution\WithdrawalContributionChecker;
use App\Http\Livewire\Page\Executive\Approval\WithdrawContribution\WithdrawalContributionCommittee;
use App\Http\Livewire\Page\Executive\Approval\WithdrawContribution\WithdrawalContributionMaker;
use App\Http\Livewire\Page\Notification\notification;
use App\Http\Livewire\Page\Application\ApplyFinancing\ApplyFinancing;
use App\Http\Livewire\Page\Application\ApplyFinancing\FinancingList;
use App\Http\Livewire\Page\Application\Dividend\ApplyDividend;
use App\Http\Livewire\Page\Dashboard\Guest;
use App\Http\Livewire\Page\Executive\Approval\Dividend\DividendApprover;
use App\Http\Livewire\Page\Executive\Approval\Dividend\DividendMaker;
use App\Http\Livewire\Page\Executive\Approval\Dividend\DividendChecker;
use App\Http\Livewire\Page\Executive\Approval\Dividend\DividendCommittee;
use App\Http\Livewire\Page\Executive\Approval\Financing\FinancingApprover;
use App\Http\Livewire\Page\Executive\Approval\Financing\FinancingMaker;
use App\Http\Livewire\Page\Executive\Approval\Financing\FinancingChecker;
use App\Http\Livewire\Page\Executive\Approval\Financing\FinancingCommittee;
use App\Http\Livewire\Page\Executive\Approval\Financing\FinancingResolution;
use App\Http\Livewire\Page\User\Application\Lists;
use App\Http\Livewire\Page\User\Application\Membership\MembershipStatus;

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

Route::get('res/php-info8', function(){
    phpinfo();
});

// webhook from CSC-CA to clear cache on roles/user management update
Route::post('/webhook/clear-cache', function () {
    Artisan::call('cache:clear');
    return response('Cache Cleared', 200);
});

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});

Route::get('password/reset', Email::class)->name('password.request');
Route::get('password/reset/{token}', Reset::class)->name('password.reset');
Route::get('retrieve-account', RetrieveAccount::class)->name('retrieve-account');

Route::middleware(['auth'])->group(function () {
    Route::get('dash/guest', Guest::class)->name('dash.guest');

    //------------------------ Auth ------------------------------//
    Route::get('email/verify', Verify::class)->middleware('throttle:6,1')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)->middleware('signed')->name('verification.verify');
    Route::get('password/confirm', Confirm::class)->name('password.confirm');

    Route::post('logout', LogoutController::class)->name('logout');
    Route::get('logout', LogoutController::class)->name('logouts');

    //profile
    Route::get('profile', Index::class)->name('profile');
    Route::get('Index', Index::class)->name('Index');
});

//----------------------------- page routes -------------------------------//
Route::middleware(['auth','mustselectclient'])->group(function () {
    Route::get('home', Home::class)->name('home');

    //User
    Route::prefix('User')->group(function(){
        Route::get('Application/List', Lists::class)->name('user_application.list');
        Route::get('Application/Membership/Status', MembershipStatus::class)->name('user_membership.status');
    });

    //--------------------------------- Notification ---------------------------------//
    Route::get('/notification', notification::class)->name('notification');
    //------------------------------- End Notification -------------------------------//


    //------------------------------- Applications -------------------------------//
    Route::prefix('apply')->group(function(){
        //Applications > Special Aid
        Route::get('/SpecialAid', ApplySpecialAid::class)->name('special-aid.apply');

        //Applications > Add Share
        Route::get('/Share', ApplyShare::class)->name('share.apply');

        //Applications > Sell/Exchange Share
        Route::get('/SellShare', ApplySellExchangeShare::class)->name('share.sell');

        //Application > Add Contribution
        Route::get('/Contribution', ApplyContribution::class)->name('contribution.apply');

        //Application > W/D Contribution
        Route::get('/withdrawContribution', ApplyWithdrawContribution::class)->name('contribution.withdraw');

        //Financing > Apply
        Route::get('/Financing/List', FinancingList::class)->name('financing.list');
        Route::get('/Financing/{product_id}', ApplyFinancing::class)->name('financing.apply');
        // Route::get('/Financing}', Apply_Financing::class)->name('financing.apply');

        //membership > apply
        Route::get('membership', NewMembership::class)->name('membership.apply');

        //Application > Applydividend
        Route::get('/Dividend', ApplyDividend::class)->name('dividend.apply');
    });
    //------------------------------- End Applications ---------------------------//


    //------------------------ admin ------------------------------//
    Route::prefix('Admin')->group(function(){
        //Admin > User
        Route::prefix('User')->group(function(){
            Route::get('RoleGroup', RoleGroupManagement::class)->name('user.rolegroup');
            Route::get('CreateGroup', RoleGroupCreate::class)->name('user.creategroup');
            Route::get('EditGroup/{uuid}', RoleGroupCreate::class)->name('user.editgroup');
        });
        Route::prefix('Membership')->group(function(){
            Route::get('/', MembershipAdmin::class)->name('membership.admin');
        });

        Route::prefix('Approval')->group(function(){
            //Route::get('admin', ApprovalAdmin::class)->name('admin.approval.admin');
            Route::get('/Financing', ApprovalFinancing::class);
            Route::get('/Financing/{product}', ApprovalFinancing::class);
            Route::get('/{type}', ApprovalAdmin::class);
        });

        Route::prefix('maintenance')->group(function(){
            //Admin > Maintenance > Special Aid
            Route::prefix('specialAid')->group(function(){
                Route::get('/', ListSpecialAid::class)->name('special_aid.list');
                Route::get('create', CreateSpecialAid::class)->name('special_aid.create');
                Route::get('edit/{uuid}', CreateSpecialAid::class)->name('special_aid.edit');
            });
            Route::prefix('coop')->group(function(){
                Route::get('/', ClientAdmin::class)->name('coop.list');
                Route::get('create', ClientCreate::class)->name('coop.create');
                Route::get('edit/{client_id}', ClientCreate::class)->name('coop.edit');
            });
            Route::prefix('CustCoop')->group(function(){
                Route::get('/', CustomerCoop::class)->name('coop.cust');
            });

            //Product > Create/Edit
            Route::prefix('product')->group(function(){
                Route::get('/', ProductList::class)->name('product.list');
                Route::get('create', ProductCreate::class)->name('product.create');
                Route::get('edit/{id}', ProductEdit::class)->name('product.edit');
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

            //Admin > Maintenance > Financing Calculation Type
            Route::prefix('calculationType')->group(function(){
                Route::get('/', CalculationTypeList::class)->name('calculationType.list');
                Route::get('create', CalculationTypeCreate::class)->name('calculationType.create');
                Route::get('edit/{id}', CalculationTypeCreate::class)->name('calculationType.edit');
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

            Route::get('/sellShare/{uuid}', [SellExchangeShare::class, 'showApplication'])->name('application.sell');

            Route::get('/addContribution/{uuid}', [Contribution::class, 'showApplication'])->name('application.contribution');

            Route::get('/withdrawContribution/{uuid}', [WithdrawalContribution::class, 'showApplication'])->name('application.withdrawal');
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
                Route::get('approval/{uuid}', ShareApprover::class)->name('share.approval');
                Route::get('resolution/{uuid}', ShareResolution::class)->name('share.resolution');
            });

            //Exec > approval > sell/exchange share
            Route::prefix('sellShare')->group(function(){
                Route::get('maker/{uuid}', SellShareMaker::class)->name('sellShare.maker');
                Route::get('checker/{uuid}', SellShareChecker::class)->name('sellShare.checker');
                Route::get('committee/{uuid}', SellShareCommittee::class)->name('sellShare.committee');
                Route::get('approval/{uuid}', SellShareApproval::class)->name('sellShare.approval');
            });

            //Exec > approval > add contribution
            Route::prefix('contribution')->group(function(){
                Route::get('maker/{uuid}', ContributionMaker::class)->name('contribution.maker');
                Route::get('checker/{uuid}', ContributionChecker::class)->name('contribution.checker');
                Route::get('committee/{uuid}', ContributionCommittee::class)->name('contribution.committee');
                Route::get('approval/{uuid}', ContributionApproval::class)->name('contribution.approval');
            });

            //Exec > approval > w/d contribution
            Route::prefix('withdrawContribution')->group(function(){
                Route::get('maker/{uuid}', WithdrawalContributionMaker::class)->name('withdrawal.maker');
                Route::get('checker/{uuid}', WithdrawalContributionChecker::class)->name('withdrawal.checker');
                Route::get('committee/{uuid}', WithdrawalContributionCommittee::class)->name('withdrawal.committee');
                Route::get('approval/{uuid}', WithdrawalContributionApproval::class)->name('withdrawal.approval');
            });

            //Exec > approval > Financing
            Route::prefix('financing')->group(function(){
                Route::get('maker/{uuid}', FinancingMaker::class)->name('financing.maker');
                Route::get('checker/{uuid}', FinancingChecker::class)->name('financing.checker');
                Route::get('committee/{uuid}', FinancingCommittee::class)->name('financing.committee');
                Route::get('approver/{uuid}', FinancingApprover::class)->name('financing.approver');
                Route::get('resolution/{uuid}', FinancingResolution::class)->name('financing.resolution');
            });

            //Exec > approval > Dividend
            Route::prefix('dividend')->group(function(){
                Route::get('maker/{uuid}', DividendMaker::class)->name('dividend.maker');
                Route::get('checker/{uuid}', DividendChecker::class)->name('dividend.checker');
                Route::get('committee/{uuid}', DividendCommittee::class)->name('dividend.committee');
                Route::get('approver/{uuid}', DividendApprover::class)->name('dividend.approver');
            });

            //Exec > approval > Membership
            Route::prefix('member')->group(function(){
                Route::get('maker/{uuid}', MembershipMaker::class)->name('membership.maker');
                Route::get('checker/{uuid}', MembershipChecker::class)->name('membership.checker');
                Route::get('committee/{uuid}', MembershipCommittee::class)->name('membership.committee');
                Route::get('approver/{uuid}', MembershipApprover::class)->name('membership.approver');
                Route::get('resolution/{uuid}', MembershipResolution::class)->name('membership.resolution');
            });
        });

    });
    //----------------------- End Executive --------------------------------//

    //----------------------- Reporting ------------------------------------//
    //Report > Sample
    Route::get('list-reporting', ListReport::class)->name('list-reporting');
    Route::get('user-reporting', UserReporting::class)->name('user-reporting');
    //----------------------- End Reporting --------------------------------//

});

//-------------- component doc -------------------//
Route::get('doc', ComponentDoc::class)->name('doc');
