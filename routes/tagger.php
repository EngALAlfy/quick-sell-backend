<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tagger Routes
|--------------------------------------------------------------------------
|
| Here is where you can register tagger routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect("/", "/tagger/home");

Route::middleware("guest:tagger")->group(function () {
    Route::view("/login", "tagger.auth.login");
    Route::post("/login", "App\Http\Controllers\Tagger\AuthController@login")->name("login");

    Route::view("/forgot-password", "tagger.auth.forget-password")->name("forget-password");
    Route::post("/forgot-password", "App\Http\Controllers\Tagger\ForgetPasswordController@forget")->name("password.email");
    Route::view('/forgot-password/{token}', "tagger.auth.reset-password")->name('password.reset');
    Route::post('/forgot-password/reset', "App\Http\Controllers\Tagger\ForgetPasswordController@reset")->name('password.update');
});

Route::middleware("auth:tagger")->group(function () {
    Route::post("/logout", "App\Http\Controllers\Tagger\AuthController@logout")->name("logout");
});

/*
 * Tagger Resources Area
 */
Route::middleware("auth:tagger")->group(function () {
    Route::get("/home", "App\Http\Controllers\Tagger\HomeController@index")->name("home.index");

    Route::prefix('customers')->group(function () {
        Route::get("/", "App\Http\Controllers\Tagger\CustomerController@index")->name("customers.index");
        Route::get("/{customer}", "App\Http\Controllers\Tagger\CustomerController@show")->name("customers.show");
        Route::get("/status/{customer}", "App\Http\Controllers\Tagger\CustomerController@status")->name("customers.status");
        Route::put("/trigger/block/{customer}", "App\Http\Controllers\Tagger\CustomerController@triggerBlock")->name("customers.trigger.block");
    });
    Route::resource("orders", \App\Http\Controllers\Tagger\OrderController::class)->only(["index" , "show"]);
    Route::resource("categories", \App\Http\Controllers\Tagger\CategoryController::class);
    Route::resource("pages", \App\Http\Controllers\Tagger\PageController::class);
    Route::resource("help-tickets", \App\Http\Controllers\Tagger\HelpTicketController::class);
    Route::resource("products", \App\Http\Controllers\Tagger\ProductController::class);
    Route::resource("order-transactions", \App\Http\Controllers\Tagger\OrderTransactionController::class);
    Route::resource("wallet-transactions", \App\Http\Controllers\Tagger\WalletTransactionController::class);
    Route::resource("notifications", \App\Http\Controllers\Tagger\NotificationController::class);
    Route::resource("store-features", \App\Http\Controllers\Tagger\StoreFeatureController::class);
    Route::resource("tags", \App\Http\Controllers\Tagger\TagController::class);
    Route::get("/customer-reviews", [\App\Http\Controllers\Tagger\CustomerReviewController::class, 'index'])->name('customer-reviews.index');
});

/*
 * Tagger Special Area
 */
Route::middleware("auth:tagger")->group(function () {
    Route::get("/profile", "App\Http\Controllers\UserController@profile")->name("profile.index");
    Route::get("/profile/edit", "App\Http\Controllers\UserController@editProfile")->name("profile.edit");

    Route::redirect("/settings", "/tagger/settings/profile")->name("settings.index");
    Route::get("/settings/profile", "App\Http\Controllers\Tagger\StoreSettingController@profile")->name("settings.profile");
    Route::get("/settings/home", "App\Http\Controllers\Tagger\StoreSettingController@home")->name("settings.home");
    Route::post("/settings/profile", "App\Http\Controllers\Tagger\StoreSettingController@profileStore")->name("settings.profile.store");
    Route::post("/settings/home", "App\Http\Controllers\Tagger\StoreSettingController@homeStore")->name("settings.home.store");
});
