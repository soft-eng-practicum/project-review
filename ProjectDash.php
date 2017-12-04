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

	$stmt=$mysqli->query("SELECT * FROM user JOIN class ON user.user_id = class.student_id WHERE user.user_id =".$_SESSION['user_id']);
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
		<h2>
			Your Submission
		</h2>
		<?php
	
			$sub = $mysqli->query("SELECT * FROM submission WHERE student_id = '".$_SESSION['user_id']."' AND project_id = '".$_GET['project']."'");
			if($sub->num_rows != 0)
			{
				$num = $sub->num_rows;
				$rows = $sub->fetch_assoc();
				
				$link = $rows['link'];
				$time = $rows['time'];

				echo "
				<div class = 'tableContainer'>
					<div class = 'tableContent tc1'>
						<h5><a href='$link'>Your Project Link</a> ---- Time Submited: $time</h5>
					</div>
				</div>
				<hr width ='50%'>
				";
			}
		?>
		
	<form action="AddSubmission.php" method="post">
		<div class="form-group">
			<label for="name">
				<strong>
					To submit your link or to update Your Project Link
				</strong>
			</label><br>
			<input type="text" name="link"><br><br>
			<input type="text" name="course" hidden="true" value="<?php echo $_GET['course']?>">
			<input type="text" name="project" hidden="true" value="<?php echo $_GET['project'] ?>">
			<input type="submit" name="submit" value="Submit or Update Your Record" class="btn btn-default">
		</div>
	</form>
	<hr width="50%">
		<h2>
			Your Reviews For This Project
		</h2>
		<?php
	
			$rev = $mysqli->query("SELECT * FROM submission JOIN review ON review.submission_id = submission.submission_id WHERE review.student_id = ".$_SESSION['user_id'] . " AND submission.project_id= ".$_GET['project']);
			
			if($rev->num_rows != 0)
			{
				$i=1;
				while($row = $rev->fetch_assoc())
				{
					//var_dump($row) ;
					$link = $row['link'];
					$time = $row['time'];

					echo "
					<div class = 'tableContainer'>
						<div class = 'tableContent tc1'>
							<h5>$i )  <a href='$link'>Your Review</a> ---- Time Submited: $time</h5>
						</div>
					</div>
					<hr width ='50%'>
					";
					$i++;
				}				
			}
		?>
		<a href = "ReviewPage.php?course=<?php echo $_GET['course']?>&project=<?php echo $_GET['project'] ?>"><h3>Take Review</h3></a>
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