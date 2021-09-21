<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


use App\Http\Livewire\Customers;
use App\Http\Livewire\Tasks;
// use App\Http\Livewire\Roles;
// use App\Http\Livewire\Users;


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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('customers', Customers::class);

Route::get('tasks', Tasks::class);

// Route::get('users', Users::class);

// Route::get('roles', Roles::class);


// Route::get('/tasks', [TaskController::class, 'index'])->middleware(['auth'])->name('tasks');



