<?php

use App\Http\Controllers\{PhaseController, TaskController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(static function () {

    Route::get('/tasks', [TaskController::class, 'index']);
    Route::put('/tasks/{task}', [TaskController::class, 'update']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
    Route::get('/users', [TaskController::class, 'users']);

    Route::get('/phases/{phase}', [PhaseController::class, 'show']);
    Route::delete('phases/{phase}', [PhaseController::class, 'destroy']);
    Route::post('phases/mark-as-completion', [PhaseController::class, 'markPhaseStateAsCompleted']);

});

