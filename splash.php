<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	
	ggc_session();
	
	$mysqli= new mysqli("localhost", "ggc_user", "ggc","ggc_project_review");
	if($mysqli->connect_error)
	{
		echo "oh shit";
	}
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
	$stmt=$mysqli->query("SELECT * FROM user JOIN class WHERE user.user_id = class.student_id");
	//$stmt=$mysqli->query("SELECT * FROM course_section");

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
	</style>
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
	
	<?php if($_SESSION['s_code']==1){?>
	<h1>You are an admin</h1>
	<?php }?>
	
	<?php if($_SESSION['s_code']==3){?>
	<h1>You are an professor</h1>
	<?php }?>
	

	
	<div class="col-md-6">
			<table class="one">
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
				</tr>
<?php
				if($stmt->num_rows != 0)
				{
					while($rows = $stmt->fetch_assoc())
					{
						$user_id = $rows['user_id'];
						$firstname = $rows['firstname'];
						$lastname = $rows['lastname'];
						$course_ID = $rows['course_id'];
						
						echo "
						
						<tr>
							<td>
								$user_id
							</td>
							<td>
								$firstname
							</td>
							<td>
								$lastname
							</td>
							<td>
								<a href = ./course.php?course='$course_ID'>$course_ID</a>
							</td>
						</tr>";
					}
				}
?>
			</table>
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