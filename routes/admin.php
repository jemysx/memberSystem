<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PublicController;
use App\Http\Controllers\Admin\IndexController;
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


//后台管理路由

Route::middleware(['admin.login'])->group(function() {

    //Public控制器
    Route::controller(\App\Http\Controllers\Admin\PublicController::class)->group(function (){
        Route::any('/login','login')->name('admin.login');
        Route::get('/logout','logout')->name('admin.logout');
        Route::get('/noauth','noauth')->name('admin.noauth');
    });

    //Index控制器
    Route::controller(\App\Http\Controllers\Admin\IndexController::class)->group(function (){
        Route::get('/', 'index')->name('admin.index');
        Route::get('/home', 'home')->name('admin.home');
        Route::get('/download', 'download')->name('admin.download');
    });

});
//    Route::any('/login', [PublicController::class, 'login'])->name('admin.login');
//    Route::any('/', [IndexController::class, 'index'])->name('admin.index');
