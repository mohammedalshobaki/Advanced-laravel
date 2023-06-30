<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\RegisterController;
use \App\Http\Controllers\Api\ProductController;
use \App\Http\Controllers\Api\MailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(RegisterController::class)->group(function (){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::get('/sned-email', [MailController::class, 'send'] )->middleware('auth:sanctum');

Route::post('import-excel', [ProductController::class, 'import']);
Route::get('export-excel', [ProductController::class, 'export']);

Route::resource('/products', ProductController::class)->middleware(['auth:sanctum', 'adminCheck']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
