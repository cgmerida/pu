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

Route::get('/home', function () {
    return view('home');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');

    Route::resource('departments', 'DepartmentController');
    Route::get('departments/{department}/municipalities', 'DepartmentController@municipalities');

    Route::resource('municipalities', 'MunicipalityController');
    // Route::resource('candidates', 'CandidateController');

    Route::resource('mayors', 'MayorController');
    Route::get('mayors/{department}/{muni_id}', 'MayorController@getMayors')
        ->where('depto_id', '[0-9]+')->where('muni_id', '[0-9]+');

    Route::get('admin', 'DashboardController@index')->name('admin.dash');
    Route::get('dashboard/departments/legals', 'DashboardController@departmentsLegal');
    Route::get('dashboard/departments/primes', 'DashboardController@departmentsPrime');
    Route::get('dashboard/municipalities/{department}/legals', 'DashboardController@municipalitiesLegal');
    Route::get('dashboard/municipalities/{department}/primes', 'DashboardController@municipalitiesPrime');

    Route::get('dashboard/department/{department}/stadistics', 'DashboardController@deptoStadistics');
    Route::get('dashboard/stadistics', 'DashboardController@paisStadistics');

});
