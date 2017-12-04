<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	
	ggc_session();
	
	/**ReviewPage
   * This page's purpose is to allow the student to provide feedback
   * on their peer's submission, taking all their entries from this page
   * and then sending it over to ReviewPageinc for processing.
   */

	
	//reset the time zone
	//date_default_timezone_set('America/New_York');
	//$date = date('m/d/Y h:i:s a', time());
	$date = date('m/d/Y', time());
	$classStmt=$mysqli->query("SELECT * FROM course JOIN user WHERE course_id =" .$_GET['course']);
	
	$course_id = preg_replace("/[^0-9]+/", "", $_GET['course']);
	
	$project= $_GET['project'];
	
	//check if you have any checked out reviews
	$checkedout= $mysqli->query("SELECT * FROM review LEFT JOIN submission ON review.submission_id = submission.submission_id WHERE review.student_id = '".$_SESSION['user_id']."' AND review.first = 10 ");
	if($checkedout->num_rows == 1)
	{
		$rows = $checkedout->fetch_assoc();
		$submission_id = $rows['submission_id'];
		$review_link = $rows['link'];
	}
	if($checkedout->num_rows == 0)
	{
		//select submissions from review avoiding the one you reviewed and the one you submited and ordered by the list
		//echo $_SESSION['user_id'];
		$sel_subs = $mysqli->query("SELECT submission.* ,COUNT(review.review_id) FROM submission LEFT JOIN review ON submission.submission_id = review.submission_id WHERE submission.project_id= $project AND submission.student_id <> ".$_SESSION['user_id']);
		
		//while($rows = $sel_subs->fetch_assoc())
		//{ echo(var_dump($rows));}
		$rows = $sel_subs->fetch_assoc();
		$submission_id = $rows['submission_id'];
		$review_link = $rows['link'];
		
		//find the people that have graded you
		
		$holder=10;
		$holder2="The Review is still in progress.";
		
		//$insert=$mysqli->prepare("INSERT INTO review (submission_id, student_id, time, first, second, comment) VALUES (?, ?, ?, ?, ?, ?)");
		//$insert->bind_param('iisiis', $submission_id, $_SESSION['user_id'], $date, $holder, $holder, $holder2 );
		//$insert->execute();
	}
?>
<html>
	<head>
		<title>Review Page</title>
		<link rel="stylesheet" type="text/css" href="css/MainStyle.css" />
		
		
	</head>
	
	<body>
	<?php if (login_checker($mysqli) == true) : ?>
		<?php
			//echo time();
			echo $date;
			//for some reason we're set to Europe/Berlin timezone wise
			//echo date_default_timezone_get();
		?>
		<div id="container">
			<div id="header">
				<?php
				$rows = $classStmt->fetch_assoc();

				$name = $rows['name'];
				$semester = $rows['semester'];
				$section = $rows['section'];

				echo "<h1>$name</h1>";
				echo "<h2>$semester</h2>";
				echo "<h3>$section</h3>";
				?>
			</div>
		
			<div id="reviewcontents">
				<div class="projectLink basicStyle">
					<a href="<?php echo($review_link); ?>" target="_blank">Link to project</a>
					
				</div>
				
				<form action = "ReviewPageinc.php" method = "post">
					<div class="rating basicStyle">
						<h3>Did the project meet the minimum requirements?</h3>
						
						<div class="circleBox">
							<!--<div class="circle"></div>
							<div class="circle"></div>
							<div class="circle"></div>
							<div class="circle"></div>
							<div class="circle"></div>-->
							<input class = "radioAdj" type = "radio" name = "Q1" value = 1>
							<input class = "radioAdj" type = "radio" name = "Q1" value = 2>
							<input class = "radioAdj" type = "radio" name = "Q1" value = 3>
							<input class = "radioAdj" type = "radio" name = "Q1" value = 4>
							<input class = "radioAdj" type = "radio" name = "Q1" value = 5>
						</div>
						
						<div class="circleBoxLabel">
							<div class="stronglyDisagree">
								<h4>Strongly Disagree</h4>
							</div>
							
							<div class="stronglyAgree">
								<h4>Strongly Agree</h4>
							</div>
						</div>
					</div>
					
					<div class="rating basicStyle">
						<h3>Did you like the project?</h3>
						
						<div class="circleBox">
							<!--<div class="circle"></div>
							<div class="circle"></div>
							<div class="circle"></div>
							<div class="circle"></div>
							<div class="circle"></div>-->
							<input class = "radioAdj" type = "radio" name = "Q2" value = 1>
							<input class = "radioAdj" type = "radio" name = "Q2" value = 2>
							<input class = "radioAdj" type = "radio" name = "Q2" value = 3>
							<input class = "radioAdj" type = "radio" name = "Q2" value = 4>
							<input class = "radioAdj" type = "radio" name = "Q2" value = 5>
						</div>
						
						<div class="circleBoxLabel">
							<div class="stronglyDisagree">
								<h4>Strongly Disagree</h4>
							</div>
							
							<div class="stronglyAgree">
								<h4>Strongly Agree</h4>
							</div>
						</div>
					</div>
					
					<div class="response basicStyle">
						<h3>Do you have any other thoughts on the project?</h3>
						
						<div><textarea cols = "60" rows = "8" name = "comment"></textarea></div>
					</div>
					
					<div>
						<button type = "submit">Submit Review</button>
						<?php
						echo 
							"<input name='course' value='$course_id' hidden='true'>
							<input name='sub' value='$submission_id' hidden='true'>
							<input name='project' value='".$_GET['project']."' hidden='true'>" ;
						?>
					</div>
					
				</form>
			</div>
		</div>
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