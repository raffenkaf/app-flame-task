<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\JobLogController;
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

Route::put('/data', [DataController::class, 'updateAction']);
Route::get('/data', [DataController::class, 'getAction']);
Route::get('/jobs', [JobLogController::class, 'getAction']);
Route::delete('/data', [DataController::class, 'deleteAction']);

Route::get('/', function () {
    return view('welcome');
});
