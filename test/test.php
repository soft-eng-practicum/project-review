<?php
$mysqli= new mysqli("localhost", "root", "","project_review");
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
	$delete_stmt= $mysqli->query("DELETE FROM test WHERE id = '$id2'");
}
$stmt=$mysqli->query("SELECT * FROM test");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			This is a simple test
		</title>
		<link href="css/bootstrap.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="col-md-6">
			<table class="table table-hover">
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
							Email
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
						$id = $rows['id'];
						$firstname = $rows['firstname'];
						$lastname = $rows['lastname'];
						$email = $rows['email'];
						
						echo "
						
						<tr>
							<td>
								$id
							</td>
							<td>
								$firstname
							</td>
							<td>
								$lastname
							</td>
							<td>
								$email
							</td>
							<td>
								<form action='test.php' method='post'>
									<input name='delete_id' value='$id' hidden='true'>
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
				<form action="test.php" method="get">
					<div class="form-group">
						<label for="firstname">
							<strong>
								Firstname:
							</strong>
						</label>
						<input type="text" class="form-control" name="firstname">
					</div>
					<div class="form-group">
						<label for="lastname">
							<strong>
								Lastname:
							</strong>
						</label>
						<input type="text" class="form-control" name="lastname">
					</div>
					<div class="form-group">
						<label for="email">
							<strong>
								Email:
							</strong>
						</label>
						<input type="text" class="form-control" name="email">
					</div>
					<input type="submit" name="submit" value="Submit Record" class="btn btn-primary">
				</form>
			</div>
		</div>
	</body>
</html>