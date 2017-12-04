<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	ggc_session();
	
	/**add submission
   * This page takes data from the form in project dash,
   * prepares SQL statements based on that data, and inserts
   * that data into the submission Table in the MySQL database
   * with the associated submissions.
   */

	
	date_default_timezone_set('America/New_York');
	$date = date('F j, Y, g:i a');
	
	
	
	
if(isset($_POST['link']))
	{
		$link = $_POST['link'];
		$course = $_POST['course'];
		$project = $_POST['project'];
		
		echo($link."<br> ottno ".$course."<br> ottno ".$project);
		
		$stmt=$mysqli->query("SELECT * FROM submission WHERE project_id = '$project' AND student_id = " .$_SESSION['user_id']);
		
		if($stmt->num_rows == 0)
		{
			$insert_stmt = $mysqli->prepare("INSERT INTO submission (student_id, project_id, time, link) VALUES (?,?,?,?)");
			$insert_stmt->bind_param('iiss', $_SESSION['user_id'], $project, $date, $link);
			$insert_stmt->execute();
		}
		if($stmt->num_rows < 0)
		{
			$rows = $stmt->fetch_assoc();
			$submission_id = $rows['submission_id'];
			
			$insert_stmt = $mysqli->prepare("UPDATE INTO submission (time, link) VALUES (?,?) WHERE submission_id = '".$submission_id ."'");
			$insert_stmt->bind_param('ss', $date, $link);
			$insert_stmt->execute();
		}
		
		header ("Location: ./ProjectDash.php?course=$course&project=$project&complete=true");
		
		exit();
	}
?>