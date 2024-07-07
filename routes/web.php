<?php

use App\Http\Controllers\ServiceController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/create', [ServiceController::class, 'showCreateForm'])->name('create');
    Route::post('/create', [ServiceController::class, 'createService'])->name('store');
    Route::post('/suspend', [ServiceController::class, 'suspendService'])->name('suspend');
    Route::post('/terminate', [ServiceController::class, 'terminateService'])->name('terminate');
});
