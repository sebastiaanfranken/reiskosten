<?php
namespace Sfranken\Bootstrapped\Facades;

use Illuminate\Support\Facades\Facade;

class Bootstrapped extends Facade
{
	/**
	 * Get the registered name of the component
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'bootstrapped';
	}
}
