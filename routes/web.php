<?php

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
    return view('index');
});
Route::get('test', function () {
    return view('test');
});
Route::get('index.html', function () {
    return view('index');
});
Route::get('/tour.html', function () {
    return view('tour');
});
Route::get('/hotel.html', function () {
    return view('hotel');
});
Route::view('/hotel-single.html', 'hotel-single');
Route::view('/about.html', 'about');
Route::view('/blog.html', 'blog');
Route::view('/blog-single.html', 'blog-single');
Route::view('/contact.html', 'contact');


// admin
Route::group(['prefix' => '/admin'], function () {
    // Các route trong thư mục admin
    Route::get('/admin', function () {
        return view('admin/dashboard');
    });
    Route::view('/admin/billing.html', 'billing');
    Route::view('/admin/dashboard.html', 'dashboard');
    Route::view('/admin/profile.html', 'profile');
    Route::view('/admin/rtf.html', 'rtf');
    Route::view('/admin/sign-in.html', 'sign-in');
    Route::view('/admin/sign-up.html', 'sign-up');
    Route::view('/admin/tables.html', 'tables');
    Route::view('/admin/virtual-reality.html', 'virtual-reality');
});
