<?php

use App\Http\Controllers\account\AccountController;
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
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\order\OrderController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/index.html', [HomeController::class, 'index'])->name('index');
Route::get('/hotel.html', function () {
    return view('hotel');
});
Route::get('/hotel.html', function () {
    return view('hotel');
});
Route::get('/tourdetail/{detail}', [HomeController::class, 'detail'])->name('tour.detail');
Route::view('/about.html', 'about');
Route::view('/blog.html', 'blog');
Route::view('/blog-single.html', 'blog-single');
Route::view('/contact.html', 'contact');
Route::view('/sign-in', 'sign-in');
Route::view('/sign-up', 'sign-up');

Route::view('/abc', 'tour');
Route::view('/abc1', 'admin.dashboard');
Route::view('/orderConfirm', 'orderConfirm');
Route::view('/orderDetail', 'orderDetail');
Route::get('/tour.html', [HomeController::class, 'tour'])->name('tour');



Route::prefix('admin/dashboard')->group(function () {
    Route::get('booking-total', [DashboardController::class, 'GetTotalBookingRadialChartDataDb']);
    Route::get('registered-users', [DashboardController::class, 'GetRegisteredUserChartDataDb']);
    Route::get('revenue', [DashboardController::class, 'GetRevenueChartDataDb']);
    Route::get('booking-pie-chart', [DashboardController::class, 'GetBookingPieChartDataDb']);
    Route::get('member-booking-line-chart', [DashboardController::class, 'GetMemberAndBookingLineChartDataDb']);
});
// admin
Route::group(['middleware' => 'checkadmin' , 'prefix' => '/admin'], function () {
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
    Route::post('/tourdetails/search', [TourDetailController::class, 'search'])->name('tourdetails.search');
    Route::resource('/tourdetails.image', TourImageController::class)->except(['create', 'index', 'show']);

});

// auth
Route::get('/signin', [AuthController::class, 'showSigninForm'])->name('auth.signin');
Route::post('/signin', [AuthController::class, 'signin']);

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('auth.signup');
Route::post('/signup', [AuthController::class, 'signup']);

Route::get('/signout', [AuthController::class, 'signout'])->name('auth.signout');

Route::get('/signin_admin', [DashboardController::class, 'showSigninAdminForm'])->name('admin.signinAdmin');
Route::post('/signin_admin', [DashboardController::class, 'signinAdmin']);

Route::get('/signout_admin', [DashboardController::class, 'signoutAdmin'])->name('admin.signoutAdmin');

// verify
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/index');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//profile
Route::get('/profile/', [AccountController::class, 'showAccountDetail']) -> name('account.detail');
Route::put('/profile/update/{user}', [AccountController::class, 'updateAccount']) -> name('account.update');
//Order
Route::get("/order/{tourDetail}", [OrderController::class, 'showOrderView']) -> name('order.bookingtour');
