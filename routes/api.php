<?php

use App\Http\Controllers\StatusTaskController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResources([
        'tasks' => TaskController::class,
    ]);

    Route::prefix('/status')->group(function () {
        Route::get('/', [StatusTaskController::class, 'index']);
    });
});