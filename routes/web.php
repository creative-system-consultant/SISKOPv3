<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\RedirectController;
use App\Http\Livewire\Admin\Maintenance\Bank\bank;
use App\Http\Livewire\Admin\Maintenance\Bank\bankcreate;
use App\Http\Livewire\Admin\Maintenance\Bank\bankedit;
use App\Http\Livewire\Admin\Maintenance\countries\country;
use App\Http\Livewire\Admin\Maintenance\countries\countrycreate;
use App\Http\Livewire\Admin\Maintenance\countries\countryedit;
use App\Http\Livewire\admin\maintenance\education\AddEducation;
use App\Http\Livewire\admin\maintenance\education\EditEducation;
use App\Http\Livewire\admin\maintenance\education\ListEducation;
use App\Http\Livewire\Admin\Maintenance\gender\gender;
use App\Http\Livewire\Admin\Maintenance\gender\gendercreate;
use App\Http\Livewire\Admin\Maintenance\gender\genderedit;
use App\Http\Livewire\Admin\maintenance\marital\CreateMarital;
use App\Http\Livewire\Admin\maintenance\marital\EditMarital;
use App\Http\Livewire\Admin\maintenance\marital\ListMarital;
use App\Http\Livewire\admin\maintenance\race\CreateRace;
use App\Http\Livewire\admin\maintenance\race\EditRace;
use App\Http\Livewire\admin\maintenance\race\ListRace;
use App\Http\Livewire\Admin\Maintenance\religion\religion;
use App\Http\Livewire\Admin\Maintenance\religion\religioncreate;
use App\Http\Livewire\Admin\Maintenance\religion\religionedit;
use App\Http\Livewire\Admin\Maintenance\state\state;
use App\Http\Livewire\Admin\Maintenance\state\statecreate;
use App\Http\Livewire\Admin\Maintenance\state\stateedit;
use App\Http\Livewire\admin\maintenance\title\CreateTitle;
use App\Http\Livewire\admin\maintenance\title\EditTitle;
use App\Http\Livewire\admin\maintenance\title\ListTitle;
use App\Http\Livewire\Admin\maintenance\relationship\CreateRelationship;
use App\Http\Livewire\Admin\maintenance\relationship\EditRelationship;
use App\Http\Livewire\Admin\maintenance\relationship\ListRelationship;
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
use App\Http\Livewire\customers\SearchCustomer;
use App\Http\Livewire\customers\EditCustomer;
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
            Route::get('/', bank::class)->name('bank.list');
            Route::get('create', bankcreate::class)->name('bank.create');
            Route::get('edit/{id}', bankedit::class)->name('bank.edit');
        });

        //Admin > Maintenance > Education
        Route::prefix('education')->group(function(){
            Route::get('/', ListEducation::class)->name('education.list');
            Route::get('create', AddEducation::class)->name('education.create');
            Route::get('edit/{id}', EditEducation::class)->name('education.edit');
        });

        //Admin > Maintenance > Country
        Route::prefix('country')->group(function(){
            Route::get('/', country::class)->name('country.list');
            Route::get('create', countrycreate::class)->name('country.create');
            Route::get('edit/{id}', countryedit::class)->name('country.edit');
        });

        //Admin > Maintenance >  cust_title
        Route::prefix('title')->group(function(){
            Route::get('/', ListTitle::class)->name('title.list');
            Route::get('create', CreateTitle::class)->name('title.create');
            Route::get('edit/{id}', EditTitle::class)->name('title.edit');
        });

        //Admin > Maintenance > race
        Route::prefix('race')->group(function(){
            Route::get('/', ListRace::class)->name('race.list');
            Route::get('create', CreateRace::class)->name('race.create');
            Route::get('edit/{id}', EditRace::class)->name('race.edit');
        });

        //Admin > Maintenance > Religion
        Route::prefix('religion')->group(function(){
            Route::get('/', religion::class)->name('religion.list');
            Route::get('create', religioncreate::class)->name('religion.create');
            Route::get('edit/{id}', religionedit::class)->name('religion.edit');
        });

        //Admin > Maintenance > State
        Route::prefix('state')->group(function(){
            Route::get('/', state::class)->name('state.list');
            Route::get('create', statecreate::class)->name('state.create');
            Route::get('edit/{id}', stateedit::class)->name('state.edit');
         });

        //Admin > Maintenance > Gender
        Route::prefix('gender')->group(function(){
            Route::get('/', gender::class)->name('gender.list');
            Route::get('create', gendercreate::class)->name('gender.create');
            Route::get('edit/{id}', genderedit::class)->name('gender.edit');
        });

        //Admin > Maintenance > Relationship
        Route::prefix('relationship')->group(function(){
            Route::get('/', ListRelationship::class)->name('relationship.list');
            Route::get('create', CreateRelationship::class)->name('relationship.create');
            Route::get('edit/{id}', EditRelationship::class)->name('relationship.edit');
         });

        //Admin > Maintenance > Marital
        Route::prefix('marital')->group(function(){
            Route::get('/', ListMarital::class)->name('marital.list');
            Route::get('create', CreateMarital::class)->name('marital.create');
            Route::get('edit/{id}', EditMarital::class)->name('marital.edit');
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
