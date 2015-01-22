<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
 * The login route
 */
Route::get('login', function() {
	if(!Auth::check())
	{
		return View::make('layouts.login');
	}
});

Route::post('login', function() {
	$rules = array();
	$rules['username'] = array('required' => 'required');
	$rules['password'] = array('required' => 'required');

	$validator = Validator::make(Input::get(), $rules);

	if($validator->fails())
	{
		return Redirect::to('/login');
	}
	else
	{
		$credentials = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);

		if(Auth::attempt($credentials))
		{
			return Redirect::intended('/');
		}
		else
		{
			return Redirect::to('/login');
		}
	}
});

/*
 * The logout route
 */
Route::get('logout', function() {
	Auth::logout();
	return Redirect::to('/');
});

/*
 * The main expenses/application route group
 */
Route::group(array('before' => 'auth'), function() {

	Route::get('/', 'ExpensesController@getIndex');

	/*
	 * Routes to enter expenses and process entering expenses
	 */
	Route::get('create', 'ExpensesController@getCreate');
	Route::post('create', 'ExpensesController@postCreate');

	/*
	 * Route to declare specific trips (with dates)
	 */
	Route::get('declare/{type?}', 'ExpensesController@getDeclare');
	Route::post('declare/{type?}', 'ExpensesController@postDeclare');

	/*
	 * Routes to update expenses and processing updating expenses
	 */
	Route::get('update/{id?}', 'ExpensesController@getUpdate');
	Route::post('update/{id?}', 'ExpensesController@postUpdate');

	/*
	 * Routes to delete expenses
	 */
	Route::get('delete/{id?}', 'ExpensesController@getDelete');
});

/*
 * User routes
 */
Route::group(array('before' => 'auth', 'prefix' => 'user'), function() {

	/*
	 * The main user route, shows the profile
	 */
	Route::get('/', 'UserController@getProfile');

	/*
	 * Routes to update user (meta-)fields
	 */
	Route::get('update', 'UserController@getUpdate');
	Route::post('update', 'UserController@postUpdate');

	/*
	 * Routes to import/export
	 */
	Route::group(array('before' => array('auth', 'admin')), function() {

		Route::get('export', 'UserController@getExport');
		Route::post('export', 'UserController@postExport');

		Route::get('import', 'UserController@getImport');
		Route::post('import', 'UserController@postImport');

	});
});

/*
 * The admin dashboard
 */
Route::group(array('before' => array('auth', 'admin'), 'prefix' => 'dashboard'), function() {

	/*
	 * The main dashboard route
	 */
	Route::get('/', 'DashboardController@getIndex');

	/*
	 * User specific routes
	 */
	Route::group(array('prefix' => 'users'), function() {

		/*
		 * Create a user
		 */
		Route::get('/', 'DashboardController@getCreateUser');
		Route::post('/', 'DashboardController@postCreateUser');

		/*
		 * Update a user
		 */
		Route::get('update/{id?}', 'DashboardController@getUpdateUser');
		Route::post('update/{id?}', 'DashboardController@postUpdateUser');

		/*
		 * Delete a user
		 */
		Route::get('delete/{id?}', 'DashboardController@getDeleteUser');
	});

	/*
	 * Overview routes
	 */
	Route::get('overview', 'DashboardController@getOverview');
	Route::post('overview', 'DashboardController@postOverview');
});

/*
 * This route takes care of generating a rapport which you can print/save
 */
Route::get('rapport/{year}/{month}/{userid?}', array('as' => 'rapport', function($year, $month, $userid = null) {
	$userid = !is_null($userid) ? $userid : Auth::user()->id;

	/*
	 * Make a base query to append in the switch later on
	 */
	$query = User::find($userid)->expenses()->where(DB::raw('YEAR(date)'), '=', $year);
	
	/*
	 * Check on the month, if month is 'all' show all expenses for this year.
	 * Otherwise show the correct month
	 */
	switch($month)
	{
		case 'all':
			$trips = $query->orderBy('date')->get();
		break;

		default:
			$trips = $query->where(DB::raw('MONTH(date)'), '=', $month)->orderBy('date')->get();
		break;
	}

	$data = array(
		'labels' => array(
			'home' => 'Thuis (' . User::where('id', '=', Auth::user()->id)->first()->zipcode_home . ')',
			'work' => 'Werk (' . Meta::field('zipcode_work') . ')'
		),
		'total' => 0,
		'user' => User::where('id', '=', $userid)->first(),
		'trips' => $trips
	);

	return View::make('rapport/listing', $data);

}));