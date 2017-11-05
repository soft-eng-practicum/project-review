<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	ggc_session();
	
	date_default_timezone_set('America/New_York');
	$date = date('Y/m/d', time());
	
	$course_id = $_GET['course'];
	$project_id = $_GET['project'];
	
if(isset($_GET['Q1']))
	{
		$Q1=preg_replace("/[^0-9]+/", "", $_GET['Q1']);
		$Q2=preg_replace("/[^0-9]+/", "", $_GET['Q2']);
		$comment = $_GET['comment'];
		//$date = $_GET['date'];
		$submission_id=preg_replace("/[^0-9]+/", "", $_GET['Q1']);
		$insert_stmt = $mysqli->prepare("INSERT INTO review (submission_id, student_id, time, first, second, comment) VALUES (?,?,?,?,?,?)");
		$insert_stmt->bind_param('iisiis', $submission_id, $_SESSION['user_id'], $date, $Q1, $Q2, $comment);
		$insert_stmt->execute();
		echo $_SESSION['user_id']."<br>".$Q1."<br>".$Q2."<br>".$comment;
		//header ('Location: ./addproj.php?course='.$course_id1.'&complete=true');
		header ('Location: ./ProjectDash.php?course='.$course_id.'&project='.project_id.'&complete=true');
		exit();
	}
?>