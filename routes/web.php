<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GetDataController;
use App\Http\Controllers\FilterDataController;
use App\Http\Controllers\AddDataController;
use App\Http\Controllers\EditDataController;
use App\Http\Controllers\DeleteDataController;

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

//GET Method
Route::middleware(['loginValid'])->group(function () {
    Route::get('/', function () {
        return redirect('/dashboard');
    });

    Route::get('/test', [GetDataController::class, 'getNamaRuang']);

    Route::get('/ruang/{name}', [PageController::class, 'viewRoom']);

    Route::get('/filter/{page}', [PageController::class, 'withFilter']);
    Route::get('/{page}', [PageController::class, 'withSidebar']);

});

Route::get('/auth/login', function () {
    return view('login');
});

Route::get('/auth/logout', [LoginController::class, 'logout']);


//POST Method
Route::post('/auth/login', [LoginController::class, 'login']);

Route::post('/add/data_users', [AddDataController::class, 'addUser']);
Route::post('/edit/data_users', [EditDataController::class, 'editUser']);
Route::post('/delete/data_users', [DeleteDataController::class, 'deleteUser']);

Route::post('/add/data_murid', [AddDataController::class, 'addMurid']);
Route::post('/edit/data_murid', [EditDataController::class, 'editMurid']);
Route::post('/delete/data_murid', [DeleteDataController::class, 'deleteMurid']);
Route::post('/filter/data_murid', [FilterDataController::class, 'filterMurid']);

Route::post('/add/data_kelas', [AddDataController::class, 'addKelas']);
Route::post('/edit/data_kelas', [EditDataController::class, 'editKelas']);
Route::post('/delete/data_kelas', [DeleteDataController::class, 'deleteKelas']);

Route::post('/add/data_guru', [AddDataController::class, 'addGuru']);
Route::post('/edit/data_guru', [EditDataController::class, 'editGuru']);
Route::post('/delete/data_guru', [DeleteDataController::class, 'deleteGuru']);

Route::post('/edit/jadwal_pelajaran', [EditDataController::class, 'editJadwalPelajaran']);
Route::post('/filter/jadwal_pelajaran', [FilterDataController::class, 'filterJadwalPelajaran']);

Route::post('/edit/absensi', [EditDataController::class, 'editAbsensi']);

Route::post('/filter/rekap_absensi', [FilterDataController::class, 'filterRekapAbsensi']);
