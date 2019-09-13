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
    //admi personal urls
    Route::get('/adminlogin','Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/adminlogin','Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout','Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/dashboard','Admin\AdminController@index')->name('admin.dashboard');
    Route::get('/profile','Admin\AdminController@profile')->name('admin.profile');
    //doctors
    Route::get('/doctors','Admin\AdminController@showDoctorsForm')->name('admin.doctor.add');
    Route::post('/doctor','Admin\AdminController@addNewDoctor')->name('admin.doctor.submit');
    Route::get('/doctors/all','Admin\AdminController@viewAllDoctors')->name('admin.doctors.view.all');
    Route::get('/doctor/update','Admin\AdminController@showDrEditForm')->name('admin.doctor.edit.form');
    Route::post('/doctor/update','Admin\AdminController@updateDrInformation')->name('admin.doctor.update');
    Route::get('/doctor/delete','Admin\AdminController@deleteDrInformation')->name('admin.doctor.delete');
    //nurses
    Route::get('/nurses','Admin\AdminController@showNursesForm')->name('admin.nurses.add');
    Route::post('/nurses','Admin\AdminController@addNewNurse')->name('admin.nurse.submit');
    Route::get('/nurses/all','Admin\AdminController@viewAllNurses')->name('admin.nurses.view.all');
    Route::get('/nurse/update','Admin\AdminController@showNurseEditForm')->name('admin.nurse.edit.form');
    Route::post('/nurse/update','Admin\AdminController@updateNurseInformation')->name('admin.nurse.update');
    Route::get('/nurse/delete','Admin\AdminController@deleteNurseInformation')->name('admin.nurse.delete');
    //non medical staff
    Route::get('/staff','Admin\AdminController@showStaffForm')->name('admin.staff.add');
    Route::post('/staff','Admin\AdminController@addNewStaff')->name('admin.staff.submit');
    //patients
    Route::get('/patients','Admin\AdminController@viewAllPatients')->name('admin.patients.view.all');
    //departments
    Route::get('/departments/create-new','Admin\AdminController@showDepartmentsForm')->name('admin.department.add');
    Route::post('/departments','Admin\AdminController@addNewDepartment')->name('admin.department.submit');
    Route::get('/departments/all','Admin\AdminController@viewAllDepartments')->name('admin.departments.view.all');
    Route::get('/department/update','Admin\AdminController@showDepartmentEditForm')->name('admin.department.edit.form');
    Route::post('/department/update','Admin\AdminController@updateDepartmentInformation')->name('admin.department.update');
    Route::get('/departement/delete','Admin\AdminController@deleteDepartmentInforrmation')->name('admin.department.delete');
    Route::get('/department/show','Admin\AdminController@showDepartmentDetails')->name('admin.department.show');
    //mail
    Route::get('mail','Admin\AdminController@showAllMail')->name('admin.mails.view.all');
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