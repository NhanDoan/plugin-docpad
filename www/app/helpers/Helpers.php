<?php
class Helpers {

    /**
    * execute curl
    * @param  string $uri    url of api
    * @param  array  $params get paramater
    * @return string  resutl with json format
    */
    public static function curlExecute( $apiUrl, $params = array() ) {

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
            
            $queryString = Helpers::buildQueryString($params);

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
    public static function formatResult( $str ) {
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
    public static function mortechExecute($params = array()) {
        $apiUrl = Config::get('mortechapi.url');
        $apiParams = Config::get('mortechapi.params');

        if ( !empty($params = array_diff( $params, array('', ' ', null, false) )) ) {

            $apiParams = array_merge($params, $apiParams);
        }

        $resultStr = Helpers::curlExecute( $apiUrl, $apiParams );

        return Helpers::formatResult($resultStr);
    }

    /**
     * use api map to get state by zipcode
     * @param  string $zipcde is a string 5 character
     * @return string stateAbbr
     */
    public static function geocodeExecute( $zipCode ) {
        $apiUrl = Config::get('geocodeapi.url');
        $apiUrl .= '?address='.$zipCode;
        $params = array('address' => $zipCode);

        $resultStr = Helpers::curlExecute( $apiUrl, $params );

        return Helpers::formatResult($resultStr);

    }

    /**
    * convert array params to querystring
    * @param  array  $params get paramater
    * @return string querystring
    */
    public static function buildQueryString($params = array()) {
        $queryArray = array();

        foreach ( $params as $key => $value ) {

            $queryArray[] = ((strpos($key, 'lender') !== FALSE) ? 'lender' : $key) . '=' . $value;

        }

        return implode( '&', $queryArray );

    }

    /**
     * convert number to money
     * @param  int $value 
     * @return string
     */
    public static function money($value) {
        return '$' . number_format( $value, 0, '', ',' ); 
    }

    /**
     * get Veteran News
     * @return array is a list news
     */
    public static function getVeteranNews() {

        $rssUrl = Config::get('veteran-news-rss.rss_url');

        $xml = simplexml_load_file($rssUrl);

        if ( !empty($xml) ) {
            // only get 3 items
            $items = $xml->xpath('/rss/channel/article[position() <= 3]');
            
            return $items;
        }
        
        return null;
    }

    /**
     * Truncate a string with length
     * @param  string  $str
     * @param  integer $length
     * @param  string  $more
     * @return string a string after truncate
     */
    public static function strLimit( $str, $length = 160, $more = '...') {
        
        if (strlen($str) <= $length) return $str;

        $newStr = substr($str, 0, $length);

        if (substr($newStr, -1, 1) != ' ') 
            $newStr = substr($newStr, 0, strrpos($newStr, " "));

        return $newStr . $more;

    }


    /**
    * Used connection named 'wpe' to connect to wordpress engine
    * for getting 3 of new feeds
    * TODO: should be caching here.
    */
    public static function getValoanNews() {
        try {
            $newPosts = DB::connection('wpe')
                    ->select('SELECT p.post_title, p.post_content, p.guid, p.post_modified, u.display_name FROM wp_posts AS p
                        LEFT JOIN wp_users AS u ON p.post_author = u.ID
                        WHERE post_status = "publish"
                        ORDER BY post_modified DESC LIMIT 3');

        } catch(Exception $e) {
           $newPosts = 'Cannot connect to Database';
        }

        return $newPosts;
    }
}