<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Store Routes
|--------------------------------------------------------------------------
|
| Here is where you can register store routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix("{store:slug}")->group(function () {
    Route::get("/", [\App\Http\Controllers\Store\HomeController::class, "index"])->name("home.index");
    Route::get("/category/{category}", [\App\Http\Controllers\Store\CategoryController::class, "show"])->name("categories.show");
    Route::get("/product/{product}", [\App\Http\Controllers\Store\ProductController::class, "show"])->name("products.show");
    Route::get("/pages/{page}", [\App\Http\Controllers\Store\PageController::class, "index"])->name("pages.show");

    Route::middleware("auth:customer")->group(function () {
        Route::get("/cart", [\App\Http\Controllers\Store\CartController::class, "index"])->name("carts.index");
        Route::prefix('/orders')->group(function () {
            Route::get("/place", [\App\Http\Controllers\Store\OrderController::class, "place"])->name("order.place");
            Route::get("/processing", [\App\Http\Controllers\Store\OrderController::class, "processing"])->name("order.processing");
            Route::get("/success", [\App\Http\Controllers\Store\OrderController::class, "success"])->name("order.success");
            Route::get("/failed", [\App\Http\Controllers\Store\OrderController::class, "failed"])->name("order.failed");
        });
    });
});

Route::post('/change-currency', [\App\Http\Controllers\Store\CurrencyController::class, 'change'])->name('currency.change');

Route::middleware("guest:customer")->prefix("/{store:slug}")->group(function () {
    Route::view("/login", "store-customer.auth.login");
    Route::post("/login", "App\Http\Controllers\Store\AuthController@login")->name("login");

    Route::view("/register", "store-customer.auth.register");
    Route::post("/register", "App\Http\Controllers\Store\AuthController@register")->name("register");

    Route::view("/forgot-password", "store-customer.auth.forget-password")->name("forget-password");
    Route::post("/forgot-password", "App\Http\Controllers\Store\ForgetPasswordController@forget")->name("password.email");
    Route::view('/forgot-password/{token}', "store-customer.auth.reset-password")->name('password.reset');
    Route::post('/forgot-password/reset', "App\Http\Controllers\Store\ForgetPasswordController@reset")->name('password.update');
});

Route::middleware("auth:customer")->group(function () {
    Route::get("/logout", "App\Http\Controllers\Store\AuthController@logout")->name("logout");
});

