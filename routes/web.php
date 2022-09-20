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
    return redirect('/login');
});

// Auth
Route::group([], function () {
	Route::get('login', 'AuthController@LoginView');
	Route::get('register', 'AuthController@RegisterView');
	Route::post('login', 'AuthController@LoginProcess')->name('loginProcess');
	Route::post('register', 'AuthController@RegisterProcess')->name('registerProcess');
	Route::get('logout', 'AuthController@Logout');
});


// Users
Route::group(['middleware' => ['auth.users', 'admin'], 'prefix' => 'users'], function() {

	// Dashboard Users
	Route::get('/', 'UsersController@Home')->name('home');
	// Management Users
	Route::post('/add', 'UsersController@Store');
	Route::get('/edit/{id}', 'UsersController@edit');
	Route::put('/edit/{id}', 'UsersController@Update')->name('UpdateProcess');
	Route::delete('/delete/{id}', 'UsersController@Delete');

});

//masjid
Route::resource('/mosques', MosqueController::class);
//rayon
Route::resource('/regions', RegionController::class);
//siswa
Route::resource('/students', StudentController::class);


// student counselor
Route::group(['middleware' => ['auth.users', 'studentcounselors'], 'prefix' => 'studentcounselors'], function() {

	// Dashboard student counselor
	Route::get('/', 'StudentcounselorController@index');
	// Management
});


//prayer counselor
Route::group(['middleware' => ['auth.users', 'prayercounselor'], 'prefix' => 'prayercounselors'], function() {
	// Dashboard staff
	Route::get('/', 'PrayercounselorController@index');
});
