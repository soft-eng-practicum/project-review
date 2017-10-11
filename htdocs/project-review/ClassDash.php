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

<?php if (login_checker($mysqli) == true) : ?>
<?php echo "<h1>Welcome " . $_SESSION['firstname'] . "! You are logged in!</h1><br/>
			<h2>Class Dash</h2>";?>
	
	<?php if($_SESSION['s_code']==1){?>
	<h1>You are an admin</h1>
	<?php }?>
	
	
	
	
	<?php if($_SESSION['s_code']==5||$_SESSION['s_code']==3){?>
	<h1>You are an student</h1>
	
	
	<?php
		if($projstmt->num_rows != 0)
		{
			while($rows = $projstmt->fetch_assoc())
			{
				$id = $rows['course_id'];
				$name = $rows['name'];
				
				
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
				/*
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