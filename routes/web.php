<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Web\HomeController;
use \App\Http\Controllers\web\LoginController;
use \App\Http\Controllers\web\ProfileController;
use \App\Http\Controllers\web\ProductController;

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

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('doLogin', [LoginController::class, 'doLogin'])->name('doLogin');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('registered', [LoginController::class,'registered'])->name('registered');
Route::get('/register-complete', [LoginController::class, 'registerComplete'])->name('register-complete');
Route::get('logout', [LoginController::class,'logout'])->name('logout');
//Route::get('/recovery', [HomeController::class, 'recovery'])->name('recovery');

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/bai-viet/{slug}', [HomeController::class, 'blog'])->name('blog');
Route::get('/chi-tiet-bai-viet/{slug}', [HomeController::class, 'detailBlog'])->name('detail-blog');
Route::get('/lien-he', [HomeController::class, 'contact'])->name('contact');
Route::post('save-contact', [HomeController::class,'saveContact'])->name('save-contact');
Route::post('save-receive-newsletter', [HomeController::class,'saveReceiveNewsletter'])->name('save-receive-newsletter');

Route::get('/danh-muc/{slug}', [HomeController::class, 'category'])->name('category');
Route::get('/tim-kiem-san-pham', [HomeController::class, 'search'])->name('search');
Route::get('/chi-tiet-san-pham/{slug}', [ProductController::class, 'detailProduct'])->name('detail-product');
Route::post('save-order', [ProductController::class,'saveOrder'])->name('save-order');


Route::middleware('auth')->group(function () {
    Route::get('/thong-tin-tai-khoan', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/save-profile', [ProfileController::class, 'saveProfile'])->name('save-profile');
    Route::get('/doi-mat-khau', [ProfileController::class, 'password'])->name('password');
    Route::post('/save-password', [ProfileController::class, 'savePassword'])->name('save-password');
    Route::get('/my-order', [ProfileController::class, 'myOrder'])->name('my-order');
    Route::get('cancel-order/{id}', [ProfileController::class, 'cancelOrder']);
});
