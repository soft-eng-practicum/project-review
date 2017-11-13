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

<?php if (login_checker($mysqli) == true) : ?>
<?php echo "<h1>Welcome " . $_SESSION['firstname'] . "! You are logged in!</h1><br/>
			<h2>Project Dash</h2>";?>
	
	<?php if($_SESSION['s_code']==1){?>
	<h1>You are an admin</h1>
	<?php }?>
	
	
	
	
	<?php if($_SESSION['s_code']==5||$_SESSION['s_code']==3){?>
	<h1>You are an student</h1>
	
	<?php }?>
	
	<?php if($_SESSION['s_code']==3){?>
		<h1>You are an professor</h1>
		<h2>Add Project</h2>
		<h2>Add Student</h2>
		
	<?php }?>
	
	
	
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