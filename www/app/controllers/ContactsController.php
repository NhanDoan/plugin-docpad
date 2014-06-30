<?php

class ContactsController extends \BaseController {

	/**
	 * Store a newly created resource in storage.
	 * POST /contacts
	 *
	 * @return Response
	 */
	public function store()
	{
		
		$contactParams = Input::except('_token');
		$mortgageParams = Session::get('mortgageParams');
		$contactKey = Hash::make('test');
		Session::put('contactKey', $contactKey);

		// Set default value
		$mortgageParams['TermsofService'] = $mortgageParams['TCPAConsent'] = 'No';

		// Set to 'Yes' if user checked "I’m receiving disability compensation from the VA" else 'No'
		$mortgageParams['receivingDisability'] = (isset($mortgageParams['receivingDisability'])) ? 'Yes' : 'No';

		// Set to 'Yes' if user checked "Connect me with a realtor in my area that specializes in VA Loan home pruchases" else 'No'
		$mortgageParams['connectwitharealtor'] = (isset($mortgageParams['connectwitharealtor'])) ? 'Yes' : 'No';

		// Set to 'Yes' if user checked "I agree with the Terms of Service" in contact form
		if ( isset($contactParams['TermsofService']) ) {
			$mortgageParams['TermsofService'] = 'Yes';
			unset($contactParams['TermsofService']);
		}

		// Set to 'Yes' if user checked "I agree to the Auto Dialer Disclosure" in contact form
		if ( isset($contactParams['TCPAConsent']) ) {
			$mortgageParams['TCPAConsent'] = 'Yes';
			unset($contactParams['TCPAConsent']);
		}

		$leadExecUrl = Config::get('leadexecapi.url');

    $params = Helpers::mapParamLeadExec($mortgageParams, $contactParams);

    $contact = new Contact;
		$contact->key = $contactKey;
		$contact->params = json_encode($params);
		
		if (!$contact->save()) {
			return json_encode(array('message' => 'Error'));
		};

    return json_encode(array('message' => ''));

	}


	/**
	 * Show the form for editing the specified resource.
	 * GET /contacts/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /contacts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


}