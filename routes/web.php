<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', [EmployeeController::class, 'index'])->name('home');
Route::post('/import', [EmployeeController::class, 'importExcel'])->name('import');
Route::get('/export/{companyId}', [EmployeeController::class, 'exportPdf'])->name('export.pdf');
Route::get('/companies', [EmployeeController::class, 'getCompanies'])->name('get.companies');
Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');


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

// Route::get('/', function () {
//     return view('welcome');
// });
