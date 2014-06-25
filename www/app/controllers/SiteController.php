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
			$params['propertyValue'] = 200000;

			if ( strtolower($params['mortgageType']) == 'purchase' ) {
				// if user selected loanAmount 
				if (isset($params['loanAmount']))
					$params['propertyValue'] = $params['loanAmount'] + (($params['downPayment'] / 100) * $params['loanAmount']);
				
				// else set default
				else
					$params['loanAmount'] = 200000;

			} else {

				// $params['propertyValue'] = $params['loanAmount'];
				if (isset($params['cash']))

					// if user checked 'Interest Rate Reduction Refinance Loan (IRRRL)'
          if ($params['cash'] == 1)
        		$params['mortgageType'] = 4;
          else
            $params['additionalCashOutAmount'] = (double)preg_replace("/[^0-9\.]/", "", $params['additionalCashOutAmount']);

        // if user selected loanAmount 
        if (isset($params['loanAmount']))
					$params['propertyValue'] = $params['currentMortgageBalance'] = $params['loanAmount'];
				// else set default
				else
					$params['currentMortgageBalance'] = 200000;

        unset($params['loanAmount']);
        unset($params['loanProduct']);
        unset($params['propertyType']);
			}
		}
		
		// if user checked "I'm receiving disability compensation from the VA"
		if (isset($params['receive'])) {
			$params['veteranType'] = 2;
		}

		if ((isset($params['cash']) && $params['cash'] != 1) || strtolower($params['mortgageType']) == 'purchase')
			unset($params['mortgageType']);

		unset($params['cash']);
		unset($params['downPayment']);
		unset($params['receive']);
		unset($params['connect']);

		return Helpers::mortechExecute(array_reverse($params));

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
