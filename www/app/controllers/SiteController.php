<?php

class SiteController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function index()
	{
		// $stateAbbr = Helpers::geocode_execute('94107');
		// $params = array(
		// 							'stateAbbr'			=> $stateAbbr,
		// 							'marketplaceId'	=> 10000,
		// 							'loanAmount'		=> 70000,
		// 						);
		// $results = Helpers::mortech_execute($params);

		$this->layout->content = View::make('site/index');
	}

}
