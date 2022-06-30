<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\RedirectController;
use App\Http\Livewire\Admin\Maintenance\Bank\bank;
use App\Http\Livewire\Admin\Maintenance\Bank\bankcreate;
use App\Http\Livewire\Admin\Maintenance\Bank\bankedit;
use App\Http\Livewire\Admin\Maintenance\coop\coop;
use App\Http\Livewire\Admin\Maintenance\countries\country;
use App\Http\Livewire\Admin\Maintenance\countries\countrycreate;
use App\Http\Livewire\Admin\Maintenance\countries\countryedit;
use App\Http\Livewire\admin\maintenance\education\AddEducation;
use App\Http\Livewire\admin\maintenance\education\EditEducation;
use App\Http\Livewire\admin\maintenance\education\ListEducation;
use App\Http\Livewire\Admin\Maintenance\gender\gender;
use App\Http\Livewire\Admin\Maintenance\gender\gendercreate;
use App\Http\Livewire\Admin\Maintenance\gender\genderedit;
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
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\RetrieveAccount;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\ComponentDoc;
use App\Http\Livewire\Page\Admin\Maintenance\AddMaintenance;
use App\Http\Livewire\Page\Admin\Maintenance\EditMaintenance;
use App\Http\Livewire\Page\Admin\Maintenance\ListMaintenance;
use App\Http\Livewire\Page\Admin\SpecialAid\CreateSpecialAid;
use App\Http\Livewire\Page\Admin\SpecialAid\EditSpecialAid;
use App\Http\Livewire\Page\Admin\SpecialAid\ListSpecialAid;
use App\Http\Livewire\Page\ApplySpecialAid\Apply_SpecialAid;
use App\Http\Livewire\Page\Home;
use App\Http\Livewire\Page\Profile\Index;
use App\Http\Livewire\Page\Reporting\ListReport;
use App\Http\Livewire\Page\Reporting\UserReporting;

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


    //------------------------------- Applications -------------------------------//
    //Applications > Special Aid
    Route::get('/applySpecialAid', Apply_SpecialAid::class)->name('special-aid.apply');


    //------------------------admin------------------------------//
    //Admin > Maintenance > Special Aid
    Route::prefix('specialAid')->group(function(){
        Route::get('/', ListSpecialAid::class)->name('special_aid.list');
        Route::get('create', CreateSpecialAid::class)->name('special_aid.create');            
        Route::get('edit/{uuid}', EditSpecialAid::class)->name('special_aid.edit');            
    });

    //Admin > Maintenance > sample
    Route::get('list-maintenance', ListMaintenance::class)->name('list-maintenance');
    Route::get('add-maintenance', AddMaintenance::class)->name('add-maintenance');
    Route::get('edit-maintenance/{id}', EditMaintenance::class)->name('edit-maintenance');
    Route::get('admin/coop', Coop::class)->name('maintenanceCoop');

    //Admin > Maintenance > Bank
    Route::get('bank', bank::class)->name('bank');
    Route::get('bankcreate', bankcreate::class)->name('bankcreate');
    Route::get('bankedit/{id}', bankedit::class)->name('bankedit');
    Route::get('delete/{id}', bank::class)->name('delete');

    //Admin > Maintenance > Education
    Route::get('educationlist', ListEducation::class)->name('education.list');
    Route::get('educationcreate', AddEducation::class)->name('education.create');
    Route::get('educationedit/{id}', EditEducation::class)->name('education.edit');
    Route::get('educationdelete/{id}', ListEducation::class)->name('education.delete');

    //Admin > Maintenance > Country
    Route::get('country', country::class)->name('country');
    Route::get('countrycreate', countrycreate::class)->name('countrycreate');
    Route::get('countryedit/{id}', countryedit::class)->name('countryedit');
    Route::get('delete/{id}', country::class)->name('delete');

    //Admin > Maintenance >  cust_title
    Route::get('titlelist', ListTitle::class)->name('title.list');
    Route::get('titlecreate', CreateTitle::class)->name('title.create');
    Route::get('titleedit/{id}', EditTitle::class)->name('title.edit');

    //Admin > Maintenance > race
    Route::get('racelist', ListRace::class)->name('race.list');
    Route::get('racecreate', CreateRace::class)->name('race.create');
    Route::get('raceedit/{id}', EditRace::class)->name('race.edit');

    //Admin > Maintenance > Religion
    Route::get('religion', religion::class)->name('religion');
    Route::get('religioncreate', religioncreate::class)->name('religioncreate');
    Route::get('religionedit/{id}', religionedit::class)->name('religionedit');
    Route::get('delete/{id}', religion::class)->name('delete');

    //Admin > Maintenance > State
    Route::get('state', state::class)->name('state');
    Route::get('statecreate', statecreate::class)->name('statecreate');
    Route::get('statenedit/{id}', stateedit::class)->name('stateedit');
    Route::get('delete/{id}', state::class)->name('delete');

    //Admin > Maintenance > Gender
    Route::get('gender', gender::class)->name('gender');
    Route::get('gendercreate', gendercreate::class)->name('gendercreate');
    Route::get('gendernedit/{id}', genderedit::class)->name('genderedit');
    Route::get('delete/{id}', gender::class)->name('delete');

    //------------------------Reporting------------------------------//
    //Report > Sample
    Route::get('list-reporting', ListReport::class)->name('list-reporting');
    Route::get('user-reporting', UserReporting::class)->name('user-reporting');
});

//-------------- component doc -------------------//
Route::get('doc', ComponentDoc::class)->name('doc');
