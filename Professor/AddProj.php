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
			Add Project
		</title>
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/MainStyle.css" />
	</head>
	
	<body>
		<div id="container">
		
			<h1>Add New Project</h1>
			
			<div class="basicStyle">
			
			<form action="AddProjinc.php" method="get">
					<div class="form-group" style="width:90%; margin-left:auto; margin-right:auto;">
						<label for="name">
							<strong>
								Project Name
							</strong>
						</label>
						<input type="text" class="form-control" name="name">
					</div>
					<div class="form-group" style="width:90%; margin-left:auto; margin-right:auto;">
						<label for="section">
							<strong>
								Due Date
							</strong>
						</label>
						<input type="text" class="form-control" name="due_date">
					</div>
					
					<input type="hidden" class="form-control" name="course_id" value="<?php echo $carry;?>">
					<button type='submit' class='buttonStyle' style="font-size:22px; width:100px;" name='submit' value='Submit Record'>Submit</button>
				</form>
			</div>
			
			<!--
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
				</tr>-->
			<h1>Existing Projects</h1>
			<div class="basicStyle">
				<div class="tableStyle">
					<div class="tableContainer">
						<div class="tableContent tc4">
							<h4 style="font-size:18px;">Project Name</h4>
						</div>
						
						<div class="tableContent tc4">
							<h4 style="font-size:18px;">Due Date</h4>
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
						$proj_id = $rows['project_id'];
						$projName = $rows['name'];
						$due_date = $rows['due_date'];
						
						$confirm_text = "Are you sure you want to delete $projName, due $due_date?";
						
						echo "
						<div class='tableContainer'>
							<div class='tableContent tc4'>
								$projName
							</div>
							
							<div class='tableContent tc4'>
								$due_date
							</div>
							
							<div class='tableContent tc4'>
								<form action='AddProjinc.php?course=$carry' method='post'>
									<input name='delete_id' value='$proj_id' hidden='true'>
									<button type='submit' class='buttonStyleDel' name='submit_delete' value='X' onclick='return confirm(\"$confirm_text\")';>X</button>
								</form>
							</div>
						";
					}
				}
?>
			</table>
			</div>
		</div>
	</body>
</html>