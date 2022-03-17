<?php

require_once __DIR__ . '/../vendor/autoload.php';

WpOrg\Requests\Autoload::register();

function getCountries() 
{
	$url = "http://localhost:7009/countries";

	$headers = array('Content-Type' => 'application/json');

	$response = WpOrg\Requests\Requests::get($url, $headers);

	$countries = json_decode($response->body);

	return $countries; 
}

function creatUser($name, $middleName, $firstName, $phoneNumber, $password, $role, $pays)
{

	$url = "http://localhost:8080/users";

	$headers = array('Content-Type' => 'application/json');

	$data = array('name' => $name, 'middleName' => $middleName, 
	'firstName' => $firstName,  'phoneNumber' => $phoneNumber, 
	'password' => $password, 'role' => $role, 'pays' => $pays );

	$response = WpOrg\Requests\Requests::post($url, array(), $data);
	
	$user = json_decode($response->body);

	if ($response->status_code == 200) 
	{
		return $user; 
	}
	elseif ($response->status_code == 400) 
	{
		$error = $user->message;
		return $error;
	}
	else
	{
		return false; 
	}	
}

function getCountrycode($countryName)
{
	$url = "http://localhost:7009/countries/countryCode/".$countryName;

	$headers = array('Content-Type' => 'application/json');

	$response = WpOrg\Requests\Requests::get($url, $headers);

	$countryCode = json_decode($response->body);

	if ($response->status_code == 200) 
	{
		return $countryCode;
	}
	else 
	{
		return false;
	}	 
}

function getCurrency($countryCode)
{
	$url = "http://localhost:7009/countries/".$countryCode;

	$headers = array('Content-Type' => 'application/json');

	$response = WpOrg\Requests\Requests::get($url, $headers);

	$currency = json_decode($response->body);

	if ($response->status_code == 200) 
	{
		return $currency; 
	}
	else 
	{
		return false;
	}	
}

function getCurrencyByowner($ownerId)
{
	$url = "http://localhost:7009/countries/owner/".$ownerId;

	$headers = array('Content-Type' => 'application/json');

	$response = WpOrg\Requests\Requests::get($url, $headers);

	$currency = json_decode($response->body);

	if ($response->status_code == 200) 
	{
		return $currency; 
	}
	else 
	{
		return false;
	}	
}

function creatAccount($currency, $ownerId)
{

	$url = "http://localhost:7009/accounts";

	$headers = array('Content-Type' => 'application/json');

	$data = array('currency' => $currency, 'ownerId' => $ownerId);

	$response = WpOrg\Requests\Requests::post($url, array(), $data);
	
	$account = json_decode($response->body);

	if ($response->status_code == 200) 
	{
		return $account; 
	}
	else
	{
		return false;
	}
}

function checkPassword($phoneNumber, $password)
{
	$url = "http://localhost:8080/users/auth";

	$headers = array('Content-Type' => 'application/json');

	$data = array('phoneNumber' => $phoneNumber, 'password' => $password);

	$response = WpOrg\Requests\Requests::post($url, array(), $data);
	
	$data = json_decode($response->body);

	if ($response->status_code == 200) 
	{
		return $data; 
	}
	else
	{
		return false;
	}
}

function getUserByid($id)
{
	$url = "http://localhost:8080/users/".$id;

	$headers = array('Content-Type' => 'application/json');

	$response = WpOrg\Requests\Requests::get($url, $headers);

	$user = json_decode($response->body);

	if ($response->status_code == 200) 
	{
		return $user; 
	}
	else
	{
		return false;
	}	
}

function getTransfertByowner($ownerId)
{
	$url = "http://localhost:7009/transferts/owner/".$ownerId;

	$headers = array('Content-Type' => 'application/json');

	$response = WpOrg\Requests\Requests::get($url, $headers);

	$transfert = json_decode($response->body);

	if ($response->status_code == 200) 
	{
		return $transfert; 
	}
	else 
	{
		if ($transfert->message == "NOT FOUND") {
			return 1;
		}
		else
		{
			return false;
		}
	}		
}

function getBalanceByowner($ownerId)
{
	$url = "http://localhost:7009/accounts/balance/".$ownerId;

	$headers = array('Content-Type' => 'application/json');

	$response = WpOrg\Requests\Requests::get($url, $headers);

	$balance = json_decode($response->body);

	if ($response->status_code == 200) 
	{
		return $balance; 
	}
	else 
	{
		return false;
	}
}

function getBeneficiariesByowner($ownerId)
{
	$url = "http://localhost:7009/beneficiaries/owner/".$ownerId;

	$headers = array('Content-Type' => 'application/json');

	$response = WpOrg\Requests\Requests::get($url, $headers);

	$beneficiary = json_decode($response->body);

	if ($response->status_code == 200) 
	{
		return $beneficiary; 
	}
	else 
	{
		if ($beneficiary->message == "NOT FOUND") {
			return 1;
		}
		else
		{
			return false;
		}
	}
}

function addBeneficiary($ownerId, $numAccount, $label)
{
	$url = "http://localhost:7009/beneficiaries";

	$headers = array('Content-Type' => 'application/json');

	$data = array('ownerId' => $ownerId, 'numAccount' => $numAccount,'label' => $label);

	$response = WpOrg\Requests\Requests::post($url, array(), $data);
	
	$beneficiary = json_decode($response->body);

	if ($response->status_code == 200) 
	{
		return $beneficiary; 
	}
	elseif ($response->status_code == 400) 
	{
		$error = $beneficiary->message;
		return $error;
	}
	else
	{
		return false; 
	}
}

function creatTransfert($ownerId, $userIdBeneficiary, $amountSent, $amountReceived,
$currency, $numAccount, $taux, $label)
{
	$url = "http://localhost:7009/transferts";

	$headers = array('Content-Type' => 'application/json');

	$data = array('ownerId' => $ownerId, 'userIdBeneficiary' => $userIdBeneficiary,
	'amountSent' => $amountSent, 'amountReceived' => $amountReceived, 
	'currency' => $currency, 'numAccount'=> $numAccount, 'taux' => $taux, 'label' => $label);

	$response = WpOrg\Requests\Requests::post($url, array(), $data);
	
	$transfert = json_decode($response->body);

	if ($response->status_code == 200) 
	{
		return $transfert; 
	}
	else 
	{
		return $response->status_code;
	}
}

function getLabel($ownerId, $userIdBeneficiary)
{
	$url = "http://localhost:7009/beneficiaries/label";

	$headers = array('Content-Type' => 'application/json');

	$data = array('ownerId' => $ownerId, 'userIdBeneficiary' => $userIdBeneficiary);

	$response = WpOrg\Requests\Requests::post($url, array(), $data);

	$label = json_decode($response->body);

	if ($response->status_code == 200) 
	{
		return $label; 
	}
	else 
	{
		return false;
	}	
}

function  getAccountByowner($ownerId)
{
	$url = "http://localhost:7009/accounts/owner/".$ownerId;

	$headers = array('Content-Type' => 'application/json');

	$response = WpOrg\Requests\Requests::get($url, $headers);

	$account = json_decode($response->body);

	if ($response->status_code == 200) 
	{
		return $account; 
	}
	else 
	{
		return false;
	}	
}

function getRate($baseCurrency, $currencyBeneficiary)
{
	$url = 'https://freecurrencyapi.net/api/v2/latest?apikey=e21ce700-9bb8-11ec-9c81-071d5a842482&base_currency='.$baseCurrency;
	
	$headers = array('Content-Type' => 'application/json');
	
	$response = WpOrg\Requests\Requests::get($url, $headers);

	$taux = json_decode($response->body);

	if ($response->status_code == 200) 
	{
		return $taux->data->$currencyBeneficiary; 
	}
	else 
	{
		return false;
	}
}

function removeBeneficiary($id)
{
	$url = "http://localhost:7009/beneficiaries/".$id;

	$headers = array('Content-Type' => 'application/json');

	$response = WpOrg\Requests\Requests::delete($url, $headers);

	if ($response->status_code == 200) 
	{
		return true; 
	}
	else 
	{
		return false;
	}	
}

function getTransferts()
{
	$url = "http://localhost:7009/transferts";

	$headers = array('Content-Type' => 'application/json');

	$response = WpOrg\Requests\Requests::get($url, $headers);

	$transfert = json_decode($response->body);

	if ($response->status_code == 200) 
	{
		return $transfert; 
	}
	else 
	{
		if ($transfert->message == "Application Error") {
			return 1;
		}
		else
		{
			return false;
		}
	}	
}

