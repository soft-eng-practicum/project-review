<?php
	include_once '../includes/connection_string.php';
	include_once '../includes/security.php';
	
	ggc_session();
	
	/**EditCourse
   * This page addresses the administrators 
   * ability to edit courses, and then remove,
   * and finally do an update or edit to present courses.
   */

	
	
	$stmt= $mysqli->query("SELECT * FROM course");
	
	echo "This is Edit Course File";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			Edit Course
		</title>
		<link href="../css/bootstrap.css" rel="stylesheet">
	</head>
	<body>
		<?php
		/**fetchAllCourseRows
	   * this if, while loop takes the query above for
	   * the student's classes
	   * and calls all the rows and assigns to a variable
	   * which is then echoed out into tables
	   * Void
	   */
		?>
		<div class="container">
			<div class="col-md-6">
			<table class="table table-hover">
				<tr>
					<td>
						<strong>
							Name
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
							Course ID
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
						$courseID = $rows['course_id'];
						$name = $rows['name'];
						$section = $rows['section'];
						$professorID = $rows['professor_id'];
						$semester = $rows['semester'];
						
						
						echo "
						
						<tr>
							<td>
								$name
							</td>
							<td>
								$section
							</td>
							<td>
								$semester
							</td>
							<td>
								$courseID
							</td>
							<td>
								<form action='EditCourse.php' method='post'>
									<input name='delete_id' value='$courseID' hidden='true'>
									<input name='delete_name' value='$name' hidden='true'>
									<input name='delete_section' value='$section' hidden='true'>
									<input name='delete_semester' value='$semester' hidden='true'>
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
				<form action="EditCourseinc.php" method="get">
					<div class="form-group">
						<label for="course_id">
							<strong>
								Course ID
							</strong>
						</label>
						<input type="text" class="form-control" name="delete_id">
					</div>
					<div class="form-group">
						<label for="name">
							<strong>
								Name
							</strong>
						</label>
						<input type="text" class="form-control" name="delete_name">
					</div>
					<div class="form-group">
						<label for="section">
							<strong>
								Section
							</strong>
						</label>
						<input type="text" class="form-control" name="delete_section">
					</div>
					<div class="form-group">
						<label for="semester">
							<strong>
								Semester
							</strong>
						</label>
						<input type="text" class="form-control" name="delete_semester">
					</div>
					<input type="submit" name="submit_delete" value="Delete" class="btn btn-primary">
				</form>
			</div>
		</div>
	</body>
</html>