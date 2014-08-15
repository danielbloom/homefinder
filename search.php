<?php
/**
*	Search.php
*	
*	Receives parameters via ajax call from the client then assembles
*   those params to make a call to the Homefinder API
*/

require_once("Homefinder.php");

// retrieve params and set defaults
$area = isset($_GET['area']) ? $_GET['area'] : 'Chicago, Il';
$priceMin = isset($_GET['price_min']) ? $_GET['price_min'] : '*';
$priceMax = isset($_GET['price_max']) ? $_GET['price_max'] : '';
$beds = isset($_GET['beds']) ? $_GET['beds'] : '1';
$page = isset($_GET['page']) ? $_GET['page'] : '1';

$params = array();
$params['area'] = $area;
$params['price']  = $priceMin . ' TO ' . $priceMax;
$params['bed'] = $beds;
$params['page'] = $page;

$hf = new Homefinder();

echo $hf->apiCall('search', $params);