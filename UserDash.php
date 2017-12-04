<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	
	ggc_session();
	
	/**UserDash
   * shows the users all the relevant features according to their
   * s_code on this page, and then through a SQL query calls all the
   * academic classes associated with that user's ID
   */
	
	$stud_stmt=$mysqli->query("SELECT * FROM user JOIN class JOIN course ON user.user_id = class.student_id AND class.course_id = course.course_id WHERE user.user_id = '$_SESSION[user_id]'");
	
	$prof_stmt=$mysqli->query("SELECT * FROM user JOIN  course ON user.user_id = course.professor_id WHERE user.user_id = '$_SESSION[user_id]'");

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
	.zero
	{
		width: 100px;
		height: 100px;
		background-color: yellow;
		transition: 2s;
	}
	.zero:hover
	{
		transform:rotateZ(360deg);
	}
	.tableStyle
	{
		width: 700px;
	background-color: #00FF00;
	-webkit-border-radius: 15px;
    -moz-border-radius: 15px;
    border-radius: 15px;
	}
	</style>
	<title>
    	Georgia Gwinnett College Project Review: Test
    </title>
<!-- StyleSheets -->
	<link href="./css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/MainStyle.css" />
<!-- Bootstrap JQ & plugins--> 
	<script src="./js/jquery-1.11.3.min.js"></script> 
	<script src="./js/bootstrap.js"></script>
</head>

<body>
	<?php if (login_checker($mysqli) == true) : ?>
		<?php echo 
			"<div class='title'>
				<h1>Welcome " . $_SESSION['firstname'] . "! You are logged in!</h1><br/>
			</div>";?>
			<div id='container'>

				<h1>User Dash</h1>
					<?php if($_SESSION['s_code']==1){?>
						<div class="basicStyle">
							<h2>Admin</h2>

							<div class="tableStyle">
								<a href = "./Admin/EditProf.php"><h2>Add/Remove Professor</h2></a>
								<a href = "./Professor/AddCourse.php"><h2>Add/Remove Course</h2></a>
							</div>
						</div>
					<?php } 
//professor
					?>
					<div class="basicStyle">
						<h2>Professor</h2>
							<?php if($_SESSION['s_code']==3)
							{?>	
							<a href = "./Professor/AddCourse.php"><h2>Add Course</h2></a>
							<?php }?>
						<h3>Courses You Teach</h3>
							<div class="tableStyle">
							<?php

								if($prof_stmt->num_rows != 0)
								{

									while($rows = $prof_stmt->fetch_assoc())
									{
										$user_id = $rows['user_id'];
										$firstname = $rows['firstname'];
										$lastname = $rows['lastname'];
										$course_ID = $rows['course_ID'];
										$course_name = $rows['name'];
										$semester = $rows['semester'];
										$section = $rows['section'];
										$course_id1=preg_replace("/[^0-9]+/", "", $rows['course_ID']);


										echo "
										<div class = 'tableContainer'>
										<a href = ./ClassDash.php?course=$course_ID>
											<div class = 'tableContent tc3'>
												<h4>$course_name</h4>
											</div>

											<div class = 'tableContent tc3'>
												<h4>$semester</h4>
											</div>

											<div class = 'tableContent tc3'>
												<h4>$section</h4>
											</div>
										</a>
										</div>
										";
									}
								}
							?>
						</div>

<?php 
//student
?>
						<h3>
							Courses You Are In:
						</h3>
						<div class = "tableStyle">
						
						<?php
								if($stud_stmt->num_rows != 0)
								{
									$num = $stud_stmt->num_rows;
									
									while($rows = $stud_stmt->fetch_assoc())
									{
										$course_ID = $rows['course_id'];
										$course_name = $rows['name'];
										
										
										echo "
										<div class = 'tableContainer'>
											<div class = 'tableContent tc1'>
												<a href = ./ClassDash.php?course=$course_ID><h3>$course_name</h3></a>
											</div>
										</div>
										";
									}
								}
							?>
					</div>
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
</div>	 
</body>
</html>