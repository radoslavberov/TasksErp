<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use \App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use \App\Http\Controllers\Admin\RoleController;
use \App\Http\Controllers\Admin\PermissionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/', function () {
    return view('frontend.homepage');
});
Route::get('/about_us', function () {
    return view('frontend.about_us');
});


Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
});




Route::group(['prefix' => 'admin'], function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::get('/roles/edit/{role:name}', [RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::patch('/roles/edit/{role:name}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/roles/delete/{role:name}', [RoleController::class, 'destroy'])->name('admin.roles.delete');

    Route::get('/permissions', [PermissionController::class, 'index'])->name('admin.permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('admin.permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('admin.permissions.store');
    Route::get('/permissions/edit/{permission:name}', [PermissionController::class, 'edit'])->name('admin.permissions.edit');
    Route::put('/permissions/edit/{permission:name}', [PermissionController::class, 'update'])->name('admin.permissions.update');
    Route::delete('/permissions/delete/{permission:name}', [PermissionController::class, 'destroy'])->name('admin.permissions.delete');

});


Route::group(['prefix' => 'employees'], function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('update/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/delete/{id}', [EmployeeController::class, 'delete'])->name('employees.delete');
});

Route::group(['prefix' => 'tasks'], function () {
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('update/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/delete/{id}', [TaskController::class, 'delete'])->name('tasks.delete');
});


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/welcome', [HomeController::class, 'website'])->name('welcome');
