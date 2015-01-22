<?php

/**
 * The main bootstrapped class
 * @author Sebastiaan Franken
 * @package Sfranken\Bootstrapped
 * @see http://culttt.com/2013/06/24/creating-a-laravel-4-package/
 */

namespace Sfranken\Bootstrapped;

class Bootstrapped
{
	/**
	 * The types of messages we can show
	 * @type array
	 * @access protected
	 */
	protected $types = array('success', 'info', 'warning', 'danger');

	/**
	 * Should register the class to laravel
	 * @todo Check if that actually happens
	 */
	public function register()
	{
	}

	/**
	 * The main message function, this outputs the alert and does all the nitty-gritty hard work
	 * @param string $message The message to show
	 * @param string $type The message type
	 * @see $types
	 * @return string
	 * @todo Make it closable as well, optionally through a flag maybe?
	 */
	private function message($message, $type)
	{
		if(in_array($type, $this->types))
		{
			$html = '<div class="alert alert-%s">%s</div>';
			return sprintf($html, $type, $message);
		}

		return $message;
	}

	/**
	 * A wrapper around the main message function, this outputs the success message
	 * @param string $message The message to show
	 * @see message
	 * @return string
	 */
	public function success($message)
	{
		return $this->message($message, 'success');
	}

	/**
	 * A wrapper around the main message function, this outputs the info message
	 * @param string $message The message to show
	 * @see message
	 * @return string
	 */
	public function info($message)
	{
		return $this->message($message, 'info');
	}

	/**
	 * A wrapper around the main message function, this outputs the warning message
	 * @param string $message The message to show
	 * @see message
	 * @return string
	 */
	public function warning($message)
	{
		return $this->message($message, 'warning');
	}

	/**
	 * A wrapper around the main message function, this outputs the danger message
	 * @param string $message The message to show
	 * @see message
	 * @return string
	 */
	public function danger($message)
	{
		return $this->message($message, 'danger');
	}
}
