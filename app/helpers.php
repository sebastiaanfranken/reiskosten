<?php

/**
 * A custom ini_isset function 
 * @param string $extension The extension to check (like `date`)
 * @param string $key The extension key to check
 * @return bool
 * @author Sebastiaan Franken
 */
if(!function_exists('ini_isset'))
{
	function ini_isset($extension, $key)
	{
		$ini = ini_get_all($extension);
		$key = $extension . '.' . $key;

		return (array_key_exists($key, $ini) && array_key_exists('global_value', $ini[$key])) ? true : false;
	}
}

/**
 * A custom timestamp function
 * @param DateTime $timestamp The timestamp to work with
 * @param string $default The default string to return
 * @param string $format The date format
 * @return string
 * @author Sebastiaan Franken
 */
if(!function_exists('timestamp'))
{
	function timestamp($timestamp, $default = null, $format = 'd-m-Y')
	{
		if(!is_null($timestamp))
		{
			$timezone = ini_isset('date', 'timezone') ? new DateTimeZone(ini_get('date.timezone')) : new DateTimeZone('Europe/Amsterdam');
			$datetime = new DateTime($timestamp, $timezone);
			return $datetime->format($format);
		}

		return $default;
	}
}

/**
 * A function that replaces in $string based on key => values defined in $rules
 * @param string $string The string to replace in
 * @param array $rules The rules to apply
 * @return string
 * @author Sebastiaan Franken
 */
if(!function_exists('replace'))
{
	function replace($string, array $rules = array())
	{
		if(count($rules) > 0 && array_key_exists($string, $rules))
		{
			return $rules[$string];
		}

		return $string;
	}
}

/**
 * A url parsing function, basic as of yet
 * @param string $key The thing to look for. Optional.
 * @return string
 * @author Sebastiaan Franken
 */
if(!function_exists('current_url'))
{
	function current_url($key = null)
	{
		$parts = URL::current();

		if(is_null($key) || $key == 'all')
		{
			return $parts;
		}
		else
		{
			switch($key)
			{
				case 'base': return dirname($parts); break;
				case 'folder': return basename($parts); break;
				default: return $parts; break;
			}
		}
	}
}

/**
 * A wrapper around print_r() for quick and dirty debugging
 * @param mixed $what The thing to print_r()
 * @return string
 * @author Sebastiaan Franken
 */
if(!function_exists('pr'))
{
	function pr($what)
	{
		return '<pre>' . print_r($what, true) . '</pre>';
	}
}