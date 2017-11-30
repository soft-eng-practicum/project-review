<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	ggc_session();
	
	/**ReviewPageinc
   * This page takes data from the form in ReviewPage,
   * prepares SQL statements based on that data, and inserts
   * that data into the Review Table in the MySQL database
   * with the associated submissions.
   */

	
	date_default_timezone_set('America/New_York');
	$date = date('Y/m/d', time());
	
	
	
	
if(isset($_GET['link']))
	{
		$link = $_GET['link'];
		$course = $_GET['course'];
		$project = $_GET['project'];
		
		$stmt=$mysqli->query("SELECT * FROM submission where project_id = ".$_GET['project']. "AND student_id = " .$_SESSION[user_id]);
		
		if($stmt->num_rows = 0)
		{
			$insert_stmt = $mysqli->prepare("INSERT INTO submission (student_id, project_id, time, link) VALUES (?,?,?,?)");
			$insert_stmt->bind_param('iiss', $_SESSION['user_id'], $project, $date, $link);
			$insert_stmt->execute();
		}
		else
		{
			$submission_id;
			
			while($rows = $projstmt->fetch_assoc())
			{
				$submission_id = preg_replace("/[^0-9]+/", "", $rows['submission_id']);
			}
			$insert_stmt = $mysqli->prepare("UPDATE INTO submission (submission_id, student_id, project_id, time, link) VALUES (?,?,?,?,?) WHERE user_id =". $_SESSION['user_id'] ." AND submission_id = ".$submission_id)
			$insert_stmt->bind_param('iiiss', $submission_id, $_SESSION['user_id'], $project, $date, $link);
			$insert_stmt->execute();
		}
		
		header ('Location: ./ProjectDash.php?course='.$course_id.'&project='.project_id.'&complete=true');
		
		exit();
	}
?>