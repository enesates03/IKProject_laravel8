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

Route::middleware('prevent-back-history')->group(function(){
    Route::get('/a', [HomeController::class, 'index'])->name('home.index')->middleware('auth');
    Route::get('/admin/login',[HomeController::class, 'login'])->name('admin_login');
    Route::post('/admin/logincheck', [HomeController::class, 'logincheck'])->name('admin_logincheck');
    Route::get('/admin/logout', [HomeController::class, 'logout'])->name('admin_logout');
});

Route::middleware('auth','prevent-back-history')->prefix('admin')->group(function () {
    Route::prefix('company')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('company.index');
        Route::get('create', [CompanyController::class, 'create'])->name('company.create');
        Route::post('store', [CompanyController::class, 'store'])->name('company.store');
        Route::get('edit/{company}', [CompanyController::class, 'edit'])->name('company.edit');
        Route::post('update/{company}', [CompanyController::class, 'update'])->name('company.update');
        Route::get('destroy/{company}', [CompanyController::class, 'destroy'])->name('company.destroy');
    });

    Route::prefix('employee')->group(function (){
        Route::get('/',[EmployeeController::class, 'index'])->name('employee.index');
        Route::get('create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::post('store', [EmployeeController::class, 'store'])->name('employee.store');
        Route::get('edit/{employee}', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::post('update/{employee}', [EmployeeController::class, 'update'])->name('employee.update');
        Route::get('destroy/{employee}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    });
});

Route::redirect('/','/a');
    Route::post('company/import', [CompanyController::class, 'fileImport'])->name('company.import');
    Route::get('company/export/xlsx', [CompanyController::class, 'fileExport'])->name('company.export');
    Route::get('company/export/csv', [CompanyController::class, 'fileExportCSV'])->name('company.export.CSV');
    Route::get('company/export/pdf', [CompanyController::class, 'fileExportPDF'])->name('company.export.PDF');
    Route::post('company/download',[CompanyController::class, 'fileDowload'])->name('company.download');

    Route::post('employee/import', [EmployeeController::class, 'fileImport'])->name('employee.import');
    Route::get('employee/export/xlsx', [EmployeeController::class, 'fileExport'])->name('employee.export');
    Route::get('employee/companyID-export/pdf', [EmployeeController::class, 'fileExportCompanyID'])->name('employee.exportCompanyID');
    Route::get('employee/export/csv', [EmployeeController::class, 'fileExportCSV'])->name('employee.export.CSV');
    Route::get('employee/export/pdf', [EmployeeController::class, 'fileExportPDF'])->name('employee.export.PDF');
    Route::get('employee/download',[EmployeeController::class, 'fileDowload'])->name('employee.download');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard'); //dashboard
})->name('dashboard');



