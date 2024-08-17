<?php

use App\Http\Controllers\Admin\OrgController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire;

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

Route::get('/counter', \App\Livewire\Counter::class);
Route::group(['middleware' => ['role:admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', Livewire\Admin\Dashboard::class);
        Route::get('user', Livewire\Admin\Manage\User::class);
        Route::get('user/create', Livewire\Admin\Manage\User\Create::class);
        Route::get('organization', Livewire\Admin\Manage\Organization::class);
        Route::get('organization/create', Livewire\Admin\Manage\Organization\Edit::class)->lazy();
        Route::get('organization/edit/{id}', Livewire\Admin\Manage\Organization\Edit::class)->name('edit-organization')->lazy();
    });

    Route::resource('profile', ProfileController::class);

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');
});

//Route::get('/', function () {
//    if (Auth::user()?->role == 'admin') {
//        redirect('/admin');
//    }
//});
Route::get('/', Livewire\Home::class)->name('home');

Route::group(['middleware' => ['role:adviser']], function () {
    Route::get('/timeline', Livewire\Member\Timeline::class)->lazy();
//    Route::get('/post/{id}', function ($id) {})
});
Route::group(['middleware' => 'guest'], function () {

    Route::get('/register', Livewire\Registration::class);
    Route::get('/login', Livewire\Login::class);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
    Route::get('/organizations', [App\Http\Controllers\Guest\Organization::class, 'index']);
});

//Route::get('/login', function () {
//    return view('session/login-session');
//})->name('login');




//Route::get('tables', function () {
//    return view('tables');
//})->name('tables');
//
//Route::get('virtual-reality', function () {
//    return view('virtual-reality');
//})->name('virtual-reality');
//
//Route::get('static-sign-in', function () {
//    return view('static-sign-in');
//})->name('sign-in');
//
//Route::get('static-sign-up', function () {
//    return view('static-sign-up');
//})->name('sign-up');
//
Route::get('/logout', [SessionsController::class, 'destroy']);
//Route::get('/user-profile', [InfoUserController::class, 'create']);
//Route::post('/user-profile', [InfoUserController::class, 'store']);
//Route::get('/login', function () {
//    return view('dashboard');
//})->name('sign-up');
