<?php

require_once("Homefinder.php");


//print_r($_GET);

$area = isset($_GET['area']) ? $_GET['area'] : null;
$priceMin = isset($_GET['price_min']) ? $_GET['price_min'] : '*';
$priceMax = isset($_GET['price_max']) ? $_GET['price_max'] : '';
$beds = isset($_GET['beds']) ? $_GET['beds'] : '1';
$page = isset($_GET['page']) ? $_GET['page'] : '1';

$hf = new Homefinder();
// area, bedrooms, price


$params = array();
// @TODO beds range

$params['area'] = $area;
$params['price']  = $priceMin . ' TO ' . $priceMax;
$params['bed'] = $beds;
$params['page'] = $page;




echo $hf->apiCall('search', $params);