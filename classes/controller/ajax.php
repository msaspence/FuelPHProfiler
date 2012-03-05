<?php

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */

class Controller_FuelPHProfilerAjax extends Controller
{
	public function action_latest_grind()
	{
		$_GET['op'] = "function_list";
		$_GET['dataFile'] = 0;
		$_GET['showFraction'] = 1;
		$_GET['hideInternals'] = 0;
		$_GET['costFormat'] = 'usec';

		// @todo think about removing at some point
		$_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

		require_once __DIR__."/../../vendor/webgrind/ajax.php";
	}
}