<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\MultiController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ChangePasswordController;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Support\Facades\DB;

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
    $about = DB::table('abouts')->first();
    $images = Multipic::all();
    return view('home', compact('brands', 'about', 'images'));
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

// Admin route
Route::get('/home/slider', [SliderController::class, 'index'])->name('home.slider');
Route::get('/add/slider', [SliderController::class, 'create'])->name('add.slider');
Route::post('/store/slider', [SliderController::class, 'store'])->name('store.slider');
Route::get('/edit/slider/{id}', [SliderController::class, 'edit']);
Route::post('/update/slider/{id}', [SliderController::class, 'update']);
Route::get('/delete/slider/{id}', [SliderController::class, 'delete']);

//
Route::get('/home/about', [AboutController::class, 'index'])->name('home.about');
Route::get('/add/about', [AboutController::class, 'create'])->name('add.about');
Route::post('/store/about', [AboutController::class, 'store'])->name('store.about');
Route::get('/edit/about/{id}', [AboutController::class, 'edit']);
Route::post('/update/about/{id}', [AboutController::class, 'update']);
Route::get('/delete/about/{id}', [AboutController::class, 'delete']);

//front portfolio
Route::get('/portfolio', [MultiController::class, 'show'])->name('portfolio');

//
Route::get('/admin/contact', [ContactController::class, 'index'])->name('admin.contact');
Route::get('/add/contact', [ContactController::class, 'create'])->name('add.contact');
Route::post('/store/contact', [ContactController::class, 'store'])->name('store.contact');
Route::get('/edit/contact/{id}', [ContactController::class, 'edit']);
Route::post('/update/contact/{id}', [ContactController::class, 'update']);
Route::get('/delete/contact/{id}', [ContactController::class, 'delete']);

//front contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact');


//
Route::get('/admin/message', [MessageController::class, 'index'])->name('admin.message');
Route::get('/delete/message/{id}', [MessageController::class, 'delete']);

//front contact
Route::post('/message', [ContactController::class, 'store'])->name('store.contact');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    return view('admin.index');
})->name('dashboard');


Route::get('/user/logout', [BrandController::class, 'logout'])->name('user.logout');

Route::get('/user/password', [ChangePasswordController::class, 'changePassword'])->name('change.password');
Route::post('/password/update', [ChangePasswordController::class, 'update'])->name('update.password');
