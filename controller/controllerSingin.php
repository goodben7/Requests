<?php 

$host = "http://localhost:8888/"; 

if(isset($_POST['name']) and isset($_POST['middleName']) and isset($_POST['firstName']) and  
isset($_POST['phoneNumber']) and isset($_POST['password']) and isset($_POST['role']) and 
isset($_POST['pays']))
{
	include __DIR__ . '/../public/index.php';

	$name = $_POST['name'];

	$middleName = $_POST['middleName'];

	$firstName = $_POST['firstName'];

	$phoneNumber = $_POST['phoneNumber'];

	$password = $_POST['password'];

	$role = $_POST['role'];

	$pays = $_POST['pays'];
	
	$user = creatUser($name, $middleName, $firstName, $phoneNumber, $password, $role, $pays);

	if ($user == "Application Error The Phone Number Used Already Exists") 
	{
		if ($user == false) 
		{
			$message = "Application Error";
			header('Location:' .$host. 'template/singin.php?err=' .$message);
			exit();
		}
		header('Location:' .$host. 'template/singin.php?err=' .$user);
		exit();
	}

	$pays = $user->pays;

	$userId = $user->userId;

	$countryCode = getCountrycode($pays);
	if ($countryCode == false) 
	{
		$message = "Application Error";
		header('Location:' .$host. 'template/singin.php?err=' .$message);
		exit();
	}

	$countryCode = $countryCode->countryCode;

	$currency = getCurrency($countryCode);
	if ($countryCode == false) 
	{
		$message = "Application Error";
		header('Location:' .$host. 'template/singin.php?err=' .$message);
		exit();
	}

	$currency = $currency->currency;

	$account = creatAccount($currency, $userId);
	if ($countryCode == false) 
	{
		$message = "Application Error";
		header('Location:' .$host. 'template/singin.php?err=' .$message);
		exit();
	}

	$message = "Your Account Has Been Created, You Can Log In";
	header('Location:' .$host. 'template/login.php?conf=' .$message);
	exit();


}
else 
{
	$message = "You Must Fill All The Fields";
	header('Location:' .$host. 'template/singin.php?err=' .$message);
	exit();
}