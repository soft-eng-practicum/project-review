<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	
	ggc_session();
	
	/**ClassDash
   * This page looks at the user's s_code for the content and
   * features that will be available. Otherwise, it will show all the projects
   * relevant to that class.
   */
	
	//Important SQL statement
	$stmt=$mysqli->query("SELECT * FROM course JOIN user WHERE course_id =" .$_GET['course'] . "AND course.professor_id = user.user_id");
	
	$projstmt=$mysqli->query("SELECT * FROM project WHERE project.course_id =" .$_GET['course']);
?>

<!doctype html>
<html>
<head>
	<title>Class Dash</title>
	<link href="./css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/MainStyle.css" />
</head>

<body>
<?php if (login_checker($mysqli) == true) : ?>
<?php echo "<div class=\"title\"><h1>Welcome " . $_SESSION['firstname'] . "! You are logged in!</h1></div><br/>
			<div id=\"container\">
			<h2>Class Dash</h2>";?>
	
	
	<?php if($_SESSION['s_code']==1){?>
	<div class="basicStyle">
	<h1>You are an admin</h1>
	</div>
	<?php }?>
	
	
	
	
	<?php if($_SESSION['s_code']==5||$_SESSION['s_code']==3){?>
	<div class="basicStyle">
	<h1>You are a student</h1>
	
	<div class="tableStyle">
	<?php
		/**fetchProjectRows
	   * this if, while loop takes the query above for
	   * the student's classes
	   * and calls all the rows and assigns to a variable
	   * which is then echoed out into tables
	   * Void
	   */
		if($projstmt->num_rows != 0)
		{
			
			
			while($rows = $projstmt->fetch_assoc())
			{
				$id = preg_replace("/[^0-9]+/", "", $rows['course_id']);
				$projid = preg_replace("/[^0-9]+/", "", $rows['project_id']);
				$name = $rows['name'];
				
				echo "
					<div class = 'tableContainer'>
						<a href = ./ProjectDash.php?course='$id'&project='$projid'>
						<!--
							<div class = 'tableContent'>
								<h4>$id</h4>
							</div>
						-->	
							<div class = 'tableContent'>
								<h3>$name</h3>
							</div>
						</a>
					</div>
					";
			}
		}
	?>
	</div>
	</div>
	<?php }?>
	
	
	
	<?php if($_SESSION['s_code']==3){?>
	<div class="basicStyle">
		<h1>You are a professor</h1>
		
		<div class = "tableContainer">
			<div class = "tableContent">
				<a href = "./Professor/AddProj.php?course=<?php echo $_GET['course'];?>"><h3>Add Project</h3></a>
			</div>
		</div>	
			
		<div class = "tableContainer">	
			<div class = "tableContent">
				<h3><a href="./professor/student_reg.php">Add Student</a></h3>
			</div>
		</div>
		
	</div>	
	
	<div class="basicStyle">
	<h1>Project Submissions and Reviews</h1>
	
	<div class="tableStyle">
	<?php
		/**fetchGradeProjectRows
	   * this if, while loop takes the query above for
	   * the student's classes
	   * and calls all the rows and assigns to a variable
	   * which is then echoed out into tables
	   * Void
	   */
	    $stmt=$mysqli->query("SELECT * FROM course JOIN user WHERE course_id =" .$_GET['course'] . "AND course.professor_id = user.user_id");
	
		$projstmt=$mysqli->query("SELECT * FROM project WHERE project.course_id =" .$_GET['course']);
	   
		if($projstmt->num_rows != 0)
		{
			while($rows = $projstmt->fetch_assoc())
			{
				$id = preg_replace("/[^0-9]+/", "", $rows['course_id']);
				$projid = preg_replace("/[^0-9]+/", "", $rows['project_id']);
				$name = $rows['name'];
				
				echo "
					<div class = 'tableContainer'>
						<a href = ./GradeDash.php?course='$id'&project='$projid'>
						<!--
							<div class = 'tableContent'>
								<h4>$id</h4>
							</div>
						-->	
							<div class = 'tableContent'>
								<h3>$name</h3>
							</div>
						</a>
					</div>
					";
			}
		}
	?>
	</div>
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