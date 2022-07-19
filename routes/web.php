<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/dashboard',[FileController::class,'store'])
                ->middleware('auth')
                ->name('uploadFile');
Route::get('/dashboard',[FileController::class,'index'])
                ->middleware('auth')
                ->name('dashboard');

Route::get('/files/{filename}',[FileController::class,'downloadFile'])
                ->name('downloadFile');

require __DIR__.'/auth.php';
