<?php 
session_start();  

$host = "http://localhost:8888/";

if(isset($_POST['numAccount']) and isset($_POST['label']))
{
	include __DIR__ . '/../public/index.php';

	$ownerId =$_SESSION['userId'];
	$numAccount = $_POST['numAccount'];
	$label = $_POST['label']; 

	$account = getAccountByowner($ownerId);
	if ($account == false) 
	{
		$message = "USER NOT FOUND";
		header('Location:' .$host. 'template/login.php?err=' .$message);
		exit();
	}
	$numAccountOwner = $account->numAccount;

	if ($numAccount == $numAccountOwner) 
	{
		$message = "Application Error You Cannot Add Your Own Account";
		header('Location:' .$host. 'template/newBeneficiary.php?err=' .$message);
		exit();
	}

	$beneficiary = addBeneficiary($ownerId, $numAccount, $label);

	if ($beneficiary == "Application Error Account Number Not Found") 
	{
		if ($beneficiary == false) 
		{
			$message = "Application Error";
			header('Location:' .$host. 'template/newBeneficiary.php?err=' .$message);
			exit();
		}
		header('Location:' .$host. 'template/newBeneficiary.php?err=' .$beneficiary);
		exit();
	}
	header('Location:' .$host. 'template/viewBeneficiary.php');
	exit();
}
else 
{
	$message = "You Must Fill All The Fields";
	header('Location:' .$host. 'template/newBeneficiary.php?err=' .$message);
	exit();
} 