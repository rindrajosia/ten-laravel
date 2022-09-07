<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\MultiController;
use App\Models\Brand;

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
    $brands = Brand::all();
    return view('home', compact('brands'));
});

Route::get('/category/all', [CategoryController::class, 'index'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'store'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'update']);

Route::get('/category/softdelete/{id}', [CategoryController::class, 'softDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'restore']);
Route::get('/category/remove/{id}', [CategoryController::class, 'remove']);

/// for Brand
Route::get('/brand/all', [BrandController::class, 'index'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'store'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'delete']);

/// Multi image
Route::get('/multi/image', [MultiController::class, 'index'])->name('multi.image');
Route::post('/multi/add', [MultiController::class, 'store'])->name('store.image');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    return view('admin.index');
})->name('dashboard');
Route::get('/user/logout', [BrandController::class, 'logout'])->name('user.logout');
