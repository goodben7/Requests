<?php 

session_start();

$host = "http://localhost:8888/"; 

if (isset($_SESSION['userId']) or isset($_SESSION['role']))
{
	session_destroy();
	header('Location:' .$host. 'template/login.php');
	exit();
}
else  
{ 
  $message = "USER NOT FOUND";
  header('Location:' .$host. 'template/login.php?err=' .$message);
  exit();
}

