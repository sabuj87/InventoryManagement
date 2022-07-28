<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;

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

Route::get('/', [BillController::class, 'show'])->name("bill");
Route::get('/findbill',[BillController::class, 'findBill'])->name('find');
Route::post('/store',[BillController::class, 'store'])->name('store');
Route::post('/storeinv',[BillController::class, 'storeInv'])->name('storeInv');

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
Route::get('/conclear', function() {
    Artisan::call('config:clear');
    return "config is cleared";
});



?>