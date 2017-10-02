<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	
	ggc_session();

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
    	Georgia Gwinnett College Project Review: Test
    </title>
<!-- StyleSheets -->
	<link href="./css/bootstrap.css" rel="stylesheet">
<!-- Bootstrap JQ & plugins--> 
	<script src="./js/jquery-1.11.3.min.js"></script> 
	<script src="./js/bootstrap.js"></script>
</head>

<body>
<?php if (login_checker($mysqli) == true) : ?>
	<?php echo "<h1>Welcome " . $_SESSION['firstname'] . "! You are logged in!</h1>";?>
<?php else : ?>
	<?php echo "<h1>You can not see this page!</h1>";
	echo 
					$_SESSION['user_id']."<br>".
					$_SESSION['firstname']."<br>".
					$_SESSION['lastname']."<br>".
                    $_SESSION['login_string']."<br>".
					$_SESSION['email']."<br>".
					$_SESSION['phone']."<br>".
					$_SESSION['carrier']."<br>".
					$_SESSION['s_code'];?>
<?php endif; ?>		 
</body>
</html>