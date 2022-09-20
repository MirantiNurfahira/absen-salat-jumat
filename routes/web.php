<?php

use Illuminate\Support\Facades\Route;


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

Route::group(['middleware' => ['auth.users', 'admin']], function() {
    //masjid
    Route::resource('/mosques', MosqueController::class);
    //rayon
    Route::get('/regions/{regionId}/edit', 'RegionController@edit');
    Route::resource('/regions', RegionController::class);

    //siswa
    Route::resource('/students', StudentController::class);

    //jadwal
    Route::group(['prefix' => 'schedules'], function() {
        Route::get('/', 'ScheduleController@index');
        Route::get('/create-page', 'ScheduleController@create');
        Route::post('/create', 'ScheduleController@store');
        Route::get('/edit-page/{id}', 'ScheduleController@edit');
        Route::patch('/update/{id}', 'ScheduleController@update');
        Route::delete('/destroy/{id}', 'ScheduleController@destroy');
    });

});

// student counselor
Route::group(['middleware' => ['auth.users', 'studentcounselors'], 'prefix' => 'studentcounselors'], function() {

	// Dashboard student counselor
	Route::get('/', 'StudentCounselorController@index');
	Route::get('/students', 'StudentCounselorController@students');
    // Management
    Route::group(['prefix' => 'schedules'], function() {
	    Route::get('/', 'StudentCounselorController@schedules');
        Route::get('/detail/{id}', 'StudentCounselorController@scheduleDetail');
    });
});


//prayer counselor
Route::group(['middleware' => ['auth.users', 'prayercounselor'], 'prefix' => 'prayercounselors'], function() {
	// Dashboard staff
    Route::get('/', 'PrayerCounselorController@index');

    Route::group(['prefix' => 'schedules'], function() {
        Route::get('/detail/{id}', 'PrayerCounselorController@scheduleDetail');
        Route::get('/{scheduleId}/presences/create', 'PrayerCounselorController@createPage');
        Route::post('/{scheduleId}/presences/create', 'PrayerCounselorController@create');
    });
});

/*
███████████▓▓▓▓▓▓▓▓▒░░░░░▒▒░░░░░░░▓█████
██████████▓▓▓▓▓▓▓▓▒░░░░░▒▒▒░░░░░░░░▓████
█████████▓▓▓▓▓▓▓▓▒░░░░░░▒▒▒░░░░░░░░░▓███
████████▓▓▓▓▓▓▓▓▒░░░░░░░▒▒▒░░░░░░░░░░███
███████▓▓▓▓▓▓▓▓▒░░▒▓░░░░░░░░░░░░░░░░░███
██████▓▓▓▓▓▓▓▓▒░▓████░░░░░▒▓░░░░░░░░░███
█████▓▒▓▓▓▓▓▒░▒█████▓░░░░▓██▓░░░░░░░▒███
████▓▒▓▒▒▒░░▒███████░░░░▒████░░░░░░░░███
███▓▒▒▒░░▒▓████████▒░░░░▓████▒░░░░░░▒███
██▓▒▒░░▒██████████▓░░░░░▓█████░░░░░░░███
██▓▒░░███████████▓░░░░░░▒█████▓░░░░░░███
██▓▒░▒██████████▓▒▒▒░░░░░██████▒░░░░░▓██
██▓▒░░▒███████▓▒▒▒▒▒░░░░░▓██████▓░░░░▒██
███▒░░░░▒▒▒▒▒▒▒▒▒▒▒▒░░░░░░███████▓░░░▓██
███▓░░░░░▒▒▒▓▓▒▒▒▒░░░░░░░░░██████▓░░░███
████▓▒▒▒▒▓▓▓▓▓▓▒▒▓██▒░░░░░░░▓███▓░░░░███
██████████▓▓▓▓▒▒█████▓░░░░░░░░░░░░░░████
█████████▓▓▓▓▒▒░▓█▓▓██░░░░░░░░░░░░░█████
███████▓▓▓▓▓▒▒▒░░░░░░▒░░░░░░░░░░░░██████
██████▓▓▓▓▓▓▒▒░░░░░░░░░░░░░░░░▒▓████████
██████▓▓▓▓▓▒▒▒░░░░░░░░░░░░░░░▓██████████
██████▓▓▓▓▒▒██████▒░░░░░░░░░▓███████████
██████▓▓▓▒▒█████████▒░░░░░░▓████████████
██████▓▓▒▒███████████░░░░░▒█████████████
██████▓▓░████████████░░░░▒██████████████
██████▓░░████████████░░░░███████████████
██████▓░▓███████████▒░░░████████████████
██████▓░███████████▓░░░█████████████████
██████▓░███████████░░░██████████████████
██████▓▒██████████░░░███████████████████
██████▒▒█████████▒░▓████████████████████
██████░▒████████▓░██████████████████████
██████░▓████████░███████████████████████
██████░████████░▒███████████████████████
█████▓░███████▒░████████████████████████
█████▒░███████░▓████████████████████████
█████░▒██████░░█████████████████████████
█████░▒█████▓░██████████████████████████
█████░▓█████░▒██████████████████████████
█████░▓████▒░███████████████████████████
█████░▓███▓░▓███████████████████████████
██████░▓▓▒░▓████████████████████████████
███████▒░▒██████████████████████████████
████████████████████████████████████████
████████████████████████████████████████
I'm utterly dissapointed by how you treat her...
*/
