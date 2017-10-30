<?php
	include_once '../includes/connection_string.php';
	include_once '../includes/security.php';
	ggc_session();
if(isset($_GET['name']))
	{
		$projName1=$_GET['name'];
		$due_date1=$_GET['due_date'];
		$course_id1=preg_replace("/[^0-9]+/", "", $_GET['course_id']);
		
		$insert_stmt = $mysqli->prepare("INSERT INTO project (professor_id, course_id, name, due_date) VALUES (?,?,?,?)");
		$insert_stmt->bind_param('iiss', $_SESSION['user_id'], $course_id1, $projName1, $due_date1);
		$insert_stmt->execute();
		echo $projName1."<br>".$due_date1."<br>".$course_id1."<br>".$_SESSION['user_id'];
		header ('Location: ./addproj.php?course='.$course_id1.'&complete=true');
		exit();
	}
	if (isset($_POST['delete_id']))
	{
		$projName2=$_POST['delete_id'];
		$delete_stmt= $mysqli->query("DELETE FROM project WHERE project_id = '$projName2'");
		header ('Location: ./addproj.php?course='.$_GET['course'].'&complete=true');
		exit();
	}
?>