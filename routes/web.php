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
Route::group(['middleware' => 'auth'], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            if (Auth::user()->getAttribute('type') != 'admin') {
                return redirect('/');
            }

            return view('dashboard');
        })->name('dashboard');

        Route::resource('user', UserController::class);
        Route::resource('organization', OrgController::class);
    });

    Route::get('/', [HomeController::class, 'home']);
    Route::get('post/{id}', [PostController::class, 'index']);
    Route::resource('profile', ProfileController::class);

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

    /** USER MANAGEMENT */
    Route::get('find-phone', function (Request $request) {
        if (! $request->ajax()) {
            // send
        }
    });

    Route::get('find-email', function (Request $request) {
        if (! $request->ajax()) {
            // send
        }
    });
    /** END USER MANAGEMENT */


	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

    Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
