<?php

class UserController extends BaseController
{
	public function getProfile()
	{
		$data = array(
			'user' => User::where('id', '=', Auth::user()->id)->first(),
			'preferences' => Meta::where('user_id', '=', Auth::user()->id)->get(),
			'preferencesLabels' => array(
				'roundtrip_preference' => 'Retour of enkele reis'
			)
		);

		return View::make('layouts/application')->nest('content', 'user/profile', $data);
	}

	public function getUpdate()
	{
		$data = array(
			//'user' => User::find(Auth::user()->id),
			'user' => User::where('id', '=', Auth::user()->id)->first(),
			'labels' => array(
				'zipcode_work' => 'Postcode werk',
				'zipcode_home' => 'Postcode thuis'
			)
		);

		return View::make('layouts/application')->nest('content', 'user/update', $data);
	}

	public function postUpdate()
	{
		$preferences = array('roundtrip_preference');

		$rules = array(
			'fullname' => array('required', 'min:3'),
			'zipcode_home' => array('required', 'min:6', 'max:7'),
			'bankaccount' => array('required')
		);

		$validator = Validator::make(Input::get(), $rules);

		if($validator->fails())
		{
			return Redirect::action('UserController@getUpdate')->withErrors($validator)->withInput(Input::get());
		}
		else
		{
			#$user = User::find(Auth::user()->id)->first();
			$user = User::where('id', '=', Auth::user()->id)->first();
			$user->fullname = Input::get('fullname');
			$user->zipcode_home = Input::get('zipcode_home');
			$user->bankaccount = Input::get('bankaccount');
			$user->save();

			/*
			 * Update preferences
			 */	
			foreach($preferences as $pref)
			{
				/*
				$preference = Meta::where('user_id', '=', Auth::user()->id)->where('meta_key', '=', 'roundtrip_preference');
				$preference->meta_value = Input::get($pref);
				$preference->save();
				*/

				$check = Meta::userField($pref, Auth::user()->id);

				if(gettype($check) == 'boolean' && $check == false)
				{
					$preference = new Meta;
					$preference->user_id = Auth::user()->id;
					$preference->meta_key = $pref;
					$preference->meta_value = Input::get($pref);
					$preference->save();
				}
				else
				{
					$preference = Meta::where('user_id', '=', Auth::user()->id)->where('meta_key', '=', $pref)->first();
					$preference->meta_value = Input::get($pref);
					$preference->save();
				}
			}

			Session::flash('message', 'De wijziging is opgeslagen.');

			return Redirect::action('UserController@getUpdate');
		}
	}

	public function getExport()
	{
		return View::make('layouts/application')->nest('content', 'user/export');
	}

	public function postExport()
	{
		$data = array(
			'expenses' => Expense::where('user_id', '=', Auth::user()->id)->get()
		);

		$json = json_encode(Expense::where('user_id', '=', Auth::user()->id)->get(), JSON_PRETTY_PRINT);

		return pr($json);
	}

	public function getImport()
	{
		return View::make('layouts/application')->nest('content', 'user/import');
	}

	public function postImport(){}
}