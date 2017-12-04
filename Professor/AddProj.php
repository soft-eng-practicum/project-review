<?php
	include_once '../includes/connection_string.php';
	include_once '../includes/security.php';
	
	ggc_session();
	
	$carry = $_GET['course'];
	
	//echo "$carry";
	
	/*
	if(isset($_GET['name']))
	{
		$projName1=$_GET['name'];
		$due_date1=$_GET['due_date'];
		$course_id1=preg_replace("/[^0-9]+/", "", $_GET['course_id']);
		
		$insert_stmt = $mysqli->prepare("INSERT INTO project (professor_id, course_id, name, due_date) VALUES (?,?,?,?)");
		$insert_stmt->bind_param('iiss', $_SESSION['user_id'], $carry, $projName1, $due_date1);
		$insert_stmt->execute();
	}
	if (isset($_POST['delete_id']))
	{
		$projName2=$_POST['delete_id'];
		$delete_stmt= $mysqli->query("DELETE FROM project WHERE project_id = '$projName2'");
	}
	
	*/
	$stmt= $mysqli->query("SELECT * FROM project WHERE project.course_id =" .$_GET['course']);
	
	echo "This is Add Project File";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			This is a simple test
		</title>
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/MainStyle.css" />
	</head>
	
	<body>
		<div id="container">
			<div class="col-md-6">
			<table class="table table-hover">
				<tr>
					<td>
						<strong>
							Project Name
						</strong>
					</td>
					<td>
						<strong>
							Due Date
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
						$proj_id = $rows['project_id'];
						$projName = $rows['name'];
						$due_date = $rows['due_date'];
						
						$confirm_text = "Are you sure you want to delete $projName?";
						
						echo "
						
						<tr>
							<td>
								$projName
							</td>
							<td>
								$due_date
							</td>
							<td>
								<form action='AddProjinc.php?course=$carry' method='post'>
									<input name='delete_id' value='$proj_id' hidden='true'>
									<input type='submit' name='submit_delete' value='X' class='btn btn-danger pull-right' onclick='return confirm(\"$confirm_text\")'>
								</form>
							</td>
						</tr>";
					}
				}
?>
			</table>
			</div>
			<div class="col-md-6">
				<form action="AddProjinc.php" method="get">
					<div class="form-group">
						<label for="name">
							<strong>
								Project Name:
							</strong>
						</label>
						<input type="text" class="form-control" name="name">
					</div>
					<div class="form-group">
						<label for="due_date">
							<strong>
								Due Date:
							</strong>
						</label>
						<input type="date" class="form-control" name="due_date">
					</div>
						<input type="text" class="form-control" name="course_id" value="<?php echo $carry;?>" hidden="true">
					<input type="submit" name="submit" value="Submit Record" class="btn btn-primary">
				</form>
			</div>
		</div>
	</body>
</html>