<?php

use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Shared\UploadController;
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

Route::view("/" , "landing-page.index");
Route::post("/contact" , [HomeController::class, "contact"]);

\Livewire\Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/custom/livewire/update', $handle);
});

Route::post('/upload', [UploadController::class, "store"])->name('upload');
