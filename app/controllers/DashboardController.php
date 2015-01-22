<?php

/*
 * The dashboard is for admins to check users, add a user and
 * create an overview of expenses
 */
class DashboardController extends BaseController
{
	public function getIndex()
	{
		$data = array(
			'users' => User::all()
		);

		return View::make('layouts/application')->nest('content', 'dashboard/index', $data);
	}

	public function getCreateUser()
	{
		return View::make('layouts/application')->nest('content', 'dashboard/user/create');
	}

	public function postCreateUser()
	{
		$rules = array(
			'username' => array('required', 'min:2'),
			'fullname' => array('required', 'min:3'),
			'password' => array('required'),
			'password_check' => array('required', 'same:password'),
			'role' => array('required'),
			'bankaccount' => array('required'),
			'zipcode_home' => array('required', 'min:6', 'max:7')
		);

		$validator = Validator::make(Input::get(), $rules);

		if($validator->fails())
		{
			return Redirect::action('DashboardController@getCreateUser')->withInput(Input::all())->withErrors($validator);
		}
		else
		{
			$user = new User;
			$user->username = Input::get('username');
			$user->fullname = Input::get('fullname');
			$user->password = Hash::make(Input::get('password'));
			$user->role = Input::get('role');
			$user->zipcode_home = Input::get('zipcode_home');
			$user->bankaccount = Input::get('bankaccount');
			$user->save();

			Session::flash('message', 'De gebruiker is opgeslagen.');

			return Redirect::action('DashboardController@getIndex');
		}
	}

	public function getOverview()
	{
		$users = User::all();
		$employees = array();

		foreach($users as $user)
		{
			$employees[$user->id] = $user->fullname;
		}

		$data = array(
			'employees' => $employees,
			'months' => array(
				'all' => 'Alle',
				1 => 'Junuari',
				2 => 'Februari',
				3 => 'Maart',
				4 => 'April',
				5 => 'Mei',
				6 => 'Juni',
				7 => 'Juli',
				8 => 'Augustus',
				9 => 'September',
				10 => 'Oktober',
				11 => 'November',
				12 => 'December'
			)
		);

		return View::make('layouts/application')->nest('content', 'dashboard/overview', $data);
	}

	public function postOverview()
	{
		$user = Input::get('user');
		$year = Input::get('year');
		$month = Input::get('month');

		return Redirect::route('rapport', array($year, $month, $user));
	}

	public function getExport()
	{
		$users = array();

		foreach(User::get() as $user)
		{
			$users[$user->id] = $user->fullname;
		}

		$data = array(
			'users' => $users
		);

		return View::make('layouts/application')->nest('content', 'dashboard/export', $data);
	}

	public function postExport()
	{
		/**
		 * @todo Force a download 
		 */

		$data = array();
		$data['userinfo'] = User::where('id', '=', Input::get('user'))->get();
		$data['preferences'] = Meta::where('user_id', '=', Input::get('user'))->get();

		return Response::json($data);
	}

	public function getUpdateUser($userid = null)
	{
		if(is_null($userid))
		{
			return action('DashboardController@getIndex');
		}
		else
		{
			$data = array(
				'user' => User::find($userid)
			);

			return View::make('layouts/application')->nest('content', 'dashboard/user/update', $data);
		}
	}

	public function postUpdateUser($userid = null)
	{
		if(is_null($userid))
		{
			return action('DashboardController@getIndex');
		}
		else
		{
			$rules = array(
				'username' => array('required', 'min:2'),
				'fullname' => array('required', 'min:3'),
				'role' => array('required'),
				'bankaccount' => array('required'),
				'zipcode_home' => array('required', 'min:6', 'max:7')
			);

			if(Input::has('password') && Input::has('password_check'))
			{
				$rules['password'] = array('required');
				$rules['password_check'] = array('required', 'same:password');
			}

			$validator = Validator::make(Input::get(), $rules);

			if($validator->fails())
			{
				return Redirect::action('DashboardController@getCreateUser')->withInput(Input::all())->withErrors($validator);
			}
			else
			{
				//$user = new User;
				$user = User::find($userid);
				$user->username = Input::get('username');
				$user->fullname = Input::get('fullname');

				if(Input::has('password') && Input::has('password_check'))
				{
					$user->password = Hash::make(Input::get('password'));
				}

				$user->role = Input::get('role');
				$user->zipcode_home = Input::get('zipcode_home');
				$user->bankaccount = Input::get('bankaccount');
				$user->save();

				Session::flash('message', 'De gebruiker is bijgewerkt.');

				return Redirect::action('DashboardController@getIndex');
			}
		}
	}

	public function getDeleteUser($userid = null)
	{
		if(!is_null($userid))
		{
			$user = User::find($userid);
			$user->delete();

			Session::flash('message', 'De gebruiker is verwijderd.');
		}

		return action('DashboardController@getIndex');
	}
}