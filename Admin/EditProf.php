<?php
	include_once '../includes/connection_string.php';
	include_once '../includes/security.php';
	
	ggc_session();
	
	/**EditProf
   * This page shows tables to the administrator, and takes entries that'll
   * be passed into EditProfinc for processing into the MySQL database. 
   * Admins will be able to add, remove, and edit(UPDATE) professors.
   */

	$stmt= $mysqli->query("SELECT * FROM user WHERE s_code = 3");
	
	echo "This is Edit Professor File";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			This is a simple test
		</title>
		<link href="../css/bootstrap.css" rel="stylesheet">
	</head>
	<body>
		<?php
		
		?>
		<div class="container">
			<div class="col-md-6">
			<table class="table table-hover">
				<tr>
					<td>
						<strong>
							First Name
						</strong>
					</td>
					<td>
						<strong>
							Last Name
						</strong>
					</td>
					<td>
						<strong>
							User ID
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
						//$proj_id = $rows['project_id'];
						//$projName = $rows['name'];
						//$due_date = $rows['due_date'];
						$profFirstName = $rows['firstname'];
						$profLastName = $rows['lastname'];
						$userID = $rows['user_id'];
						
						echo "
						
						<tr>
							<td>
								$profFirstName
							</td>
							<td>
								$profLastName
							</td>
							<td>
								$userID
							</td>
							<td>
								<form action='EditProf.php' method='post'>
									<input name='delete_id' value='$userID' hidden='true'>
									<input name='delete_firstname' value='$profFirstName' hidden='true'>
									<input name='delete_lastname' value='$profLastName' hidden='true'>
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
				<form action="EditProfinc.php" method="get">
					<div class="form-group">
						<label for="user_id">
							<strong>
								User ID
							</strong>
						</label>
						<input type="text" class="form-control" name="delete_id">
					</div>
					<div class="form-group">
						<label for="firstname">
							<strong>
								First Name
							</strong>
						</label>
						<input type="text" class="form-control" name="delete_firstname">
					</div>
					<div class="form-group">
						<label for="lastname">
							<strong>
								Last Name
							</strong>
						</label>
						<input type="text" class="form-control" name="delete_lastname">
					</div>
					<!--<input name='delete_id' value='user_id' hidden='false'>
					<input name='delete_firstname' value='firstname' hidden='false'>
					<input name='delete_lastname' value='lastname' hidden='false-->
						<!--<input type="text" class="form-control" name="course_id" value="<?php// echo $carry;?>" hidden="true">-->
					<input type="submit" name="submit_delete" value="Delete" class="btn btn-primary">
				</form>
			</div>
		</div>
	</body>
</html>