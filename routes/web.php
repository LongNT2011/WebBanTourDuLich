<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\HotelController;
use App\Http\Controllers\admin\LocationController;
use App\Http\Controllers\admin\SiteController;
use App\Http\Controllers\admin\TourController;
use App\Http\Controllers\admin\TourDetailController;
use App\Http\Controllers\admin\TourImageController;
use App\Http\Controllers\admin\userController;
use Illuminate\Support\Facades\Route;

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
    Toastr::success('Hotel added successfully!' );
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
Route::group(['prefix' => '/admin'], function () {
    // Các route trong thư mục admin
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::resource('/hotels',HotelController::class);
    Route::post('/hotels/search', [HotelController::class,'search'])->name('hotels.search');
    Route::resource('/locations',LocationController::class);
    Route::resource('/sites',SiteController::class);
    Route::resource('/users',UserController::class);
    Route::resource('/tours',TourController::class);
    Route::resource('/tourdetails',TourDetailController::class);
    Route::resource('/tourdetails.image',TourImageController::class)->except(['create', 'index','show']);








});


