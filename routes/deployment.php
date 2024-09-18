<?php

use App\Http\Controllers\Shared\DevelopmentController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/deploy/result', [DevelopmentController::class, 'result'])->name('deploy.result');
    Route::get('/deploy/clear-cache', [DevelopmentController::class, 'clearCache'])->name('deploy.clearCache');
    Route::get('/deploy/migrate', [DevelopmentController::class, 'migrate'])->name('deploy.migrate');
    Route::get('/deploy/seed/{seeder?}', [DevelopmentController::class, 'seed'])->name('deploy.seed');
    Route::get('/deploy/storage-link', [DevelopmentController::class, 'storageLink'])->name('deploy.storageLink');
    Route::get('/deploy/migrate-refresh', [DevelopmentController::class, 'migrateRefresh'])->name('deploy.migrateRefresh');
    Route::get('/deploy/migrate-refresh-seed', [DevelopmentController::class, 'migrateRefreshSeed'])->name('deploy.migrateRefreshSeed');
    Route::get('/deploy/down', [DevelopmentController::class, 'down'])->name('deploy.down');
    Route::get('/deploy/up', [DevelopmentController::class, 'up'])->name('deploy.up');
    Route::get('/deploy/deployment', [DevelopmentController::class, 'deployment'])->name('deploy.deployment');
});
