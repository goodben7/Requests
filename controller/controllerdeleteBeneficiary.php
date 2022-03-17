<?php 
session_start();  

$host = "http://localhost:8888/";

if(isset($_POST['label']))
{
	include __DIR__ . '/../public/index.php';

	$id = $_POST['label']; 

	$return = removeBeneficiary($id);
	if ($return == false) 
	{
		$message = "Application Error";
		header('Location:' .$host. 'template/deleteBeneficiary.php?err=' .$message);
		exit();
	}
	else
	{
		header('Location:' .$host. 'template/viewBeneficiary.php');
		exit();
	}
}

else 
{
	$message = "You Must Fill All The Fields";
	header('Location:' .$host. 'template/deleteBeneficiary.php?err=' .$message);
	exit();
} 