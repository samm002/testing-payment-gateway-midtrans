<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;

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

Route::get('/tes', [DonationController::class, 'homePage'])->name('homePage');
Route::get('/', [DonationController::class, 'index'])->name('index');

Route::post('/donate', [DonationController::class, 'donate'])->name('donate');
Route::get('/invoice/{id}', [DonationController::class, 'invoice'])->name('invoice');
