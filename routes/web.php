<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::post('/login-proses', [AuthController::class, 'login_proses'])->name('login-proses');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register-proses', [AuthController::class, 'register_proses'])->name('register-proses');

Route::get('/user/home/{id}', [HomeController::class, 'login'])->name('user.home');
Route::get('/user/produk/{id}', [HomeController::class, 'produk'])->name('user.produk');
Route::get('/user/profile/{id}', [UserController::class, 'index'])->name('user.profile');
Route::get('/user/edit-profile/{id}', [UserController::class, 'edit'])->name('user.edit-profile');
Route::post('/user/update-profile/{id}', [UserController::class, 'update'])->name('user.update-profile');

Route::get('/user/home/{user_id}/detail-produk/{produk_id}', [TransaksiController::class, 'detail'])->name('user.detail-produk');
Route::Post('/user/home/{user_id}/detail-produk/{produk_id}/tambah-keranjang', [TransaksiController::class, 'tambahKeranjang'])->name('user.detail-produk.keranjang');

Route::get('/user/home/{user_id}/keranjang', [TransaksiController::class, 'keranjang'])->name('user.keranjang');
Route::get('api/user/{user_id}/keranjang', [TransaksiController::class, 'isiKeranjang']);
// Route::get('/user/home/{user_id}/keranjang/hapus/{id}', [TransaksiController::class, 'hapusKeranjang']);
Route::post('/checkout', [TransaksiController::class, 'checkout']);

Route::get('/user/home/{user_id}/pembayaran', [TransaksiController::class, 'pembayaran'])->name('user.pembayaran');
Route::post('/user/home/{user_id}/pembayaran-proses', [TransaksiController::class, 'pembayaranProses'])->name('user.pembayaran-proses');

Route::get('/user/home/{user_id}/pesanan', [TransaksiController::class, 'pesanan'])->name('user.pesanan');
Route::get('/user/home/{user_id}/pesanan/delete-pesanan/{id}', [TransaksiController::class, 'destroy'])->name('user.pesanan-delete');

Route::get('/admin', [DashboardController::class, 'index'])->name('admin');
Route::get('/admin/transaksi', [DashboardController::class, 'transaksi'])->name('admin.transaksi');
Route::get('/admin/transaksi/transaksi-detail/{id}', [DashboardController::class, 'transaksiDetail'])->name('admin.transaksi-detail');
Route::post('/admin/transaksi/transaksi-sukses/{id}', [DashboardController::class, 'transaksiSukses'])->name('admin.transaksi-sukses');
Route::post('/admin/transaksi/transaksi-gagal/{id}', [DashboardController::class, 'transaksiGagal'])->name('admin.transaksi-gagal');
Route::post('/admin/transaksi/transaksi-proses/{id}', [DashboardController::class, 'transaksiProses'])->name('admin.transaksi-proses');

Route::get('admin/tambah-produk', [DashboardController::class, 'create'])->name('admin.tambah-produk');
Route::post('admin/tambah-produk/store', [DashboardController::class, 'store'])->name('admin.tambah-produk.store');
Route::get('admin/edit-produk/{id}', [DashboardController::class, 'edit'])->name('admin.edit-produk');
Route::post('admin/update-produk/{id}', [DashboardController::class, 'update'])->name('admin.update-produk');
Route::get('admin/delete-produk/{id}', [DashboardController::class, 'destroy'])->name('admin.delete-produk');