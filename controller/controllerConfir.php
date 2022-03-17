<?php 
session_start();  

$host = "http://localhost:8888/";

if(isset($_SESSION['userId']))
{
	include __DIR__ . '/../public/index.php';

	$ownerId =$_SESSION['userId']; 
  	$userIdBeneficiary = $_SESSION['userIdBeneficiary'];
  	$amountSent =  $_SESSION['amountSent'];
  	$amountReceived = $_SESSION['amountReceived'];
  	$currencyOwner = $_SESSION['currencyOwner'];
  	$currencyBeneficiary = $_SESSION['currencyBeneficiary'];
  	$currency = $currencyOwner."/".$currencyBeneficiary;
  	$taux = $_SESSION['taux'];
  	$label = $_SESSION['label'];

  	$account = getAccountByowner($userIdBeneficiary);
  	if ($account == false) 
  	{
	    $message = "USER NOT FOUND";
	    header('Location:' .$host. 'template/login.php?err=' .$message);
	    exit();
  	}
  	$numAccountBeneficiary = $account->numAccount;


	$transfert = creatTransfert($ownerId, $userIdBeneficiary, $amountSent, $amountReceived, 
	$currency, $numAccountBeneficiary, $taux, $label);
	if ($transfert == false) 
	{
		$message = "Application Error";
		header('Location:' .$host. 'template/newTransfert.php?err=' .$message);
		exit();
	}
	header('Location:' .$host. 'template/viewTransfert.php');
	exit();
}
else 
{
	$message = "You Must Fill All The Fields";
	header('Location:' .$host. 'template/newTransfert.php?err=' .$message);
	exit();
}