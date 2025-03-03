<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RhUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    
    Route::redirect('/', '/home');
    Route::view('/home', 'home')->name('home');

    // User profile
    Route::get('/user/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::post('/user/profile/update-password', [ProfileController::class, 'updatePassword'])->name('user.profile.update-password');
    Route::post('/user/profile/update-user-data', [ProfileController::class, 'updateUserData'])->name('user.profile.update-user-data');

    // Departments
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('/departments/store', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::get('/departments/{department}/delete', [DepartmentController::class, 'delete'])->name('departments.delete');
    Route::post('/departments/destroy', [DepartmentController::class, 'destroy'])->name('departments.destroy');

    // RH colaborators
    Route::get('/rh/colaborators', [RhUserController::class, 'index'])->name('rh.colaborators');
    Route::get('/rh/colaborators/create', [RhUserController::class, 'create'])->name('rh.colaborators.create');
    Route::post('/rh/colaborators/store', [RhUserController::class, 'store'])->name('rh.colaborators.store');
    //Route::get('/rh/colaborators/{user}/edit', [RhUserController::class, 'edit'])->name('rh.colaborators.edit');
    //Route::get('/rh/colaborators/{user}/delete', [RhUserController::class, 'delete'])->name('rh.colaborators.delete');
    //Route::post('/rh/colaborators/destroy', [RhUserController::class, 'destroy'])->name('rh.colaborators.destroy');
});