<?php
	include_once '../includes/connection_string.php';
	include_once '../includes/security.php';
	ggc_session();
	
	/**EditCourseinc
   * This page takes all the data in the last page, 
   * and prepares SQL statements based on the last
   * page's variables that have been filled.
   */

	
	/**insertCourseRows
   * this block of code, takes the data from the form
   * in the last page, and prepares and executes a SQL query
   * for an insert into the Course Table.
   * Void
   */
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