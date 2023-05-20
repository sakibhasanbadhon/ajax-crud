<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use PHPUnit\TextUI\XmlConfiguration\Group;

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




Route::get('home',[HomeController::class, 'index']);




// Route::get('/home', function(){

//     return view('home');

// });



Route::get('ajaxForm', function(){
    return view('ajaxForm2');
});
Route::get('ajax/data',[AjaxController::class, 'ajaxReq'])->name('ajax.request');



Route::group(['middleware'=>['auth']], function(){
    Route::post('ajax/store',[AjaxController::class, 'ajaxStore'])->name('ajax.store');
    Route::post('ajax/get-data',[AjaxController::class, 'studentGetData'])->name('ajax.get-data');
    Route::post('ajax/edit',[AjaxController::class, 'studentEdit'])->name('ajax.edit');
    Route::post('ajax/update',[AjaxController::class, 'studentUpdate'])->name('ajax.update');
    Route::post('ajax/board-select',[AjaxController::class, 'student_board'])->name('ajax.board-select');
    Route::post('ajax/destroy',[AjaxController::class, 'studentDestroy'])->name('ajax.destroy');
});


Route::get('ajaxList', function(){
    return view('ajaxList');
});


// ajax Form Route




Auth::routes();

// Route::get('/home', [App\Http\Controllers\AjaxController::class, 'index'])->name('home');
