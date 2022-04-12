<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\RequisitionsController;
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

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::apiResource('requisitions', RequisitionsController::class)->only(['store','update']);
    Route::apiResource('items', ItemsController::class)->only(['store','update']);
    Route::get('/user', fn(Request $request) => $request->user());
});

Route::apiResource('requisitions', RequisitionsController::class)->only(['index','show','destroy']);
Route::apiResource('items', ItemsController::class)->only(['index','show','destroy']);
Route::post('/signup', [AuthController::class, 'signUp'])->name('signUp');
Route::post('/signin', [AuthController::class, 'signIn'])->name('signIn');
Route::fallback(static fn () => abort(404, 'API resource not found'));
