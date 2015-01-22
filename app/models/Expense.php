<?php

class Expense extends Eloquent
{
	/**
	 * @var string $table The tablename
	 * @access protected
	 */
	protected $table = 'expenses';

	/**
	 * @var array $hidden Fields to hide
	 * @access protected
	 */
	protected $hidden = array('created_at', 'updated_at', 'id');

	/**
	 * Get the dates
	 * @return array
	 */
	public function getDates()
	{
		return array('created_at', 'updated_at', 'date');
	}

	/*
	 * One to many relationship to the User model
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

}