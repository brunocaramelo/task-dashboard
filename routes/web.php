<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\{TaskBoardController,
                         HomeController};
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::group(['prefix'=>'dashboard', 'as'=>'dashboard.'], function(){
    Route::get('/', [HomeController::class, 'dashboard'])->name(name: 'index');
})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix'=>'tasks', 'as'=>'tasks.'], function(){
        Route::get('/', [TaskBoardController::class, 'search'])->name('dashboard');

        Route::get('/new',  [TaskBoardController::class, 'createForm'])->name('form-create');
        Route::post('/',  [TaskBoardController::class, 'create'])->name('send-create');

        Route::get("/{id}",  [TaskBoardController::class, 'updateForm'])->name('form-update');
        Route::put('/{id}',  [TaskBoardController::class, 'update'])->name('send-update');
    });
});

require __DIR__.'/auth.php';
