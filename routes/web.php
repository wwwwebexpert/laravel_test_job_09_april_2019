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


/* Team section start here */
Route::get('/teams', 'HomeController@teams')->name('teams');
Route::post('/teams', 'HomeController@SaveTeam')->name('SaveTeam');
Route::get('/editteam/{id}', 'HomeController@EditTeam')->name('EditTeam');
Route::post('/updateteam', 'HomeController@UpdateTeam')->name('UpdateTeam');
Route::get('/deleteteam/{id}', 'HomeController@DeleteTeam')->name('DeleteTeam');
/* Team section end here */

/* User section start here */
Route::get('/users', 'HomeController@users')->name('users');
Route::post('/users', 'HomeController@SaveUsers')->name('SaveUsers');
Route::get('/edituser/{id}', 'HomeController@EditUser')->name('EditUser');
Route::post('/updateuser', 'HomeController@UpdateUser')->name('UpdateUser');
Route::get('/deleteuser/{id}', 'HomeController@DeleteUser')->name('DeleteUser');
/* User section end here */

/* roles section start here */
Route::get('/roles', 'HomeController@roles')->name('roles');
Route::post('/roles', 'HomeController@SaveRoles')->name('SaveRoles');
Route::get('/editrole/{id}', 'HomeController@EditRole')->name('EditRole');
Route::post('/updaterole', 'HomeController@UpdateRole')->name('UpdateRole');
Route::get('/deleterole/{id}', 'HomeController@DeleteRole')->name('DeleteRole');
/* roles section end here */