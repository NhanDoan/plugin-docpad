<?php
class Helpers {

    /**
    * execute curl
    * @param  string $uri    url of api
    * @param  array  $params get paramater
    * @return string  resutl with json format
    */
    public static function curl_execute( $apiUrl, $params = array() ) {

        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 0);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        if ( !empty( $params ) ) {
            
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

            // call geocode api the successful
            if ( $results['status'] === 'OK') {

                $address = $results['results'][0]['address_components'];
                $results = '-1';

                foreach ($address as $add) {
                    if ( isset($add['types'][0]) && $add['types'][0] == 'administrative_area_level_1') {
                        $results = ( strlen($add['short_name']) === 2 ) ? $add['short_name'] : '-1';
                        break;
                    }
                }

            } // call mortech api the successful
            elseif ( $results['status'] === 0 ) {
                $results = isset($results['lenderOffers']['@items']) ? $results['lenderOffers']['@items'] : array();
            } // call mortech api fail 
            elseif ( $results['status'] === '-1') {
                $results = $results['errorMsg'];
            } // ZERO_RESULTS in the zipcode fail
            else {
                $results = '-1';
            }
            
        }

        return $results;
    }

    /**
    * execute curl and format result
    * @param  string $uri    url of api
    * @param  array  $params get paramater
    * @return array  results after format
    */
    public static function mortech_execute($params = array()) {
        $apiUrl = Config::get('mortechapi.url');
        $apiParams = Config::get('mortechapi.params');

        if ( !empty($params = array_diff( $params, array('', ' ', null, false) )) ) {

            $apiParams = array_merge($apiParams, $params);
        }

        $result_str = Helpers::curl_execute( $apiUrl, $apiParams );

        return Helpers::format_result($result_str);
    }

    /**
     * use api map to get state by zipcode
     * @param  string $zipcde is a string 5 character
     * @return string stateAbbr
     */
    public static function geocode_execute( $zipcode ) {
        $apiUrl = Config::get('geocodeapi.url');
        $apiUrl .= '?address='.$zipcode;
        $params = array('address' => $zipcode);

        $result_str = Helpers::curl_execute( $apiUrl, $params );

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

    /**
     * convert number to money
     * @param  int $value 
     * @return string
     */
    public static function money($value) {
        return '$' . number_format( $value, 0, '', ',' ); 
    }
}