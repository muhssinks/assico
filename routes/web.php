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

/*Route::get('/admin/login', 'AdminController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'AdminController@login')->name('admin.login.submit');
Route::get('/admin/home', 'AdminController@index')->name('admin.home');
Route::post('/admin/logout', 'AdminController@logout')->name('admin.logout');*/
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('company/data', 'App\Http\Controllers\CompanyController@getData')->name('companies.data');
Route::get('employee/data', 'App\Http\Controllers\EmployeeController@getData')->name('employees.data');
Route::resource('companies', 'App\Http\Controllers\CompanyController');
Route::resource('employees', 'App\Http\Controllers\EmployeeController');
