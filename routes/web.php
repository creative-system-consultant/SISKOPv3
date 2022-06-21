<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\RedirectController;
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
use App\Http\Livewire\Page\Admin\Maintenance\{
    ListMaintenance,
    AddMaintenance,
    EditMaintenance
};

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

//page routes
Route::middleware('auth')->group(function () {
    Route::get('home', Home::class)->name('home');

    //auth
    Route::get('email/verify', Verify::class)->middleware('throttle:6,1')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)->middleware('signed')->name('verification.verify');
    Route::get('password/confirm', Confirm::class)->name('password.confirm');
    Route::post('logout', LogoutController::class)->name('logout');

    //profile
    Route::get('profile', Index::class)->name('profile');

    //------------------------admin------------------------------//

    //maintenance
    Route::get('list-maintenance', ListMaintenance::class)->name('list-maintenance');
    Route::get('add-maintenance', AddMaintenance::class)->name('add-maintenance');
    Route::get('edit-maintenance/{id}', EditMaintenance::class)->name('edit-maintenance');
});

//component doc
Route::get('doc', ComponentDoc::class)->name('doc');

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
