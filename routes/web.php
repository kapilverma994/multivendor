<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
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

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Admin Dashboard
Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){


Route::get('/',[AdminController::class,'admin'])->name('admin');
//Banner Section
Route::resource('banners', BannerController::class);
Route::post('bannner/status',[BannerController::class,'status'])->name('banner.status');


//category section
Route::resource('category', CategoryController::class);
Route::post('category/status',[CategoryController::class,'status'])->name('category.status');
Route::post('category/child',[CategoryController::class,'getChild'])->name('category.child');

//Brand section

Route::resource('brand', BrandController::class);
Route::post('brand/status',[BrandController::class,'status'])->name('brand.status');

//Product Section
Route::resource('product', ProductController::class);
Route::post('product/status',[ProductController::class,'status'])->name('product.status');


//user section
Route::resource('user', UserController::class);
Route::post('user/status',[UserController::class,'status'])->name('user.status');
});
