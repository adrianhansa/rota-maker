<?php
Route::view('/', 'home');
Route::view('/home', 'home')->name('home');

	Route::post('register','Auth\RegisterController@register');
	Route::post('login','Auth\LoginController@login');
	Route::post('logout','Auth\LoginController@logout');
	Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail');
	Route::post('password/reset','Auth\ForgotPasswordController@reset');

Route::group(['middleware'=>'auth'], function(){
	// Route::get('{path}','HomeController@index')->where('path','([A-z\d/_.]+)?');
	Route::view('home/{any}', 'home');
	Route::view('dashboard/{any}', 'home');
	Route::get('days/{year}','DayController@days');
	Route::get('daysSelected/{house}/{start}/{end}','DayController@daysSelected');
	Route::post('createShift','DayController@createShift');
	Route::put('updateShift/{shift}','DayController@updateShift');
	Route::post('existingShifts','DayController@existingShifts');
	Route::get('getGenericShifts/{house}','DayController@getGenericShifts');

	Route::get('shifts','ShiftController@index');
	Route::get('shifts/{shift}','ShiftController@show');
	Route::post('shifts','ShiftController@store');
	Route::put('shifts/{shift}','ShiftController@update');
	Route::delete('shifts/{shift}','ShiftController@destroy');

	

	Route::get('employees','EmployeeController@index');
	Route::get('employees/{house}','EmployeeController@employeesByHouse');
	Route::get('employees/details/{employee}','EmployeeController@show');
	Route::post('employees/store','EmployeeController@store');
	Route::put('employees/update/{employee}','EmployeeController@update');
	Route::post('employees/delete/{employee}','EmployeeController@delete');
	Route::delete('employees/forcedelete/{employee}','EmployeeController@forceDelete');
	Route::post('employees/restore/{employee}','EmployeeController@restore');

	Route::get('houses/{house}','HouseController@show');
	Route::get('company','CompanyController@details');

	Route::group(['middleware'=>'admin'], function(){
		Route::post('company/store','CompanyController@store');
		Route::put('company/update/{company}','CompanyController@update');
		Route::delete('company/delete/{id}','CompanyController@delete');

		Route::get('houses','HouseController@index');
		Route::post('houses/store','HouseController@store');
		Route::put('houses/update/{house}','HouseController@update');
		Route::post('houses/delete/{id}','HouseController@delete');
		Route::delete('houses/forcedelete/{house}','HouseController@forceDelete');
		Route::post('houses/restore/{house}','HouseController@restore');

		Route::get('users','UserController@index');
		Route::get('users/{user}','UserController@show');
		Route::post('users/store','UserController@store');
		Route::put('users/update/{user}','UserController@update');
		Route::delete('users/delete/{user}','UserController@delete');
	});
});

