<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;

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

Route::get('/a', [HomeController::class, 'index'])->name('home.index')->middleware('auth');
Route::get('/admin/login',[HomeController::class, 'login'])->name('admin_login');
Route::post('/admin/logincheck', [HomeController::class, 'logincheck'])->name('admin_logincheck');
Route::get('/admin/logout', [HomeController::class, 'logout'])->name('admin_logout');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::prefix('company')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('company.index');
        Route::get('create', [CompanyController::class, 'create'])->name('company.create');
        Route::post('store', [CompanyController::class, 'store'])->name('company.store');
        Route::get('edit/{id}', [CompanyController::class, 'edit'])->name('company.edit');
        Route::post('update/{id}', [CompanyController::class, 'update'])->name('company.update');
        Route::get('destroy/{id}', [CompanyController::class, 'destroy'])->name('company.destroy');
    });

    Route::prefix('employee')->group(function (){
        Route::get('/',[EmployeeController::class, 'index'])->name('employee.index');
        Route::get('create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::post('store', [EmployeeController::class, 'store'])->name('employee.store');
        Route::get('edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::post('update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
        Route::get('destroy/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    });
});

Route::redirect('/','/a');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin_login'); //dashboard admin_login
})->name('dashboard');
