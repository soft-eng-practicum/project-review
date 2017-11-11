<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	
	ggc_session();
	
	$mysqli= new mysqli("localhost", "ggc_user", "ggc","ggc_project_review");
	
	if($mysqli->connect_error)
	{
		echo "oh shit";
	}
	/*
	if(isset($_GET['firstname']))
	{
		$firstname1=$_GET['firstname'];
		$lastname1=$_GET['lastname'];
		$email1=$_GET['email'];
		
		$insert_stmt = $mysqli->prepare("INSERT INTO test (firstname, lastname, email) VALUES (?,?,?)");
		$insert_stmt->bind_param('sss', $firstname1, $lastname1, $email1);
		$insert_stmt->execute();
	}
	if (isset($_POST['delete_id']))
	{
		$id2=$_POST['delete_id'];
		$delete_stmt = $mysqli->query("DELETE FROM test WHERE id = '$id2'");
	}
	*/

	//$_SESSION['user_id'];

	$stmt=$mysqli->query("SELECT * FROM user JOIN class JOIN course ON user.user_id = class.student_id AND class.course_id = course.course_id WHERE user.user_id = '$_SESSION[user_id]'");
	//$stm1t=$mysqli->query("SELECT * FROM class JOIN course WHERE class.student_id = ");
	//$stmt=$mysqli->query("SELECT * FROM course_section");

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
	<!--
	.tableStyle
	{
		width: 700px;
	/*margin-top: 20px;
	margin-bottom: 20px;
	margin-left: auto;
	margin-right: auto;*/
	background-color: #00FF00;
	/*padding-top: 8px;
	padding-bottom: 2px;*/
	-webkit-border-radius: 15px;
    -moz-border-radius: 15px;
    border-radius: 15px;
	}-->
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
		<?php echo "<div class=\"title\"><h1>Welcome " . $_SESSION['firstname'] . "! You are logged in!</h1><br/></div>
				<div id=\"container\">
				<h2>User Dash</h2>";?>
		
		<?php if($_SESSION['s_code']==1){?>
			<div class="basicStyle">
				<h1>You are an admin</h1>
				
				<div class="tableStyle">
					<a href = "./Admin/EditProf.php"><h2>Add/Remove Professor</h2></a>
					<a href = "./Admin/EditCourse.php"><h2>Add/Remove Course</h2></a>
				</div>
			</div>
		<?php }?>
		
	
		<?php if($_SESSION['s_code']==3){?>
		<div class="basicStyle">
			<h1>You are a professor</h1>
			<a href = "./Professor/AddCourse.php"><h2>Add Course</h2></a>
			<h1>Courses</h1>
		<!--
		</div>
		
		<!--<div class="col-md-6 basicStyle">
		<div class="basicStyle">		-->
		
			<div class="tableStyle">
				<?php
					if($stmt->num_rows != 0)
					{

						while($rows = $stmt->fetch_assoc())
						{
							$user_id = $rows['user_id'];
							$firstname = $rows['firstname'];
							$lastname = $rows['lastname'];
							$course_ID = $rows['course_id'];
							$course_name = $rows['name'];
							$semester = $rows['semester'];
							$section = $rows['section'];
							$course_id1=preg_replace("/[^0-9]+/", "", $rows['course_id']);

							
							echo "
							<div class = 'tableContainer'>
							<a href = ./ClassDash.php?course='$course_ID'>
							<!--
								<div class = 'tableContent tc4'>
									<a href = ./ClassDash.php?course='$course_ID'>$course_ID</a>
								</div>
							-->	
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
					
					/*
					echo "
					
					<table>
						<tr>
						
							<td>						
								<a href = ./ClassDash.php?course='$course_ID'>$course_ID</a>
							</td>
							<td>
								<a href = ./ClassDash.php?course='$course_ID'>$course_name</a>
							</td>
							<td>
								<a href = ./ClassDash.php?course='$course_ID'>$semester</a>
							</td>
							<td>
								<a href = ./ClassDash.php?course='$course_ID'>$section</a>
							</td>
						</tr>
					</table>
						";
						*/
						}
					}
				?>
			</div>
		</div>
	
		<?php }?>
	
		<?php if ($_SESSION['s_code']==5){?>
	
			<div class="basicStyle">
				<h1>You are a student</h1>
					<div class = "tableStyle">
						<!--
						<div class = "tableContainer">
							<div class = "tableContent tc5">
								<h4>ID</h4>
							</div>
							
							<div class = "tableContent tc5">
								<h4>First Name</h4>
							</div>
							
							<div class = "tableContent tc5">
								<h4>Last Name</h4>
							</div>
							
							<div class = "tableContent tc5">
								<h4>Course ID</h4>
							</div>
							
							<div class = "tableContent tc5">
								<h4>Course Name</h4>
							</div>
						</div>
						-->
						<?php
								if($stmt->num_rows != 0)
								{
									$num = $stmt->num_rows;
									
									while($rows = $stmt->fetch_assoc())
									{
										$user_id = $rows['user_id'];
										$firstname = $rows['firstname'];
										$lastname = $rows['lastname'];
										$course_ID = $rows['course_id'];
										$course_name = $rows['name'];
										
										
										echo "
										<div class = 'tableContainer'>
										<!--
											<div class = 'tableContent tc5'>
												<a href = ./ClassDash.php?course='$user_id'><h4>$user_id</h4></a>
											</div>
											
											<div class = 'tableContent tc5'>
												<a href = ./ClassDash.php?course='$firstname'><h4>$firstname</h4></a>
											</div>
											
											<div class = 'tableContent tc5'>
												<a href = ./ClassDash.php?course='$lastname'><h4>$lastname</h4></a>
											</div>
											
											<div class = 'tableContent tc5'>
												<a href = ./ClassDash.php?course='$course_ID'><h4>$course_ID</h4></a>
											</div>
										-->	
											<div class = 'tableContent tc1'>
												<a href = ./ClassDash.php?course='$course_ID'><h3>$course_name</h3></a>
											</div>
										</div>
										";
										
										/*
										echo "
										
										<tr>
											<td>
												<a href = ./course.php?course='$course_ID'>$course_ID</a>
											</td>
											<td>
												$course_name
											</td>
										</tr>";
										*/
									}
								}
							?>
					</div>
						<!-- <table class="one">
							<tr>
								<td>
									<strong>
										ID
									</strong>
								</td>
								<td>
									<strong>
										Firstname
									</strong>
								</td>
								<td>
									<strong>
										Lastname
									</strong>
								</td>
								<td>
									<strong>
										CourseID
									</strong>
								</td>
								<td>
									<strong>
										CourseName
									</strong>
								</td>
							</tr>
							<?php
								/*if($stmt->num_rows != 0)
								{
									while($rows = $stmt->fetch_assoc())
									{
										$user_id = $rows['user_id'];
										$firstname = $rows['firstname'];
										$lastname = $rows['lastname'];
										$course_ID = $rows['course_id'];
										$course_name = $rows['name'];
										
										echo "
										
										<tr>
											<td>
												<a href = ./course.php?course='$course_ID'>$course_ID</a>
											</td>
											<td>
												$course_name
											</td>
										</tr>";
									}
								}*/
							?>
						</table> -->
					</div>
				</div>
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
</div>	 
</body>
</html>