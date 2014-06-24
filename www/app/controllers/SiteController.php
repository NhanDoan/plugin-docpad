<?php

class SiteController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Site Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'SiteController@index');
	|
	*/
	public function index()
	{
		$params = Input::except('_token');

		if (!isset($params['zipCode']))
			$params['zipCode'] = '10014';
	
		$results = $this->calculate();

		$this->layout->content = View::make('site/index', compact('params', 'results'));

	}

	public function getRates() {
		
		$results = $this->calculate();

		return View::make('site/partials/_lender-list', compact('results'));

	}

	/**
	 * calculate and get data from api
	 * @param  array  $params paramater user enter
	 * @return array  results
	 */
	private function calculate() {
		
		$params = Input::except('zipCode', '_token');
		$zipCode = Input::get('zipCode', '10014');

		$stateAbbr = Helpers::geocodeExecute($zipCode);

		$params = ($stateAbbr !== '-1' ) ? array_merge( $params, array('stateAbbr' => $stateAbbr) ) : $params;

		if ( isset($params['mortgageType']) ) {
			if ( $params['mortgageType'] == 'purchase' ) {
				$params['propertyValue'] = 200000;

				if (isset($params['loanAmount']))
					$params['propertyValue'] = $params['loanAmount'] + (($params['downPayment'] / 100) * $params['loanAmount']);

			} else {
				
				$params['currentMortgageBalance'] = $params['propertyValue'] = 200000;
				// $params['propertyValue'] = $params['loanAmount'];
				unset($params['loanAmount']);

				if (isset($params['cash']) && $params['cash'] == 1)
					$params['mortgageType'] = 4;
			}
		} // if user not select 'Loan Purpose' radio set default value
		else {
			// $params['loanAmount'] = $params['propertyValue'] = 200000;
			$params['propertyType'] = 1; // Single Family
			$params['propertyValue'] = 200000;
			$params['loanProduct'] = 2; // 30 year Fixed
			$params['creditRating'] = 5; // excellent (740-850)
			$params['veteranType'] = 0; // veteran
		}

		// if user check "I'm receiving disability compensation from the VA"
		if (isset($params['receive'])) {
			$params['veteranType'] = 2;
		}

		unset($params['mortgageType']);
		unset($params['cash']);

		return Helpers::mortechExecute($params);

	}

	/**
	 * get list news from VA LOAN Captain
	 * @return none
	 */
	public function getValoanNews() {
		$valoanNews = Helpers::getValoanNews();

		return View::make('site/partials/_valoan-news', compact('valoanNews'));
	}

	/**
	 * get list news from Veteran
	 * @return none
	 */
	public function getVeteranNews() {
		$veteranNews = Helpers::getVeteranNews();

		return View::make('site/partials/_veteran-news', compact('veteranNews'));
	}

}
