<?php
	include_once '../includes/connection_string.php';
	include_once '../includes/security.php';
	
	ggc_session();
	
	//$carry = $_GET['course'];
	
	if ($_SESSION['s_code'] == 1)
	{
		$stmt= $mysqli->query("SELECT * FROM course");
	}
	else
	{
		$stmt= $mysqli->query("SELECT * FROM course WHERE professor_id = " .$_SESSION['user_id']);
	}
	
	/*echo "This is Add Course File";*/
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			Add Course
		</title>
		
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/MainStyle.css" />
	</head>
	
	<body>
		<div id="container">
		
			<h1>Add New Course</h1>
			
			<div class="basicStyle">
				<form action="AddCourseinc.php" method="get">
					<div class="form-group" style="width:90%; margin-left:auto; margin-right:auto;">
						<label for="name">
							<strong>
								Course Name:
							</strong>
						</label>
						<input type="text" class="form-control" name="name">
					</div>
					<div class="form-group" style="width:90%; margin-left:auto; margin-right:auto;">
						<label for="section">
							<strong>
								Section:
							</strong>
						</label>
						<input type="text" class="form-control" name="section">
					</div>
					<div class="form-group" style="width:90%; margin-left:auto; margin-right:auto;">
						<label for="semester">
							<strong>
								Semester:
							</strong>
						</label>
						<input type="text" class="form-control" name="semester">
					</div>
					<?php
					if ($_SESSION['s_code'] == 1)
						{
							echo '<div class="form-group" style="width:90%; margin-left:auto; margin-right:auto;">
						<label for="professor_email">
							<strong>
								Professor Email:
							</strong>
						</label>
						<input type="text" class="form-control" name="professor_email">
					</div>';
						}
					?>
						<!--<input type="text" class="form-control" name="course_id" value="<?php //echo $carry;?>" hidden="true"> -->
					<!--<input type="submit" name="submit" value="Submit Record" class="btn btn-primary">-->
					
					<button type='submit' class='buttonStyle' style="font-size:22px; width:100px;" name='submit' value='Submit Record'>Submit</button>
				</form>
			</div>
			
			<h1>Existing Courses</h1>
			<div class="basicStyle">
				<div class="tableStyle">
					<div class="tableContainer">
						<div class="tableContent tc4">
							<h4 style="font-size:18px;">Course Name</h4>
						</div>
						
						<div class="tableContent tc4">
							<h4 style="font-size:18px;">Section</h4>
						</div>
						
						<div class="tableContent tc4">
							<h4 style="font-size:18px;">Semester</h4>
						</div>
						
						<div class="tableContent tc4">
							<h4 style="font-size:18px;">Delete?</h4>
						</div>
					</div>
<?php
				if($stmt->num_rows != 0)
				{
					while($rows = $stmt->fetch_assoc())
					{
						$course_id = $rows['course_id'];
						$course_name = $rows['name'];
						$section = $rows['section'];
						$semester = $rows['semester'];
						
						$confirm_text = "Are you sure you want to delete $course_name, section $section, $semester?";
						
						echo "
						<div class='tableContainer'>
							<div class='tableContent tc4'>
								$course_name
							</div>
							
							<div class='tableContent tc4'>
								$section
							</div>
							
							<div class='tableContent tc4'>
								$semester
							</div>
							
							<div class='tableContent tc4'>
								<form action='AddCourseinc.php?' method='post' id='delete_btn'>
								<!--
									<input name='delete_id' value='$course_id' 	hidden='true'>
									<input type='submit' name='submit_delete' value='X' class='btn btn-danger' onclick='return confirm(\"$confirm_text\")';>
								-->
								
								<input name='delete_id' value='$course_id' 	hidden='true'>
								<!--
								<button type='submit' class='buttonStyleDel' name='submit_delete' value='X' onclick='loginhash(this.form, this.form.password);'>X</button>
								-->
								<button type='submit' class='buttonStyleDel' name='submit_delete' value='X' onclick='return confirm(\"$confirm_text\")';>X</button>
								</form>
							</div>
						</div>
						";
					}
				}
				
?>
				</div>
			</div>
			
			
			
		</div>
	</body>
</html>