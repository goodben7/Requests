<?php 
session_start();

$host = "http://localhost:8888/";  

if(isset($_POST['phoneNumber']) and isset($_POST['password']))
{
	include __DIR__ . '/../public/index.php';
	$phoneNumber = $_POST['phoneNumber'];
	$password = $_POST['password'];
	$auth = checkPassword($phoneNumber, $password);
	if ($auth == false) 
	{
		$message = "Authentification Error Access Denied";
		header('Location:' .$host. 'template/login.php?err=' .$message);
		exit();
	}

	$id = $auth->id;

	$user = getUserByid($id);
	if ($user == false) 
	{
		$message = "USER NOT FOUND";
		header('Location:' .$host. 'template/singin.php?err=' .$message);
		exit();
	}

	$role = $user->role;
	if ($role == "Operateur") 
	{
		$_SESSION['role'] = $role;
		header('Location:' .$host. 'template/viewTransferts.php');
		exit();
	}


	$userId = $user->userId;
	$_SESSION['userId'] = $userId;
	header('Location:' .$host. 'template/viewTransfert.php');
	exit();
}
else 
{
	$message = "You Must Fill All The Fields";
	header('Location:' .$host. 'template/login.php?err=' .$message);
	exit();
}