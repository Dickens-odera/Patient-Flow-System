<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//admin routes
Route::prefix('admin')->group(function()
{   
    Route::get('/adminlogin','Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/adminlogin','Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout','Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/dashboard','Admin\AdminController@index')->name('admin.dashboard');
});
//doctors routes
Route::prefix('doctors')->group(function()
{
    Route::get('/doctorlogin','Auth\DoctorsLoginController@showLoginForm')->name('doctor.login');
    Route::post('/doctorlogin', 'Auth\DoctorsLoginController@login')->name('doctor.login.submit');
    Route::get('/logout','Auth\DoctorsLoginController@logout')->name('doctor.logout');
    Route::get('/dashboard','Doctors\DoctorsController@index')->name('doctor.dashboard');
});
//patients routes
Route::prefix('patients')->group(function()
{
    Route::get('/patientlogin','Auth\PatientsLoginController@showLoginForm')->name('patient.login');
    Route::post('/patientlogin','Auth\PatientsLoginController@login')->name('patient.login.submit');
    Route::get('/logout','Auth\PatientsLoginController@logout')->name('patient.logout');
    Route::get('/dashboard','Patients\PatientsController@index')->name('patient.dashboard');
});
//nurses routes
Route::prefix('nurses')->group(function()
{
    Route::get('/nurseslogin','Auth\NursesLoginController@showLoginForm')->name('nurse.login');
    Route::post('/nurseslogin','Auth\NursesLoginController@login')->name('nurse.login.submit');
    Route::get('/logout','Auth\NursesLoginController@logout')->name('nurse.logout');
    Route::get('/dashboard','Nurses\NursesController@index')->name('nurse.dashboard');
});
//staff routes
Route::prefix('staff')->group(function()
{
    Route::get('/stafflogin','Auth\StaffLoginController@showLoginForm')->name('staff.login');
    Route::post('/stafflogin','Auth\StaffLoginController@login')->name('staff.login.submit');
    Route::get('/logout','Auth\StaffLoginController@logout')->name('staff.logout');
    Route::get('/dashboard','Staff\StaffController@index')->name('staff.dashboard');
});