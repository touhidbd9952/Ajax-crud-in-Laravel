<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('category/addform',[CategoryController::class,'addform'])->name('category.addform');
Route::post('category/add',[CategoryController::class,'addcategory']);
Route::get('category/view',[CategoryController::class,'viewcategory']);
Route::get('category/edit/{id}',[CategoryController::class,'editcategory']);
Route::post('category/update/{id}',[CategoryController::class,'updatecategory']);
Route::get('category/delete/{id}',[CategoryController::class,'deletecategory']);

