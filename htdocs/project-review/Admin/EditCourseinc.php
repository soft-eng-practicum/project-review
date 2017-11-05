<?php
	include_once '../includes/connection_string.php';
	include_once '../includes/security.php';
	ggc_session();
	
	if (isset($_GET['delete_id']))
	{
		$courseID2=preg_replace("/[^0-9]+/", "", $_GET['delete_id']);
		
		$name2=$_GET['delete_name'];
		$section2=$_GET['delete_section'];
		$semester2=$_GET['delete_semester'];
		
		$delete_stmt= $mysqli->prepare("DELETE FROM course WHERE course_id = '$courseID2' AND name = '$name2' AND section = '$section2' AND semester = '$semester2'");
		
		$delete_stmt->execute();
		
		header ('Location: ./EditCourse.php');
		exit();
		
	}
?>