<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DespesasController;

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

Auth::routes();
Route::get('/', function () {
    return redirect('dashboard/home');
});

Route::prefix('dashboard')->middleware(['auth'])->group(function (){ 
    Route::get('/despesas/get',[DespesasController::class, 'getAllDespesas']);
    Route::post('/despesas/create', [DespesasController::class, 'createDespesa']);
    Route::get('/despesas/create/form', function(){
        return view('home');
    });
    Route::post('/despesas/edit/',[DespesasController::class, 'editDespesa']);
    Route::get('/despesas/edit/form', function (){
        return view('home');
    });
    Route::post('/despesa/delete', [DespesasController::class, 'deleteDespesa']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

