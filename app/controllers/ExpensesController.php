<?php

/**
 * The expenses controller takes care of all things related to expenses
 * @author Sebastiaan Franken
 * @package ExpenseManager
 */

class ExpensesController extends BaseController
{

	/**
	 * This function shows the expenses month-by-month on the front-page
	 * @return View
	 */
	public function getIndex()
	{
		$data = array(
			'labels' => array(
				'home' => 'Thuis',
				'work' => 'Werk',
			),
			'months' => array(
				1 => 'Januari',
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

		$data['expenses'] = array();

		for($i = 1; $i <= 12; $i++)
		{

			/*
			 * Select all the expenses for the currently logged in user where the year equals this year
			 * and the month equals the current month.
			 * Order those results by date and pass them to the view
			 */

			$data['expenses'][$i] = User::find(Auth::user()->id)->expenses()->where(DB::raw('YEAR(date)'), '=', date('Y'))->where(DB::raw('MONTH(date)'), '=', $i)->orderBy('date')->get();
		}	

		return View::make('layouts/application')->nest('content', 'expenses/index', $data);
	}

	/**
	 * This shows the view to create a new trip
	 * @return View
	 */
	public function getCreate()
	{
		return View::make('layouts/application')->nest('content', 'expenses/create');
	}

	/**
	 * This handles the creation of a trip
	 * @return Redirect
	 */
	public function postCreate()
	{

		/*
		 * The input rules the input has to validate by
		 */
		$rules = array(
			'date' => array('required', 'date', 'date_format:d-m-Y'),
			'price' => array('required')
		);

		$validator = Validator::make(Input::get(), $rules);

		if($validator->fails())
		{
			return Redirect::action('ExpensesController@getCreate')->withInput(Input::get())->withErrors($validator);
		}
		else
		{
			if(Input::get('roundtrip') == 'true')
			{
				$trip = new Expense;
				$trip->user_id = Auth::user()->id;
				$trip->date = timestamp(Input::get('date'), null, 'Y-m-d');
				$trip->origin = Input::get('origin');
				$trip->destination = Input::get('destination');
				$trip->price = str_replace(',', '.', Input::get('price')) / 2;
				$trip->save();

				$trip = new Expense;
				$trip->user_id = Auth::user()->id;
				$trip->date = timestamp(Input::get('date'), null, 'Y-m-d');

				/*
				 * Flip the destination and origin since it's the mirror image of the 
				 * first trip
				 */
				$trip->origin = Input::get('destination');
				$trip->destination = Input::get('origin');
				$trip->price = str_replace(',', '.', Input::get('price')) / 2;
				$trip->save();
			}
			else
			{
				$trip = new Expense;
				$trip->user_id = Auth::user()->id;
				//$trip->date = Input::get('date');
				$trip->date = timestamp(Input::get('date'), null, 'Y-m-d');
				$trip->origin = Input::get('origin');
				$trip->destination = Input::get('destination');
				$trip->price = str_replace(',', '.', Input::get('price'));
				$trip->save();

				Session::flash('message', 'Je reiskosten zijn opgeslagen.');
			}

			return Redirect::action('ExpensesController@getIndex');
		}
	}

	public function getUpdate($id = null)
	{
		if(is_null($id))
		{
			return Redirect::action('ExpensesController@getIndex');
		}
		else
		{
			$data = array(
				'expenses' => User::find(Auth::user()->id)->expenses()->where('id', '=', $id)->first()
			);

			return View::make('layouts/application')->nest('content', 'expenses/update', $data);
		}
	}

	public function postUpdate($id = null)
	{
		if(!is_null($id))
		{
			$rules = array(
				'date' => array('required', 'date', 'date_format:d-m-Y'),
				'price' => array('required')
			);

			$validator = Validator::make(Input::get(), $rules);

			if($validator->fails())
			{
				return Redirect::action('ExpensesController@getUpdate', array($id))->withErrors($validator)->withInput(Input::all());
			}
			else
			{
				/**
				 * @todo Fix this
				 */

				$trip = Expense::find($id);
				$trip->user_id = Auth::user()->id;
				$trip->date = timestamp(Input::get('date'), null, 'Y-m-d');
				$trip->origin = Input::get('origin');
				$trip->destination = Input::get('destination');
				$trip->price = str_replace(',', '.', Input::get('price'));
				$trip->save();

				Session::flash('message', 'Je reiskosten zijn bijgewerkt.');

				return Redirect::action('ExpensesController@getIndex');
			}
		}
		else
		{
			return Redirect::action('ExpensesController@getIndex');
		}
	}

	public function getDeclare($type = 'normal')
	{
		switch($type)
		{
			case 'normal':
				$data = array(
					'months' => array(
						'all' => 'Alle',
						1 => 'Januari',
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

				return View::make('layouts/application')->nest('content', 'expenses/declare/normal', $data);
			break;

			case 'advanced':
				return View::make('layouts/application')->nest('content', 'expenses/declare/advanced');
			break;

			default:
				return action('ExpensesController@getIndex');
			break;
		}
	}

	public function postDeclare($type = 'normal')
	{
		switch($type)
		{
			case 'normal':
				//return URL::to('declare', array(Input::get('year'), Input::get('month')));
				return Redirect::route('rapport', array(Input::get('year'), Input::get('month')));
			break;

			case 'advanced':
				$rules = array(
					'start_date' => array('required', 'date', 'date_format:d-m-Y'),
					'end_date' => array('required', 'date', 'date_format:d-m-Y')
				);

				$validator = Validator::make(Input::get(), $rules);

				if($validator->fails())
				{
					return Redirect::action('ExpensesController@getDeclare', array('advanced'))->withErrors($validator)->withInput(Input::get());
				}
				else
				{
					$startDate = (new DateTime(Input::get('start_date')))->format('Y-m-d');
					$endDate = (new DateTime(Input::get('end_date')))->format('Y-m-d');

					$data = array(
						'labels' => array(
							'home' => 'Thuis (' . User::where('id', '=', Auth::user()->id)->first()->zipcode_home . ')',
							'work' => 'Werk (' . Meta::field('zipcode_work') . ')'
						),
						'total' => 0,
						'user' => User::where('id', '=', Auth::user()->id)->first(),
						'trips' => User::find(Auth::user()->id)->expenses()->where('date', '>=', $startDate)->where('date', '<=', $endDate)->orderBy('date')->get()
					);

					return View::make('rapport/listing', $data);
				}
			break;

			default:
				return action('ExpensesController@getIndex');
			break;
		}
	}

	public function getDelete($id = null)
	{
		if(is_null($id))
		{
			return Redirect::action('ExpensesController@getIndex');
		}
		else
		{
			$trip = Expense::find($id);
			$trip->delete();

			Session::flash('message', 'De reis is verwijderd.');

			return Redirect::action('ExpensesController@getIndex');
		}
	}
}