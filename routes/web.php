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
use App\Http\Livewire\Page\Admin\Maintenance\AddMaintenance;
use App\Http\Livewire\Page\Admin\Maintenance\EditMaintenance;
use App\Http\Livewire\Page\Admin\Maintenance\ListMaintenance;
use App\Http\Livewire\Page\Admin\SpecialAid\CreateSpecialAid;
use App\Http\Livewire\Page\Admin\SpecialAid\EditSpecialAid;
use App\Http\Livewire\Page\Admin\SpecialAid\ListSpecialAid;
use App\Http\Livewire\Page\Application\ApplySpecialAid\Apply_SpecialAid;
use App\Http\Livewire\Page\Home;
use App\Http\Livewire\Page\Profile\Index;
use App\Http\Livewire\Page\Reporting\ListReport;
use App\Http\Livewire\Page\Reporting\UserReporting;
use App\Http\Livewire\Page\Executive\Customer\SearchCustomer;
use App\Http\Livewire\Page\Executive\Customer\EditCustomer;
use App\Http\Livewire\Page\Application\ApplySellExchangeShare\Apply_Sell_ExchangeShare;
use App\Http\Livewire\Page\Application\ApplyShare\Apply_Share;

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


    //------------------------------- Applications -------------------------------//
    //Applications > Special Aid
    Route::get('/applySpecialAid', Apply_SpecialAid::class)->name('special-aid.apply');

    //Applications > Add Share
    Route::get('/applyShare', Apply_Share::class)->name('share.apply');

    //Applications > Sell/Exchange Share
    Route::get('/applySellShare', Apply_Sell_ExchangeShare::class)->name('share.sell');
    //------------------------------- End Applications ---------------------------//


    //------------------------ admin ------------------------------//
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
    //Exec > edit customer
    Route::prefix('exec/editcustomer')->group(function(){
        Route::get('search', SearchCustomer::class)->name('searchcustomer');
        Route::get('edit/{id}', EditCustomer::class)->name('edit');
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
