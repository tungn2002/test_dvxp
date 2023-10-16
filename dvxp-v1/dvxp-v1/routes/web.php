<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\GheController;
use App\Http\Controllers\LichChieuController;
use App\Http\Controllers\PhimController;
use App\Http\Controllers\PhongController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VeController;
use App\Http\Controllers\GiaoDienController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*
Route::get('/', function () {
    return view('danhsachchucvu');
});*/
//


Route::get('/danhsachchucvu', [ChucVuController::class, 'index'])->name('danhsachchucvu');
Route::get('/themmoichucvu', [ChucVuController::class, 'create']);

Route::post('/themchucvu', [ChucVuController::class, 'store']);
Route::get('suachucvu/id={id}', [ChucVuController::class, 'edit']);
Route::put('capnhatchucvu/id={id}', [ChucVuController::class, 'update']);
Route::delete('xoachucvu/id={id}', [ChucVuController::class, 'destroy']);


Route::get('/danhsachphong', [PhongController::class, 'index'])->name('danhsachphong');
Route::get('/themmoiphong', [PhongController::class, 'create']);

Route::post('/themphong', [PhongController::class, 'store']);
Route::get('suaphong/id={id}', [PhongController::class, 'edit']);
Route::put('capnhatphong/id={id}', [PhongController::class, 'update']);
Route::delete('xoaphong/id={id}', [PhongController::class, 'destroy']);


Route::get('/danhsachphim', [PhimController::class, 'index'])->name('danhsachphim');
Route::get('/themmoiphim', [PhimController::class, 'create']);

Route::post('/themphim', [PhimController::class, 'store']);
Route::get('suaphim/id={id}', [PhimController::class, 'edit']);
Route::put('capnhatphim/id={id}', [PhimController::class, 'update']);
Route::delete('xoaphim/id={id}', [PhimController::class, 'destroy']);


Route::get('/danhsachlichchieu', [LichChieuController::class, 'index'])->name('danhsachlichchieu');
Route::get('/themmoilichchieu', [LichChieuController::class, 'create']);

Route::post('/themlichchieu', [LichChieuController::class, 'store']);
Route::get('sualichchieu/id={id}', [LichChieuController::class, 'edit']);
Route::put('capnhatlichchieu/id={id}', [LichChieuController::class, 'update']);
Route::delete('xoalichchieu/id={id}', [LichChieuController::class, 'destroy']);


Route::get('/danhsachghe', [GheController::class, 'index'])->name('danhsachghe');
Route::get('/themmoighe', [GheController::class, 'create']);

Route::post('/themghe', [GheController::class, 'store']);
Route::get('suaghe/id={id}', [GheController::class, 'edit']);
Route::put('capnhatghe/id={id}', [GheController::class, 'update']);
Route::delete('xoaghe/id={id}', [GheController::class, 'destroy']);


Route::get('/danhsachve', [VeController::class, 'index'])->name('danhsachve');
Route::get('/themmoive', [VeController::class, 'create']);

Route::post('/themve', [VeController::class, 'store']);
Route::get('suave/id={id}', [VeController::class, 'edit']);
Route::put('capnhatve/id={id}', [VeController::class, 'update']);
Route::delete('xoave/id={id}', [VeController::class, 'destroy']);


Route::get('/trangchu', [GiaoDienController::class, 'index'])->name('trangchu');
Route::get('/dangnhap', [GiaoDienController::class, 'login'])->name('dangnhap');
Route::get('/dangki', [GiaoDienController::class, 'signup'])->name('dangki');
Route::get('/dangxuat', [GiaoDienController::class, 'dangxuat'])->name('dangxuat');
Route::get('thongtinchung/id={id}', [GiaoDienController::class, 'thongtinchung'])->name('thongtinchung');
Route::get('/doimatkhau', [GiaoDienController::class, 'doimk'])->name('doimatkhau');

Route::post('/xulydangnhap', [GiaoDienController::class, 'xulydangnhap'])->name('xulydangnhap');
Route::post('/xulydangky', [GiaoDienController::class, 'xulydangky'])->name('xulydangky');
Route::post('/xulydoimatkhau/{id}', [GiaoDienController::class, 'xulydoimatkhau'])->name('xulydoimatkhau');

//
Route::get('datve/id={id}', [PhimController::class, 'datve']);
Route::get('datve1/id={id}', [PhimController::class, 'datve1']);
Route::post('datve2', [PhimController::class, 'datve2']);
Route::post('datve3', [PhimController::class, 'datve3']);
Route::post('datve4', [PhimController::class, 'datve4']);
Route::post('datve5', [PhimController::class, 'datve5']);
