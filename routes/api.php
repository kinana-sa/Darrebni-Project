<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CollageController;
use App\Http\Controllers\Api\SpecializationController;
use App\Http\Controllers\Api\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/collage/specialization/{uuid}',[SpecializationController::class,'getCollageSpec']);
    Route::put('/auth/update',[UserController::class,'update']);
});

Route::prefix('auth')->group(function(){

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

});

Route::get('/collages',[CollageController::class,'index']);
Route::get('/collage/show/{uuid}',[CollageController::class,'show']);
Route::post('/collage/create',[CollageController::class,'store']);
Route::put('/collage/update/{uuid}',[CollageController::class,'update']);
Route::DELETE('/collage/destroy/{uuid}',[CollageController::class,'destroy']);


Route::get('/specializations',[SpecializationController::class,'index']);
Route::post('/specialization/create',[SpecializationController::class,'store']);
Route::put('/specialization/update/{uuid}',[SpecializationController::class,'update']);
Route::delete('/specialization/destroy/{uuid}',[SpecializationController::class,'destroy']);


Route::get('/categories',[CategoryController::class,'index']);
Route::post('/category/create',[CategoryController::class,'store']);
Route::get('/category/show/{uuid}',[CategoryController::class,'show']);
Route::delete('/category/destroy/{uuid}',[CategoryController::class,'destroy']);
Route::put('/category/update/{uuid}',[CategoryController::class,'update']);



