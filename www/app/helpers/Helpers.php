<?php
class Helpers {

		/**
		 * execute curl
     * @param  string $uri    url of api
     * @param  array  $params get paramater
     * @return string  resutl with json format
		 */
    public static function curl_execute($uri, $params = array()) {
    	
    	$ch = curl_init();
    	
	    //set the url, number of POST vars, POST data
	    curl_setopt($ch, CURLOPT_URL, $uri);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    	curl_setopt($ch, CURLOPT_FORBID_REUSE, 0);

	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,1);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			if ( !empty($params) ) {

				$queryString = Helpers::build_query_string($params);

				curl_setopt($ch, CURLOPT_POST, count($params));
	    	curl_setopt($ch, CURLOPT_POSTFIELDS, $queryString);
			}

	    //execute post
	    $results = curl_exec($ch);

	    //close connection
	    curl_close($ch);
	    
	    return $results;

    }

    /**
     * json decode result when call api
     * @param $str string json result
     * @return array list lender
     */
    public static function format_result( $str ) {
    	$results = json_decode( $str, true );

    	if ( !empty($results) ) {
    		return $results['lenderOffers']['@items'];
    	}

    	return array();
    }

    /**
     * execute curl and format result
     * @param  string $uri    url of api
     * @param  array  $params get paramater
     * @return array  results after format
     */
    public static function curl_exec_format($uri, $params = array()) {
    	
    	$result_str = Helpers::curl_execute( $uri, $params );

    	return Helpers::format_result($result_str);
    }

    /**
     * convert array params to querystring
     * @param  array  $params get paramater
     * @return string querystring
     */
    public static function build_query_string($params = array()) {

    	foreach ( $params as $key => $value ) {

        $query_array[] = ((strpos($key, 'lender') !== FALSE) ? 'lender' : $key) . '=' . $value;

	    }

	    return implode( '&', $query_array );
		  
    }
}