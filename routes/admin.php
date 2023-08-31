<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CodeController;
use App\Http\Controllers\Api\TermController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\CollageController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\SpecializationController;

Route::prefix('admin')->middleware(['auth:sanctum','role:admin'])->group(function () {
    
    Route::apiResource('/users', UserController::class)->except(['store','update']);

    Route::get('/users/deleted', [UserController::class, 'deletedUsers']);
    Route::patch('/users/{id}/restore', [UserController::class, 'restoreUser']);

    Route::apiResource('/codes', CodeController::class);

    Route::apiResource('/categories', CategoryController::class);

    Route::apiResource('/collages', CollageController::class);
    
    Route::apiResource('/specializations', SpecializationController::class);

    Route::apiResource('/terms', TermController::class);
    
    Route::apiResource('/questions', QuestionController::class);

    Route::apiResource('/answers', AnswerController::class);

    Route::apiResource('/sliders', SliderController::class);

    Route::apiResource('/complaints', ComplaintController::class);

    Route::patch('/fcm-token', [NotificationController::class, 'updateToken'])->name('fcmToken');
    Route::post('/send-notification',[NotificationController::class,'notification'])->name('notification');
});
