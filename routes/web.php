<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

// Public Menu
Route::get('/', [MenuController::class, 'index'])->name('menu');

// Admin Auth
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Panel
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::post('categories/reorder', [CategoryController::class, 'reorder'])->name('categories.reorder');
    Route::resource('products', ProductController::class)->except(['show']);
    Route::post('products/reorder', [ProductController::class, 'reorder'])->name('products.reorder');
    Route::resource('social-links', SocialLinkController::class)->except(['show']);
    Route::post('social-links/reorder', [SocialLinkController::class, 'reorder'])->name('social-links.reorder');
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('change-password', [UserController::class, 'showChangePassword'])->name('change-password');
    Route::post('change-password', [UserController::class, 'changePassword']);
});
