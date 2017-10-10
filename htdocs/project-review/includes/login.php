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
        	if($_SESSION['s_code']  == 0||$_SESSION['s_code']  == 2||$_SESSION['s_code']  == 4) 
			{
				header("Location: ../splash.php");
			}
			elseif($_SESSION['s_code']  == 1||$_SESSION['s_code']  == 3||$_SESSION['s_code']  == 5) 
			{
				header("Location: ../splash.php");
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