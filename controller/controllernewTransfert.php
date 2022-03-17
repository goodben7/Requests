<?php 
session_start();  

$host = "http://localhost:8888/";

if(isset($_POST['amountSent']) and isset($_POST['label']))
{
	include __DIR__ . '/../public/index.php';

	$ownerId = $_SESSION['userId'];
	
	$amountSent = $_POST['amountSent'];
	$userIdBeneficiary = $_POST['label'];

	$balance = getBalanceByowner($ownerId);
	if ($balance == false) 
	{
	  	$message = "Application Error";
		header('Location:' .$host. 'template/newTransfert.php?err=' .$message);
		exit();
	}
	$balance = $balance->balance;
	if ($amountSent >= $balance or $amountSent == 0) 
	{
		$message = "SOLDE INSUFFISANT";
	  	header('Location:' .$host. 'template/newTransfert.php?err=' .$message);
	  	exit();
	}

	$currencyOwner = getCurrencyByowner($ownerId);
	if ($currencyOwner == false) 
	{
		$message = "Application Error";
		header('Location:' .$host. 'template/newTransfert.php?err=' .$message);
		exit();
	}
	$currencyOwner = $currencyOwner->currency;

	$currencyBeneficiary = getCurrencyByowner($userIdBeneficiary);
	if ($currencyBeneficiary == false) 
	{
		$message = "Application Error";
		header('Location:' .$host. 'template/newTransfert.php?err=' .$message);
		exit();
	}
	$currencyBeneficiary = $currencyBeneficiary->currency;

	$taux = getRate($currencyOwner, $currencyBeneficiary);
	if ($taux == false) 
	{
		$message = "Échec De La Récupération Du taux";
		header('Location:' .$host. 'template/newTransfert.php?err=' .$message);
		exit();
	}
	$amountReceived = $amountSent * $taux;


	$label = getLabel($ownerId, $userIdBeneficiary);
	if ($label == false) 
	{
		$message = "Application Error";
		header('Location:' .$host. 'template/newTransfert.php?err=' .$message);
		exit();
	}
	$label = $label->label;

	$account = getAccountByowner($userIdBeneficiary);
  	if ($account == false) 
  	{
	    $message = "USER NOT FOUND";
	    header('Location:' .$host. 'template/login.php?err=' .$message);
	    exit();
  	}
  	$numAccountBeneficiary = $account->numAccount;

	$_SESSION['userId'] = $ownerId;
	$_SESSION['userIdBeneficiary'] = $userIdBeneficiary;
	$_SESSION['amountSent'] = $amountSent;
	$_SESSION['amountReceived'] = $amountReceived;
	$_SESSION['numAccount'] = $numAccountBeneficiary;
	$_SESSION['currencyOwner'] = $currencyOwner;
	$_SESSION['currencyBeneficiary'] = $currencyBeneficiary;
	$_SESSION['taux'] = $taux;
	$_SESSION['label'] = $label;
	header('Location:' .$host. 'template/confir.php');
	exit();
}
else 
{
	$message = "You Must Fill All The Fields";
	header('Location:' .$host. 'template/newTransfert.php?err=' .$message);
	exit();
}