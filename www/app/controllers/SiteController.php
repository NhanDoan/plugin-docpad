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

		if (!isset($params['zipCode']) || !$params['zipCode'])
			$params['zipCode'] = '10014';

		$results = $this->calculate();
		$mortgageParams = Session::get('mortgageParams');
		$params['state'] = $mortgageParams['stateAbbr'];

		$this->layout->content = View::make('site/index', compact('params', 'results'));

	}

	public function getRates() {
		
		$results = $this->calculate();
		$mortgageParams = Session::get('mortgageParams');
		$state = $mortgageParams['stateAbbr'];

		return View::make('site/partials/_lender-list', compact('results', 'state'));

	}

	/**
	 * calculate and get data from api
	 * @param  array  $params paramater user enter
	 * @return array  results
	 */
	private function calculate() {
		
		$params = Input::except('zipCode', '_token');
		$zipCode = Input::get('zipCode');

		$stateAbbr = Helpers::geocodeExecute($zipCode ? $zipCode : '10014');

		if ($stateAbbr !== '-1')
			$params = array_merge( $params, array('stateAbbr' => $stateAbbr) );
		else
			return 'ZipCode Invalid';

		if ( isset($params['veteranType']) && $params['veteranType'] == -1)
			$params['veteranType'] = 0;

		// if user checked "I'm receiving disability compensation from the VA"
		if (isset($params['receivingDisability'])) {
			$params['veteranType'] = 2;
		}

		if ( isset($params['payment']) ) {
			$params['propertyValue'] = 200000;

			if ( strtolower($params['payment']) == 'purchase' ) {
				// if user selected loanAmount 
				if (isset($params['loanAmount'])) {
					// $params['propertyValue'] = $params['loanAmount'] + (($params['downPayment'] / 100) * $params['loanAmount']);
					$params['downPaymentAmount'] = Helpers::convertDouble($params['downPaymentAmount']);
					$params['propertyValue'] = $params['loanAmount'] + $params['downPaymentAmount'];
				}
				
				// else set default
				else
					$params['loanAmount'] = 200000;

				Session::put('mortgageParams', $params);

			} else {

				// $params['propertyValue'] = $params['loanAmount'];
				if (isset($params['cash']))

					// if user checked 'Interest Rate Reduction Refinance Loan (IRRRL)'
          if ($params['cash'] == 1)
        		$params['mortgageType'] = 4;
          else
            $params['additionalCashOutAmount'] = Helpers::convertDouble($params['additionalCashOutAmount']);

        // if user selected loanAmount 
        if (isset($params['loanAmount']))
					$params['propertyValue'] = $params['currentMortgageBalance'] = $params['loanAmount'];
				// else set default
				else
					$params['currentMortgageBalance'] = 200000;

				unset($params['downPaymentAmount']);
        unset($params['loanProduct']);
        unset($params['propertyType']);

        Session::put('mortgageParams', $params);

        unset($params['loanAmount']);
			}
		}

		unset($params['payment']);
		unset($params['cash']);
		unset($params['downPayment']);
		unset($params['receivingDisability']);
		unset($params['connectwitharealtor']);

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

	public function requestQuote() {
		$contact = Contact::where('key', Session::get('contactKey'))->first();
		$contact->posted = 1;
		$contact->save();
		Session::forget('contactKey');

		return Helpers::leadExecute(json_decode($contact->params));

	}

	public function learningCenter() {
		$this->layout->content = View::make('site/learning');
	}
}
