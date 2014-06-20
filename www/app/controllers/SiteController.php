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

		$valoanNews = Helpers::get_news();

		$params = Input::except('_token');
	
		$results = $this->calculate();

		$this->layout->content = View::make('site/index', compact('params', 'results', 'valoanNews'));

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
	public function calculate() {
		
		$params = Input::except('zipCode', '_token');
		$zipCode = '94107';//Input::get('zipCode');

		$stateAbbr = Helpers::geocode_execute($zipCode);

		$params = ($stateAbbr !== '-1' ) ? array_merge( $params, array('stateAbbr' => $stateAbbr) ) : $params;

		if ( isset($params['mortgageType']) ) {
			if ( $params['mortgageType'] == 'purchase' ) {
				$params['propertyValue'] = 200000;

				if (isset($params['loanAmount']))
					$params['propertyValue'] = $params['loanAmount'] + (($params['downPayment'] / 100) * $params['loanAmount']);

			} else {
				
				$params['currentMortgageBalance'] = $params['propertyValue'] = $params['loanAmount'];
				// $params['propertyValue'] = $params['loanAmount'];
				unset($params['loanAmount']);

				if ($params['cash'] == 1)
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

		return Helpers::mortech_execute($params);

	}

	/**
	 * validate zipcode
	 * @param  string $zipcode zipcode user enter
	 * @return json   string json message
	 */
	public function validateZip($zipCode) {
		$message = '';

        if( !is_numeric($zipCode) || strlen($zipCode) != 5 ) {

            $message = 'Zipcode Invalid';
        } else {

            $stateAbbr = Helpers::geocode_execute($zipCode);
            $message = ($stateAbbr == '-1') ? 'Zipcode Invalid' : '' ;
        }
        return json_encode(array('message' => $message));
	}

}
