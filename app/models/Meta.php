<?php

/**
 * The model for the meta classs
 * @author Sebastiaan Franken
 */

class Meta extends Eloquent
{
	/**
	 * @var string $table The table to use
	 * @access protected
	 */
	protected $table = 'meta';

	/**
	 * @var array $hidden The fields to hide
	 * @access protected
	 */
	protected $hidden = array('created_at', 'updated_at');

	/**
	 * This gets the value of a specific field
	 * @var string $field The field to get
	 * @return mixed
	 */
	public static function field($field)
	{
		return Meta::where('meta_key', '=', $field)->first()->meta_value;
	}

	/**
	 * This gets the value of a specific field for a specific user
	 * @var string $field The field to get
	 * @var int $userid The users' ID
	 * @return mixed
	 */
	public static function userField($field, $userid)
	{
		$preference = Meta::where('user_id', '=', $userid)->where('meta_key', '=', $field);
	
		return ($preference->get()->isEmpty()) ? false : $preference->first()->meta_value;
	}

	/**
	 * This gets all values for a specific user
	 * @var int $userid The users' ID
	 * @return mixed
	 */
	public static function userFields($userid)
	{
		return Meta::where('user_id', '=', $userid)->get();
	}
}