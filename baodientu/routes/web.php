<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DanhmucController;
use App\Http\Controllers\BaivietController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AjaxLoginController;
use App\Http\Controllers\CommentController;
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


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('xem-bai-viet/{id}-{slug}', [HomeController::class, 'xembaiviet'])->name('xembaiviet');
Route::get('danh-muc/{id}-{slug}', [HomeController::class, 'xemdanhmuc'])->name('xemdanhmuc');
Route::get('tim-kiem', [HomeController::class, 'timkiem'])->name('timkiem');

Auth::routes();

Route::resource('/danhmuc', DanhmucController::class);
Route::resource('/baiviet', BaivietController::class);
Route::resource('/user', UserController::class);
Route::get('phan-vaitro/{id}', [UserController::class, 'phanvaitro'])->name('user.phanvaitro');
Route::post('them-vaitro/{id}', [UserController::class, 'themvaitro'])->name('user.themvaitro');
Route::get('phan-quyen/{id}', [UserController::class, 'phanquyen'])->name('user.phanquyen');
Route::post('them-quyen/{id}', [UserController::class, 'themquyen'])->name('user.themquyen');

Route::group(['prefix' => 'ajax'], function () {
    Route::post('/login', [AjaxLoginController::class, 'login'])->name('ajax.login');
    Route::get('/logout', [AjaxLoginController::class, 'logout'])->name('ajax.logout');
    Route::post('/comment/{baiviet_id}', [AjaxLoginController::class, 'comment'])->name('ajax.comment');
});

Route::post('comment-thuong/{id}', [HomeController::class, 'storecomment'])->name('comment.store');
Route::get('show-comment-thuong/{id}', [HomeController::class, 'showcomment'])->name('showcomment');