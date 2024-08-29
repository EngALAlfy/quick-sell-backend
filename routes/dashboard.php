<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect("/", "/admin/home");


Route::middleware("guest")->group(function () {
    Route::view("/login", "store-customer.auth.login");
    Route::post("/login", "App\Http\Controllers\Store\AuthController@login")->name("login");

    Route::view("/forgot-password", "store-customer.auth.forget-password")->name("forget-password");
    Route::post("/forgot-password", "App\Http\Controllers\Store\ForgetPasswordController@forget")->name("password.email");
    Route::view('/forgot-password/{token}', "store-customer.auth.reset-password")->name('password.reset');
    Route::post('/forgot-password/reset', "App\Http\Controllers\Store\ForgetPasswordController@reset")->name('password.update');
});

Route::middleware("auth")->group(function () {
    Route::get("/logout", "App\Http\Controllers\Store\AuthController@logout")->name("logout");
});


/*
 * Resources Area
 */
Route::middleware("auth:admin")->group(function () {
    Route::get("/home", "App\Http\Controllers\Admin\HomeController@index")->name("home.index");

    Route::resource("wallet-transactions", \App\Http\Controllers\Admin\WalletTransactionController::class);
});

/*
 *  Special Area
 */
Route::middleware("auth")->group(function () {
    Route::get("/profile", "App\Http\Controllers\UserController@profile")->name("profile.index");
    Route::get("/profile/edit", "App\Http\Controllers\UserController@editProfile")->name("profile.edit");

    Route::get("/settings", "App\Http\Controllers\SettingsController@index")->name("settings.index");
    Route::post("/settings", "App\Http\Controllers\SettingsController@store")->name("settings.store");

    Route::get("/settings/activity-log", "App\Http\Controllers\ActivityLogController@index")->name("settings.activity-log");
    Route::get("/settings/activity-log/clear-all", "App\Http\Controllers\ActivityLogController@clearAll")->name("settings.activity-log.clear-all");
    Route::get("/settings/activity-log/{log}", "App\Http\Controllers\ActivityLogController@show")->name("settings.activity-log.show");

    Route::get("/settings/backup", "App\Http\Controllers\BackupController@index")->name("settings.backup");
    Route::get('/settings/backup/restore/{name}', "App\Http\Controllers\BackupController@restore")->name('settings.backup-restore');
    Route::get('/settings/backup/create', "App\Http\Controllers\BackupController@create")->name('settings.backup-create');
    Route::get('/settings/backup/{name}', "App\Http\Controllers\BackupController@show")->name('settings.backup-show');
    Route::delete('/settings/backup/{name}', "App\Http\Controllers\BackupController@destroy")->name('settings.backup-destroy');

    Route::resource("dev-logs", \App\Http\Controllers\Admin\StoreController::class);
    Route::resource("status-logs", \App\Http\Controllers\Admin\StoreController::class);
    Route::resource("roles", \App\Http\Controllers\Admin\RoleController::class);
    Route::resource("permissions", \App\Http\Controllers\Admin\PermissionController::class);
    Route::resource("permission-groups", \App\Http\Controllers\Admin\PermissionGroupController::class);
});

Route::group(['prefix' => 'activity', 'namespace' => 'jeremykenedy\LaravelLogger\App\Http\Controllers', 'middleware' => ['auth:admin', 'activity']], function () {
    // Dashboards
    Route::get('/', 'LaravelLoggerController@showAccessLog')->name('activity');
    Route::get('/cleared', ['uses' => 'LaravelLoggerController@showClearedActivityLog'])->name('cleared');

    // Drill Downs
    Route::get('/log/{id}', 'LaravelLoggerController@showAccessLogEntry');
    Route::get('/cleared/log/{id}', 'LaravelLoggerController@showClearedAccessLogEntry');

    // Forms
    Route::delete('/clear-activity', ['uses' => 'LaravelLoggerController@clearActivityLog'])->name('clear-activity');
    Route::delete('/destroy-activity', ['uses' => 'LaravelLoggerController@destroyActivityLog'])->name('destroy-activity');
    Route::post('/restore-log', ['uses' => 'LaravelLoggerController@restoreClearedActivityLog'])->name('restore-activity');

    // LiveSearch
    Route::post('/live-search', ['uses' => 'LaravelLoggerController@liveSearch'])->name('liveSearch');
});
