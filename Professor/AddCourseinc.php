<?php
	include_once '../includes/connection_string.php';
	include_once '../includes/security.php';
	ggc_session();
if(isset($_GET['name']))
	{
		$course_name1=$_GET['name'];
		$section1=$_GET['section'];
		$semester1=$_GET['semester'];
		$professor_id1=preg_replace("/[^0-9]+/", "", $_SESSION['user_id']);
		$temp = 10;
		
		$insert_stmt = $mysqli->prepare("INSERT INTO course (course_id, name, section, professor_id, semester) VALUES (?,?,?,?,?)");
		$insert_stmt->bind_param('issis', $temp, $course_name1, $section1, $professor_id1, $semester);
		$insert_stmt->execute();
		//echo $projName1."<br>".$due_date1."<br>".$course_id1."<br>".$_SESSION['user_id'];
		header ('Location: ./AddCourse.php');
		//?course='.$course_id1.'&complete=true');
		exit();
	}
	/*//Code for delete button in table
	if (isset($_POST['delete_id']))
	{
		$projName2=$_POST['delete_id'];
		$delete_stmt= $mysqli->query("DELETE FROM project WHERE project_id = '$projName2'");
		header ('Location: ./addproj.php?course='.$_GET['course'].'&complete=true');
		exit();
	}*/
?>