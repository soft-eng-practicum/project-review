<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	
	ggc_session();
	
	//$stmt=$mysqli->query("SELECT * FROM course WHERE course_id =" .$_GET['course']);
	
	//Important SQL statement
	$stmt=$mysqli->query("SELECT * FROM course JOIN user WHERE course_id =" .$_GET['course'] . "AND course.professor_id = user.user_id");
	
	
	//$stmt=$mysqli->query("SELECT * FROM user JOIN class WHERE user.user_id = class.student_id");
	//$projstmt=$mysqli->query("SELECT * FROM course JOIN project WHERE course_id=" .$_GET['course'] . "AND course.course_id = project.course_id");
	$projstmt=$mysqli->query("SELECT * FROM project WHERE project.course_id =" .$_GET['course']);
?>

<!doctype html>
<html>
<head>
	<title>Pew</title>
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
		if($projstmt->num_rows != 0)
		{
			while($rows = $projstmt->fetch_assoc())
			{
				$id = $rows['course_id'];
				$name = $rows['name'];
				
				echo "
					<div class = 'tableContainer'>
						<a href = ./ProjectDash.php?project='$id'>
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
				
				/*
				echo "
				
				<table>
					<tr>
						<td>
							$id
						</td>
						<td>
							<a href = ./ProjectDash.php?project='$id'>$name</a>
						</td>
					</tr>
				</table>
				";
				
				echo "
				
				<tr>
					<td>
						$id
					</td>
					<td>
						$name
					</td>
					<td>
						$prof
					</td>
					<td>
						$sec
					</td>
					<td>
						$semester
					</td>
					<td>
						$profName
					</td>
				</tr>";
				*/
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
				<h3>Add Student</h3>
			</div>
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