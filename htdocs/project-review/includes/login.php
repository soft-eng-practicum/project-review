<?php
	include_once 'connection_string.php';
	include_once 'security.php';

	ggc_session(); 
	
if (isset($_POST['email']) && isset($_POST['pass'])) 
{
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['pass'];
    
    if (login($email, $password, $mysqli) == true) 
	{
        	if($_SESSION['s_code']  == 0) 
			{
				header("Location: ../landing_test.php");
			}
    } 
	else 
	{
        header('Location: ../index.php?error=1');
        exit();
    }
}
 else 
 {
	header('Location: ../error.php?message=YOU SENT AN EMPTY LOGIN');
	exit();
}