<?php

use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;


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

Route::get('/', [LeadController::class, 'create'])->name('lead.create');
Route::post('/lead', [LeadController::class, 'store'])->name('lead.store');

Route::get('/success', fn(): View => view('success'))->name('success');
Route::get('/error', fn(): View => view('error'))->name('error');
