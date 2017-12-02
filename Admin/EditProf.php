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
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			Add Professor
		</title>
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/MainStyle.css" />
	</head>
	<body>
		<?php
		
		?>
		
		<div id="container">

			<h1>Add New Professor</h1>
		
			<div class="basicStyle">
				<form action="EditProfinc.php" method="get">
					<div class="form-group" style="width:90%; margin-left:auto; margin-right:auto;">
						<label for="firstname">
							<strong>
								First Name
							</strong>
						</label>
						<input type="text" class="form-control" name="firstname">
					</div>
					<div class="form-group" style="width:90%; margin-left:auto; margin-right:auto;">
						<label for="lastname">
							<strong>
								Last Name
							</strong>
						</label>
						<input type="text" class="form-control" name="lastname">
					</div>
					<div class="form-group" style="width:90%; margin-left:auto; margin-right:auto;">
						<label for="prof_email">
							<strong>
								Professor Email
							</strong>
						</label>
						<input type="text" class="form-control" name="prof_email">
					</div>
					
					<button type='submit' class='buttonStyle' style="font-size:22px; width:100px;" name='submit' value='Submit Record'>Submit</button>
				</form>
			</div>
					
		<h1>Existing Professors</h1>	
		<div class="basicStyle">
				<div class="tableStyle">
					<div class="tableContainer">
						<div class="tableContent tc4">
							<h4 style="font-size:18px;">First Name</h4>
						</div>
						
						<div class="tableContent tc4">
							<h4 style="font-size:18px;">Last Name</h4>
						</div>
						
						<div class="tableContent tc4">
							<h4 style="font-size:18px;">Email</h4>
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
						$prof_firstname = $rows['firstname'];
						$prof_lastname = $rows['lastname'];
						$prof_email = $rows['email'];
						$user_id = $rows['user_id'];
						
						$confirm_text = "Are you sure you want to delete $prof_firstname $prof_lastname $prof_email?";
						
						echo "
						
						<div class='tableContainer'>
							<div class='tableContent tc4'>
								$prof_firstname
							</div>
							
							<div class='tableContent tc4'>
								$prof_lastname
							</div>
							
							<div class='tableContent tc4'>
								$prof_email
							</div>
							
							<div class='tableContent tc4'>
								<form action='EditProfinc.php' method='post' id='delete_btn'>
									<input name='delete_id' value='$user_id' hidden='true'>
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