<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;

Route::get('/', [HomeController::class, 'index'])->name('home');

/**
 * TESTING ROUTES
 */
Route::view('/example-page', 'example-page');
Route::view('/example-auth', 'example-auth');

/**
 * ADMIN ROUTES
 */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest', 'preventBackHistory'])->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('/login', 'loginForm')->name('login');
            Route::post('/login', 'loginHandler')->name('login_handler');
            Route::get('/register', 'registerForm')->name('register');
            Route::post('/register', 'registerHandler')->name('register_handler');
            Route::get('/forgot-password', 'forgotForm')->name('forgot');
            Route::post('/send-password-reset-link', 'sendPasswordResetLink')->name('send_password_reset_link');
            Route::get('/password/{token}', 'resetPasswordForm')->name('reset_password_form');
            Route::post('/reset-password-handler', 'resetPasswordHandler')->name('reset_password_handler');
        });
    });

    Route::middleware(['auth', 'preventBackHistory'])->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::post('/logout', 'logoutHandler')->name('logout');
        });
    });

    Route::middleware(['auth', 'preventBackHistory', 'isAdmin'])->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'adminDashboard')->name('dashboard');
            Route::get('/profile', 'profileView')->name('profile');
            Route::post('/update-profile-picture', 'updateProfilePicture')->name('update_profile_picture');

            Route::middleware(['onlySuperAdmin'])->group(function () {
                Route::get('/settings', 'generalSettings')->name('settings');
                Route::post('/update-site-logo', 'updateSiteLogo')->name('update_site_logo');
                Route::get('/post-categories', 'postCategoriesPage')->name('post_categories');
            });
        });

        Route::controller(PostController::class)->group(function () {
            Route::get('/post/new', 'addPost')->name('add_post');
            Route::post('/create-post', 'createPost')->name('create_post');
            Route::get('/posts', 'allPosts')->name('posts');
            Route::get('/post/{id}/edit', 'editPost')->name('edit_post');
            Route::post('/post/update', 'updatePost')->name('update_post');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('/users', 'allUsersAdmin')->name('users');
            Route::get('/user/{id}/edit', 'editUserAdmin')->name('edit_user');
            Route::post('/user/update', 'updateUserAdmin')->name('update_user');
        });
    });
});

/**
 * VERIFICATION EMAIL
 */


