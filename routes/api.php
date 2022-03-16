<?php

use App\Http\Controllers\BnplController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('edit/{id}',[BnplController::class,'edit']);
// Route::get('edit/{id}',[BnplController::class,'edit']);
Route::post('edit/{id}',[BnplController::class,'update']);
Route::post('bnpl/add',[BnplController::class,'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
