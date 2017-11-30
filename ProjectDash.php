<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	
	ggc_session();
	
	/**ProjectDash
   * This page covers everything that is specifically relevant to the
   * project picked in the Class Dash. this page contains the review
   * link and the algorithm that is to cycle through the appropriate
   * projects to review for the current user. Submissions will also be allowed
   * on this page.
   */

	$stmt=$mysqli->query("SELECT * FROM user JOIN class ON user.user_id = class.student_id WHERE user.user_id = '$_SESSION[user_id]'");
?>

<!doctype html>
<html>
<head>
	<title>Project Dash</title>
	<link href="./css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/MainStyle.css" />
</head>

<body>
<?php if (login_checker($mysqli) == true) : ?>

<?php echo "<div class=\"title\"><h1>Welcome " . $_SESSION['firstname'] . "! You are logged in!</h1></div><br/>
			<div id=\"container\">
			<h2>Project Dash</h2>";?>
	
	<?php if($_SESSION['s_code']==1){?>
	<div class="basicStyle">
	<h1>You are an admin</h1>
	</div>
	<?php }?>
	
	
	
	
	<?php if($_SESSION['s_code']==5||$_SESSION['s_code']==3){?>
	<div class="basicStyle">
	<h1>You are a student</h1>
	<a href = "ReviewPage.php?course=<?php echo $_GET['course']?>&project=<?php echo $_GET['project'] ?>">Take Review</a>
	<form action="AddSubmission.php?course=<?php echo $_GET['course'] ?>&project"<?php echo $_GET['project'] ?> method="get">
		<div class="form-group">
			<label for="name">
				<strong>
					Link
				</strong>
			</label>
			<input type="text" class="form-control" name="link">
			<input type="submit" name="submit" value="Submit Record" class="btn btn-primary">
		</div>
	</form>
	<?php }?>
	
	<?php if($_SESSION['s_code']==3){?>
	<div class="basicStyle">
		<h1>You are a professor</h1>
	</div>
		
		
	<?php }?>
	</div>
</body>	
	
	
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