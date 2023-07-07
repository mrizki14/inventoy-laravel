<?php

use App\Models\BarangMasuk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\CodesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\LogBarangController;
use App\Http\Controllers\ManageRole;
use App\Http\Controllers\ManageRoleController;
use App\Models\BarangKeluar;

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

// LOGIN
Route::get('/', [AuthController::class, 'login'])->middleware('guest')->name('/');
Route::post('/', [AuthController::class, 'auth'])->middleware('guest'); 
Route::get('/logout',[AuthController::class, 'logout'])->middleware('auth');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');


//ROLE
Route::get('role', [ManageRoleController::class, 'index']);
Route::get('role/add', [ManageRoleController::class, 'tambah']);
Route::post('role/add', [ManageRoleController::class, 'store'])->name('add.role');
Route::get('role/edit/{id}', [ManageRoleController::class, 'edit']);
Route::put('role/edit/{id}', [ManageRoleController::class, 'update'])->name('update.role');
Route::get('role/delete/{id}', [ManageRoleController::class, 'delete'])->name('delete.role');

// Kategori
Route::middleware(['auth'])->group(function() {
    Route::get('/kategori', [CategoriesController::class, 'kategori'])->name('kategori');
    Route::get('/kategori_add', [CategoriesController::class, 'tambah']);
    Route::post('/kategori_barang', [CategoriesController::class, 'store']);
    Route::get('/edit_kategori_barang/{id}', [CategoriesController::class, 'edit']);
    Route::put('/edit_kategori_barang/{id}', [CategoriesController::class, 'update'])->name('update.kategori');
    Route::get('/delete_category/{id}', [CategoriesController::class, 'hapus'])->name('hapus.kategori');
});

// Kode Barang
Route::middleware(['auth'])->group(function() {
    Route::get('/kode_barang', [CodesController::class, 'kode'])->name('code');
    Route::get('/kode_barang_add', [CodesController::class, 'tambah']);
    Route::post('/kode_barang', [CodesController::class, 'store']);
    Route::get('/edit_kode_barang/{id}', [CodesController::class, 'edit']);
    Route::put('/edit_kode_barang/{id}', [CodesController::class, 'update'])->name('update.codes');
    Route::get('/delete_kode_barang/{id}', [CodesController::class, 'hapus']);
    Route::get('/log_barang', [CodesController::class, 'logBarang']);
    
});



Route::get('/dataAdmin', [HomeController::class, 'dataAdmin']);

// Barang Masuk
Route::middleware('auth')->group(function(){
    Route::get('/barang_masuk', [BarangMasukController::class, 'index'])->name('barang.masuk');
    Route::get('/tambah_barang', [BarangMasukController::class, 'tambah']);
    Route::post('/tambah_barang', [BarangMasukController::class, 'store'])->name('add_barang');
    Route::get('/edit_barang_masuk/{id}',[BarangMasukController::class, 'edit']);
    Route::put('/edit_barang_masuk/{id}',[BarangMasukController::class, 'update'])->name('update.barang');
    Route::get('/delete_barang_masuk/{id}', [BarangMasukController::class, 'hapus']);



});

// Barang Keluar
Route::middleware('auth')->group(function(){
    Route::get('/barang_keluar', [BarangKeluarController::class, 'index'])->name('barang.keluar');
    Route::get('/tambah_barang_keluar', [BarangKeluarController::class, 'tambah']);
    Route::post('/tambah_barang_keluar', [BarangKeluarController::class, 'store'])->name('add.barang.keluar');
    Route::get('/edit_barang_keluar/{id}',[BarangKeluarController::class, 'edit']);
    Route::put('/edit_barang_keluar/{id}',[BarangKeluarController::class, 'update'])->name('update.barang.keluar');
    Route::get('/delete_barang_keluar/{id}', [BarangKeluarController::class, 'hapus']);

});




// Manage User
Route::middleware(['auth','adminAkses'])->group(function() {
    Route::get('/manage_user', [ManageUserController::class, 'index'])->name('user.manage');
    Route::get('/user_add', [ManageUserController::class, 'tambah']);
    Route::post('/user_add', [ManageUserController::class, 'store'])->name('user.add');
    Route::get('/edit_user/{id}', [ManageUserController::class, 'edit']);
    Route::put('/edit_user/{id}', [ManageUserController::class, 'update'])->name('user.update');
    Route::get('/delete_user/{id}', [ManageUserController::class, 'hapus']);
    Route::get('/filter_user', [ManageUserController::class, 'filter'])->name('filter.user'); 
});

