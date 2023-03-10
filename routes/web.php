<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Admin\AbsenAll;
use App\Http\Livewire\Admin\History;
use App\Http\Livewire\Admin\Persentase;
use App\Http\Livewire\Admin\RoleMgmt;
use App\Http\Livewire\Admin\UserMgmt;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[AuthController::class,'index'])->name('index');
Route::post('proseslogin', [AuthController::class,'login'])->name('login');
Route::get('logout',[AuthController::class,'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function(){
    Route::group(['middleware' => ['cekrole:admin']], function(){
        Route::get('admin/persentase', Persentase::class)->name('persentase');
        Route::get('admin/history', History::class)->name('history');
        Route::get('admin/usermgmt', UserMgmt::class)->name('usermgmt');
        Route::get('admin/rolemgmt', RoleMgmt::class)->name('rolemgmt');
        Route::get('admin', AbsenAll::class)->name('indexadmin');
        Route::get('admin/export/{bln?}/{jbtn?}', [AdminController::class, 'export'])->name('export');
    });
    Route::group(['middleware' => ['cekrole:user']], function(){
        Route::get('user', [UserController::class,'index'])->name('indexuser');
        Route::post('user/ayoabsen', [UserController::class,'ayoAbsen'])->name('ayoabsen');
        Route::get('user/history', History::class)->name('userhistory');
    });
});
