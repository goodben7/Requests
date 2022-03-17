<?php


namespace WpOrg\Requests;


require_once 'Autoload.php';

WpOrg\Requests\Autoload::register();


$url = "http://localhost/Webservice_Transferts/countries";

$response = WpOrg\Requests\Requests::get($url);

$countries = json_decode($response->body);


$allemagne = $countries[0]->countryName;
$maroc = $countries[1]->countryName;
$japon = $countries[2]->countryName;
$mexique = $countries[3]->countryName;
$rdc = $countries[4]->countryName;



