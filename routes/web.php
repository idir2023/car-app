<?php

use App\Http\Controllers\CarsController;
use App\Http\Controllers\MarkeController;
use App\Http\Controllers\ModelCarController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelImportController;


Route::get('/', function () {
    return view('client.index');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('markes', MarkeController::class);
Route::post('/import-excel', [ExcelImportController::class, 'import'])->name('excel.import');


Route::resource('model_cars', ModelCarController::class);

Route::get('/get-models/{id}', [CarsController::class, 'getModels'])->name('cars.getModels');

Route::resource('cars', CarsController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
