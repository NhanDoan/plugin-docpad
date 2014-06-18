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
		
		$params = array(
									'stateAbbr'			=> '',
									'marketplaceId'	=> 10000,
									'loanAmount'		=> 70000,
								);
		$results = Helpers::curl_exec_format($params);

		$this->layout->content = View::make('site/index');
	}

}
