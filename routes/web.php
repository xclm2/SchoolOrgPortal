<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
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
        Route::get('course', Livewire\Admin\Manage\Course::class);
        Route::get('user/create', Livewire\Admin\Manage\User\Create::class);
        Route::get('organization', Livewire\Admin\Manage\Organization::class);
        Route::get('organization/create', Livewire\Admin\Manage\Organization\Edit::class);
        Route::get('organization/edit/{id}', Livewire\Admin\Manage\Organization\Edit::class)->name('edit-organization');
    });

    Route::resource('profile', ProfileController::class);

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');
});


Route::get('/', Livewire\Home::class);
Route::get('/event/{id}', Livewire\Post\View::class);

Route::group(['middleware' => ['role:adviser']], function () {
    Route::prefix('adviser')->group(function () {
        Route::get('/', Livewire\Member\Adviser\Home::class);
        Route::get('/members', Livewire\Member\Adviser\Organization\Members::class);
        Route::get('/calendar', Livewire\Member\Events\View\Calendar::class);
        Route::get('/profile', Livewire\Member\Profile::class);
        Route::get('/organization/edit', Livewire\Member\Adviser\Organization\Edit::class);
        Route::get('/messages', Livewire\Member\Message::class);
    });
});

Route::group(['middleware' => ['role:student']], function () {
    Route::prefix('member')->group(function () {
        Route::get('/', Livewire\Member\Adviser\Home::class);
        Route::get('/members', Livewire\Member\Adviser\Organization\Members::class);
        Route::get('/calendar', Livewire\Member\Events\View\Calendar::class);
        Route::get('/profile', Livewire\Member\Profile::class);
        Route::get('/messages', Livewire\Member\Message::class);
        Route::get('/organization/view/{id}', Livewire\Guest\Organization\View::class);
    });
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', Livewire\Registration::class);
    Route::get('/login', Livewire\Login::class);
    Route::get('/organizations', Livewire\Organizations::class);
    Route::get('/organization/{id}', Livewire\Guest\Organization\View::class);
    Route::get('/register/organization/{organizationId?}', Livewire\Registration::class);

    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});


Route::get('/logout', [SessionsController::class, 'destroy']);
