<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\RedirectController;
use App\Http\Livewire\Admin\SpecialAid\CreateSpecialAid;
use App\Http\Livewire\Admin\SpecialAid\EditSpecialAid;
use App\Http\Livewire\admin\maintenance\education\ListEducation;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\RetrieveAccount;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\ComponentDoc;
use App\Http\Livewire\Page\Home;
use App\Http\Livewire\Page\Profile\Index;
use App\Http\Livewire\Page\Admin\Maintenance\ListMaintenance;
use App\Http\Livewire\Page\Admin\Maintenance\AddMaintenance;
use App\Http\Livewire\Page\Admin\Maintenance\EditMaintenance;
use App\Http\Livewire\Page\Reporting\ListReport;
use App\Http\Livewire\Page\Reporting\UserReporting;
use App\Http\Livewire\Admin\Maintenance\Bank\bank;
use App\Http\Livewire\Admin\Maintenance\Bank\bankedit;
use App\Http\Livewire\Admin\Maintenance\Bank\bankcreate;
use App\Http\Livewire\admin\maintenance\education\AddEducation;
use App\Http\Livewire\admin\maintenance\education\EditEducation;
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


    //Reporting
    Route::get('list-reporting', ListReport::class)->name('list-reporting');
    Route::get('user-reporting', UserReporting::class)->name('user-reporting');

    //------------------------admin------------------------------//

    //Special Aid
    Route::prefix('specialAid')->group(function(){
        Route::get('list', ListSpecialAid::class)->name('special_aid.list');
        Route::get('create', CreateSpecialAid::class)->name('special_aid.create');            
        Route::get('edit/{uuid}', EditSpecialAid::class)->name('special_aid.edit');            
    });

    //Maintenance
    Route::get('list-maintenance', ListMaintenance::class)->name('list-maintenance');
    Route::get('add-maintenance', AddMaintenance::class)->name('add-maintenance');
    Route::get('edit-maintenance/{id}', EditMaintenance::class)->name('edit-maintenance');
});

//-------------- component doc -------------------//
Route::get('doc', ComponentDoc::class)->name('doc');

    //--------------------------------- Bank Maintenance ----------------------------------//
    Route::get('bank', bank::class)->name('bank');
    Route::get('bankcreate', bankcreate::class)->name('bankcreate');
    Route::get('bankedit/{id}', bankedit::class)->name('bankedit');
    Route::get('delete/{id}', bank::class)->name('delete');

    //maintenance education

    Route::get('educationlist', ListEducation::class)->name('education.list');
    Route::get('educationcreate', AddEducation::class)->name('education.create');
    Route::get('educationedit/{id}', EditEducation::class)->name('education.edit');
    Route::get('educationdelete/{id}', ListEducation::class)->name('education.delete');

// //profile
// Route::get('profile', Index::class)->name('profile');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
