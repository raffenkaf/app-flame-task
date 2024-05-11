<?php

use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\Api\JobLogController;
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

Route::get('/', function () {
    return view('welcome');
});
