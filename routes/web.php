<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\HotelController;
use App\Http\Controllers\admin\LocationController;
use App\Http\Controllers\admin\SiteController;
use App\Http\Controllers\admin\TourController;
use App\Http\Controllers\admin\TourDetailController;
use App\Http\Controllers\admin\TourImageController;
use App\Http\Controllers\admin\userController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\Auth\AuthController as AuthAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    Toastr::success('Hotel added successfully!');
    return view('index');
});
Route::get('index.html', function () {
    return view('index');
});
Route::get('/hotel.html', function () {
    return view('hotel');
});
Route::get('/hotel.html', function () {
    return view('hotel');
});
Route::view('/hotel-single.html', 'hotel-single');
Route::view('/about.html', 'about');
Route::view('/blog.html', 'blog');
Route::view('/blog-single.html', 'blog-single');
Route::view('/contact.html', 'contact');
Route::view('/sign-in', 'sign-in');
Route::view('/sign-up', 'sign-up');

// admin
Route::group(['middleware' => 'checkadmin', 'prefix' => '/admin'], function () {
    // Các route trong thư mục admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/hotels', HotelController::class);
    Route::get('/hotels/search', [HotelController::class, 'search'])->name('hotels.search');
    Route::resource('/locations', LocationController::class);
    Route::resource('/sites', SiteController::class);
    Route::resource('/users', UserController::class);






    Route::get('/tables', function () {
        return view('admin.tables');
    })->name('admin.tables');
    Route::get('/billing', function () {
        return view('admin.billing');
    })->name('admin.billing');
    Route::get('/rtl', function () {
        return view('admin.rtl');
    })->name('admin.rtl');
    Route::get('/vr', function () {
        return view('admin.virtual-reality');
    })->name('admin.vr');
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/index');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
