<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
Route::get('/role', [RoleController::class, 'index'])->name('roles.index');
Route::resource('users', UserController::class)->names('users');
Route::resource('posts', PostController::class)->names('posts');
Route::resource('categories', CategoryController::class)->names('categories');
Route::resource('tenants', TenantController::class)->names('tenants');
Route::resource('permissions', PermissionController::class)->names('permissions');
Route::put('/roles/{role}/permissions', [PermissionController::class, 'update'])->name('role.permissions.update');
Route::post('/roles/assign', [RoleController::class, 'assign'])
    ->name('roles.assign');
});


require __DIR__.'/auth.php';
