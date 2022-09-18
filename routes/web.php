<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;

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
    return view('admin.index');
})->name('dashboard');

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::prefix('users')->group(function(){
  Route::get('/view', [UserController::class, 'index'])->name('users.view');
  Route::get('/add', [UserController::class, 'create'])->name('user.add');
  Route::post('/store', [UserController::class, 'store'])->name('user.store');
  Route::get('/edit/{id}', [UserController::class, 'edit']);
  Route::post('/update/{id}', [UserController::class, 'update']);
  Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

});
