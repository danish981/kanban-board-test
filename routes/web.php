<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;

use Illuminate\Support\Facades\Route;


Route::get('/', static function () {
    return view('welcome');
});

Route::get('/dashboard', static function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/tasks/stats', [TaskController::class, 'stats'])->name('tasks.stats');
    Route::get('/tasks', [TaskController::class, 'kanban'])->name('tasks.index');
    Route::resource('tasks', TaskController::class)->except(['index', 'show']);
});

Route::get('/test', function () {
    // 2024-04-19 08:07:45
//    foreach (Task::all() as $task) {
//        $task->completed_at = '2024-04-' . random_int(1, 30) . ' 08:07:45';
//        $task->save();
//    }
});
require __DIR__ . '/auth.php';
