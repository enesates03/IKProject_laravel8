<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/a', 'App\Http\Controllers\HomeController@index')->name('home_index')->middleware('auth');
Route::get('/admin/login', 'App\Http\Controllers\HomeController@login')->name('admin_login');
Route::post('/admin/logincheck', 'App\Http\Controllers\HomeController@logincheck')->name('admin_logincheck');
Route::get('/admin/logout', 'App\Http\Controllers\HomeController@logout')->name('admin_logout');

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::prefix('company')->group(function () {
        Route::get('/', 'App\Http\Controllers\CompanyController@index')->name('company_index');
        Route::get('create', 'App\Http\Controllers\CompanyController@create')->name('company_create');
        Route::post('store', 'App\Http\Controllers\CompanyController@store')->name('company_store');
        Route::get('edit/{id}', 'App\Http\Controllers\CompanyController@edit')->name('company_edit');
        Route::post('update/{id}', 'App\Http\Controllers\CompanyController@update')->name('company_update');
        Route::get('destroy/{id}', 'App\Http\Controllers\CompanyController@destroy')->name('company_destroy');
    });

    Route::prefix('employee')->group(function (){
        Route::get('/','App\Http\Controllers\EmployeeController@index')->name('employee_index');
        Route::get('create', 'App\Http\Controllers\EmployeeController@create')->name('employee_create');
        Route::post('store', 'App\Http\Controllers\EmployeeController@store')->name('employee_store');
        Route::get('edit/{id}', 'App\Http\Controllers\EmployeeController@edit')->name('employee_edit');
        Route::post('update/{id}', 'App\Http\Controllers\EmployeeController@update')->name('employee_update');
        Route::get('destroy/{id}', 'App\Http\Controllers\EmployeeController@destroy')->name('employee_destroy');
    });

});

Route::redirect('/','/a');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin_login'); //dashboard admin_login
})->name('dashboard');
