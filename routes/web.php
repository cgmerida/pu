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
    return redirect('/admin');
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

    Route::resource('deputies', 'DeputyController');
    Route::get('departments/{department}/deputies', 'DeputyController@getDeputies')
        ->where('depto_id', '[0-9]+')->where('muni_id', '[0-9]+');

    Route::resource('tours', 'TourController');
    Route::put('tours/{tour}/close', 'TourController@close')->name('tours.close');
    Route::get('departments/{department}/tours', 'TourController@getTours')
        ->where('department', '[0-9]+');

    Route::resource('campaign', 'CampaignController');
    Route::put('campaign/{campaign}/close', 'CampaignController@close')->name('campaign.close');
    Route::get('departments/{department}/campaign', 'CampaignController@getCampaigns')
        ->where('department', '[0-9]+');

    Route::resource('department_campaign', 'DepartmentCampaignController');
    Route::get('departments/{department}/department_campaign', 'DepartmentCampaignController@getCampaigns')
        ->where('department', '[0-9]+');


    Route::get('admin', 'DashboardController@index')->name('admin.dash');
    Route::get('dashboard/departments/legals', 'DashboardController@departmentsLegals');
    Route::get('dashboard/departments/primes', 'DashboardController@departmentsPrimes');
    Route::get('dashboard/departments/mayors', 'DashboardController@departmentsMayors');
    Route::get('dashboard/departments/deputies', 'DashboardController@departmentsDeputies');
    Route::get('dashboard/departments/tours', 'DashboardController@departmentsTours');
    Route::get('dashboard/departments/campaign', 'DashboardController@departmentsCampaign');
    Route::get('dashboard/departments/department_campaign', 'DashboardController@departmentsDepartmentCampaign');

    Route::get('dashboard/municipalities/{department}/legals', 'DashboardController@municipalitiesLegals');
    Route::get('dashboard/municipalities/{department}/primes', 'DashboardController@municipalitiesPrimes');
    Route::get('dashboard/municipalities/{department}/mayors', 'DashboardController@municipalitiesMayors');
    Route::get('dashboard/municipalities/{department}/deputies', 'DashboardController@municipalitiesDeputies');
    Route::get('dashboard/municipalities/{department}/tours', 'DashboardController@municipalitiesTours');
    Route::get('dashboard/municipalities/{department}/campaign', 'DashboardController@municipalitiesCampaign');
    
    Route::get('dashboard/department/{department}/stadistics/legals', 'DashboardController@deptoStadisticsLegals');
    Route::get('dashboard/stadistics/legals', 'DashboardController@paisStadisticsLegals');

    Route::get('dashboard/department/{department}/stadistics/primes', 'DashboardController@deptoStadisticsPrimes');
    Route::get('dashboard/stadistics/primes', 'DashboardController@paisStadisticsPrimes');

    Route::get('dashboard/department/{department}/stadistics/mayors', 'DashboardController@deptoStadisticsMayors');
    Route::get('dashboard/stadistics/mayors', 'DashboardController@paisStadisticsMayors');

    Route::get('dashboard/department/{department}/stadistics/deputies', 'DashboardController@deptoStadisticsDeputies');
    Route::get('dashboard/stadistics/deputies', 'DashboardController@paisStadisticsDeputies');

    Route::get('dashboard/department/{department}/stadistics/tours', 'DashboardController@deptoStadisticsTours');
    Route::get('dashboard/stadistics/tours', 'DashboardController@paisStadisticsTours');

    Route::get('dashboard/department/{department}/stadistics/campaign', 'DashboardController@deptoStadisticsCampaign');
    Route::get('dashboard/stadistics/campaign', 'DashboardController@paisStadisticsCampaign');

    Route::get('dashboard/department/{department}/stadistics/department_campaign', 'DashboardController@deptoStadisticsDepartmentCampaign');
    Route::get('dashboard/stadistics/department_campaign', 'DashboardController@paisStadisticsDepartmentCampaign');
});
