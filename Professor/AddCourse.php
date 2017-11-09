<?php
	include_once '../includes/connection_string.php';
	include_once '../includes/security.php';
	
	ggc_session();
	
	//$carry = $_GET['course'];
	
	$stmt= $mysqli->query("SELECT * FROM course WHERE professor_id = " .$_SESSION['user_id']);
	
	echo "This is Add Course File";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			Add Course
		</title>
		<link href="../css/bootstrap.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="col-md-6">
			<table class="table table-hover">
				<tr>
					<td>
						<strong>
							Course Name
						</strong>
					</td>
					<td>
						<strong>
							Section
						</strong>
					</td>
					<td>
						<strong>
							Semester
						</strong>
					</td>
					<td>
						 <strong>
							Delete?
						</strong>
					</td>
				</tr>
<?php
				if($stmt->num_rows != 0)
				{
					while($rows = $stmt->fetch_assoc())
					{
						$course_id = $rows['course_id'];
						$course_name = $rows['name'];
						$section = $rows['section'];
						$semester = $rows['semester'];
						
						echo "
						
						<tr>
							<td>
								$course_name
							</td>
							<td>
								$section
							</td>
							<td>
								$semester
							</td>
							<td>
								<form action='AddCourseinc.php?' method='post'>
									<input name='delete_id' value='$course_id' 	hidden='true'>
									<input type='submit' name='submit_delete' value='X' class='btn btn-danger pull-right'>
								</form>
							</td>
						</tr>";
					}
				}
?>
			</table>
			</div>
			<div class="col-md-6">
				<form action="AddCourseinc.php" method="get">
					<div class="form-group">
						<label for="name">
							<strong>
								Course Name:
							</strong>
						</label>
						<input type="text" class="form-control" name="name">
					</div>
					<div class="form-group">
						<label for="section">
							<strong>
								Section:
							</strong>
						</label>
						<input type="text" class="form-control" name="section">
					</div>
					<div class="form-group">
						<label for="semester">
							<strong>
								Semester:
							</strong>
						</label>
						<input type="text" class="form-control" name="semester">
					</div>
						<!--<input type="text" class="form-control" name="course_id" value="<?php //echo $carry;?>" hidden="true"> -->
						<input type="submit" name="submit" value="Submit Record" class="btn btn-primary">
				</form>
			</div>
		</div>
	</body>
</html>