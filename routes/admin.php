<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\admin\LoginController;
use \App\Http\Controllers\admin\DashboardController;
use \App\Http\Controllers\admin\CategoryController;
use \App\Http\Controllers\admin\PostController;
use \App\Http\Controllers\admin\StaffController;
use \App\Http\Controllers\admin\SystemController;
use \App\Http\Controllers\admin\UserController;
use \App\Http\Controllers\admin\ProductController;
use \App\Http\Controllers\admin\OrderController;


Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/dologin', [LoginController::class, 'doLogin'])->name('doLogin');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('check-admin-auth')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('index');

    Route::prefix('order')->name('order.')->group(function (){
        Route::get('index/{status}', [OrderController::class,'getDataOrder'])->name('index');
        Route::get('detail/{id}', [OrderController::class,'orderDetail'])->name('detail');
        Route::get('status/{order_id}/{status_id}', [OrderController::class,'statusOrder'])->name('status');
        Route::post('save-note/{id}', [OrderController::class, 'saveNote'])->name('save-note');
    });

    Route::prefix('category')->name('category.')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('index');
        Route::get('create', [CategoryController::class, 'create'])->name('create');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::get('delete/{id}', [CategoryController::class, 'delete']);
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('update');
    });

    Route::prefix('product')->name('product.')->group(function () {
        Route::get('', [ProductController::class, 'index'])->name('index');
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('store', [ProductController::class, 'store'])->name('store');
        Route::get('delete/{id}', [ProductController::class, 'delete']);
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('update');
        Route::post('delete-img', [ProductController::class, 'deleteImg']);
        Route::get('delete-color/{id}', [ProductController::class, 'deleteColor']);
    });

    Route::prefix('category-post')->name('category-post.')->group(function () {
        Route::get('index-category', [PostController::class, 'indexCate'])->name('index-cate');
        Route::get('create-category', [PostController::class, 'createCate'])->name('create-cate');
        Route::post('store-category', [PostController::class, 'storeCate'])->name('store-cate');
        Route::get('delete-category/{id}', [PostController::class, 'deleteCate']);
        Route::get('edit-category/{id}', [PostController::class, 'editCate'])->name('edit-cate');
        Route::post('update-category/{id}', [PostController::class, 'updateCate'])->name('update-cate');
    });

    Route::prefix('post')->name('post.')->group(function () {
        Route::get('', [PostController::class, 'index'])->name('index');
        Route::get('create', [PostController::class, 'create'])->name('create');
        Route::post('store', [PostController::class, 'store'])->name('store');
        Route::get('delete/{id}', [PostController::class, 'delete']);
        Route::get('edit/{id}', [PostController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [PostController::class, 'update'])->name('update');
    });

    Route::prefix('support-staff')->name('support-staff.')->group(function () {
        Route::get('', [StaffController::class, 'index'])->name('index');
        Route::get('create', [StaffController::class, 'create'])->name('create');
        Route::post('store', [StaffController::class, 'store'])->name('store');
        Route::get('delete/{id}', [StaffController::class, 'delete']);
        Route::get('edit/{id}', [StaffController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [StaffController::class, 'update'])->name('update');
    });

    Route::prefix('system')->name('system.')->group(function () {
        Route::get('', [SystemController::class, 'index'])->name('index');
        Route::post('store', [SystemController::class, 'store'])->name('store');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('delete/{id}', [UserController::class, 'delete']);
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [UserController::class, 'update'])->name('update');
    });

    Route::get('contact', [SystemController::class, 'contact'])->name('contact');
    Route::get('contact-detail/{id}', [SystemController::class, 'contactDetail'])->name('contact-detail');
    Route::get('contact-delete/{id}', [SystemController::class, 'contactDelete'])->name('contact-delete');
    Route::get('contact-newsletter', [SystemController::class, 'contactNewsletter'])->name('contact-newsletter');
    Route::get('contact-newsletter-delete/{id}', [SystemController::class, 'contactNewsletterDelete'])->name('contact-newsletter-delete');
});

Route::post('ckeditor/upload', [DashboardController::class, 'upload'])->name('ckeditor.image-upload');
