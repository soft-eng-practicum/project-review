<?php
	include_once 'security.php';
	session_start();
   	unset($_SESSION["username"]);
   	unset($_SESSION["password"]);
   
   	header("Location: ../index.php");
	exit();
?>