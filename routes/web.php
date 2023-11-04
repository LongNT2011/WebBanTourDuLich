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


Route::prefix('admin/dashboard')->group(function () {
    Route::get('booking-total', [DashboardController::class, 'GetTotalBookingRadialChartDataDb']);
    Route::get('registered-users', [DashboardController::class, 'GetRegisteredUserChartDataDb']);
    Route::get('revenue', [DashboardController::class, 'GetRevenueChartDataDb']);
    Route::get('booking-pie-chart', [DashboardController::class, 'GetBookingPieChartDataDb']);
    Route::get('member-booking-line-chart', [DashboardController::class, 'GetMemberAndBookingLineChartDataDb']);
});
// admin
Route::group(['prefix' => '/admin'], function () {
    // Các route trong thư mục admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/hotels', HotelController::class);
    Route::post('/hotels/search', [HotelController::class, 'search'])->name('hotels.search');
    Route::resource('/locations', LocationController::class);
    Route::post('/locations/search', [LocationController::class, 'search'])->name('locations.search');
    Route::resource('/sites', SiteController::class);
    Route::post('/sites/search', [SiteController::class, 'search'])->name('sites.search');
    Route::resource('/users', UserController::class);
    Route::post('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::resource('/tours', TourController::class);
    Route::post('/tours/search', [TourController::class, 'search'])->name('tours.search');
    Route::resource('/tourdetails', TourDetailController::class);
    Route::post('/tourdetails/search', [HotelController::class, 'search'])->name('tourdetails.search');
    Route::resource('/tourdetails.image', TourImageController::class)->except(['create', 'index', 'show']);

});
