<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/email', function () {
    return new \App\Mail\SeriesCreated('Loki',1, 2, 12);
});

Route::get('/', function () {
    return to_route('series.index');
});

Route::resource('/series', SeriesController::class)->except(['show']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/series/{series}/season', [SeasonsController::class, 'index'])->name('seasons.index');
    Route::get('/seasons/{season}/episode', [EpisodesController::class, 'index'])->name('episodes.index');
    Route::post('/seasons/{season}/episode', [EpisodesController::class, 'update'])->name('episodes.update');
});

require __DIR__.'/auth.php';
