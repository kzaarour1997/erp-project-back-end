<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/** Auth Routes */


Route::post('/login', 'AuthController@login');


Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('/register' , 'AuthController@register');
    Route::post('/logout', 'AuthController@logout');
    Route::get('/login' , 'AuthController@login' );
    Route::resource('users' , 'AdminController');
    Route::resource('/change' , 'PasswordController');
    Route::resource('/kpi' , 'KpiController');
    Route::resource('/team' , 'TeamController');
    Route::resource('/assign' , 'AssignController');
    Route::resource('/project' , 'ProjectController');
    Route::resource('/employee' , 'EmployeeController');
    Route::resource('/teamproject','TeamProjectController');
    Route::resource('/role' , 'RoleController');
    Route::resource('/EmployeeProjectRole','EmployeeProjectRoleController');
});













