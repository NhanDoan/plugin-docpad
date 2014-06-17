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

		$uri = 'https://awsratecloud.mortech-inc.com/servlet/MarketplaceServlet';
		$params = array(
									'licenseKey' 		=> 'k98fLwDVYaaNRy/5IN0fciIaEgce4YwK7q8aU/WKfH4=',
									'stateAbbr'			=> 'TX',
									'marketplaceId'	=> 10000,
									'loanAmount'		=> 70000,
									'lender'				=> '17nbkc01',
									'lender1' 			=> '17kans01',
									'lender2' 			=> '17nasb01',
									'lender3' 			=> '37gpnm01',
									'lender4' 			=> '05harb01',
								);
		$results = Helpers::curl_exec_format($uri, $params);
		
		$this->layout->content = View::make('site/index');
	}

}
