<?php
	include_once './includes/connection_string.php';
	include_once './includes/security.php';
	
	ggc_session();
	
	//$stmt=$mysqli->query("SELECT * FROM course WHERE course_id =" .$_GET['course']);
	
	//Important SQL statement
	$stmt=$mysqli->query("SELECT * FROM course JOIN user WHERE course_id =" .$_GET['course'] . "AND course.professor_id = user.user_id");
	
	
	//$stmt=$mysqli->query("SELECT * FROM user JOIN class WHERE user.user_id = class.student_id");
	//$projstmt=$mysqli->query("SELECT * FROM course JOIN project WHERE course_id=" .$_GET['course'] . "AND course.course_id = project.course_id");
	$projstmt=$mysqli->query("SELECT * FROM project WHERE project.course_id =" .$_GET['course']);
?>
