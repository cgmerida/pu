<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('users', function () {
    return datatables(App\User::get())
        ->addColumn('actions', 'users.partials.actions')
        ->rawColumns(['actions'])
        ->toJson();
});

Route::get('roles', function () {
    return datatables(Caffeinated\Shinobi\Models\Role::all())
        ->addColumn('actions', 'roles.partials.actions')
        ->rawColumns(['actions'])
        ->toJson();
});

Route::get('departments', function () {
    return datatables(App\Department::all())
        ->addColumn('actions', 'departments.partials.actions')
        ->rawColumns(['actions'])
        ->toJson();
});

Route::get('municipalities', function () {
    return datatables(App\Municipality::with('department')->get())
        ->addColumn('actions', 'municipalities.partials.actions')
        ->rawColumns(['actions'])
        ->toJson();
});