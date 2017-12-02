<?php
	include_once '../includes/connection_string.php';
	include_once '../includes/security.php';
	ggc_session();
	
	/**EditProfinc
   * This class receives all the information from EditProf
   * and then prepares SQL statements so that it may be
   * either removing, adding, or updating the MySQL database.
   */
	
	if (isset($_GET['prof_email']))
	{
		$prof_email1=$_GET['prof_email'];
		$prof_firstname1=$_GET['firstname'];
		$prof_lastname1=$_GET['lastname'];
		$prof_code = 3;
		
		$insert_stmt = $mysqli->prepare("INSERT INTO user (firstname, lastname, email, s_code) VALUES (?,?,?,?)");
		$insert_stmt->bind_param('sssi', $prof_firstname1, $prof_lastname1, $prof_email1, $prof_code);
		
		$insert_stmt->execute();
		
		header ('Location: ./EditProf.php');
		exit();
	}
	//Code for delete button in table
	if (isset($_POST['delete_id']))
	{
		$user_id2=$_POST['delete_id'];
		$delete_stmt= $mysqli->query("DELETE FROM user WHERE user_id = '$user_id2'");
		header ('Location: ./EditProf.php');
		exit();
	}
?>