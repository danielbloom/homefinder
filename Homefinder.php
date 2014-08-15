<?php


/**
* Homefinder class
*
*  Makes request to Homefinder API
*/
class Homefinder
{
    
    /**
    *   Makes api call to Homefinder
    *
    *   @param string $method (e.g. search, areaSuggestions etc)
    *   @param mixed $params array of params
    *   @return string (json response from API)
    */
    public function apiCall($method, $params)
    {
        $params = '?apikey=4mmpby8b72aa9y6sbx47xsgq&' . http_build_query($params);
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL => 'http://services.homefinder.com/listingServices/' . $method . $params,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_RETURNTRANSFER => true
        );

        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);
        // @TODO curl errors
        return $result;
    }
}