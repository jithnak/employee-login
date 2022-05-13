<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
  
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
  
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/add_company', [CompanyController::class, 'add_company'])->name('add_company');
Route::post('getDataTable', [CompanyController::class, 'getDataTable'])->name('getDataTable');
Route::post('delete', [CompanyController::class, 'delete'])->name('delete');
Route::get('get-list', [EmployeeController::class, 'index']); 
Route::post('/add_employee', [EmployeeController::class, 'add_employee'])->name('add_employee');
Route::post('getEmployee', [EmployeeController::class, 'getEmployee'])->name('getEmployee');
Route::post('/update_employee', [EmployeeController::class, 'update_employee'])->name('update_employee');
Route::post('deleteEmployee', [EmployeeController::class, 'deleteEmployee'])->name('deleteEmployee');