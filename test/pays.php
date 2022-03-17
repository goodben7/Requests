<?php

require_once __DIR__ . '/../vendor/autoload.php';

WpOrg\Requests\Autoload::register();

$app_id = 'e4b4bbcd08bb41688a774eef8e33a954';


//$url = "http://api.exchangeratesapi.io/v1/latest?access_key=".$app_id."&base=GBP&symbols = USD,AUD,CAD,PLN,MXN";

//$url = "https://api.exchangeratesapi.io/v1/latest?access_key=".$app_id;

//$url = "https://openexchangerates.org/api/latest.json?app_id=".$app_id." &symbols=CDF,EUR,MAD,JPY,MXN";




//$url = "https://openexchangerates.org/api/latest.json?app_id=".$app_id."&base=CDF";

	$baseCurrency = "CDF";
	$currencyBeneficiary = "EUR";   
	$url = 'https://freecurrencyapi.net/api/v2/latest?apikey=e21ce700-9bb8-11ec-9c81-071d5a842482&base_currency='.$baseCurrency;
	
	$headers = array('Content-Type' => 'application/json');
	
	$response = WpOrg\Requests\Requests::get($url, $headers);

	$taux = json_decode($response->body);

	if ($response->status_code == 200) 
	{
		echo $taux->data->$currencyBeneficiary; 
	}
	else 
	{
		echo false;
	}








