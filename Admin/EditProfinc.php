<?php
	include_once '../includes/connection_string.php';
	include_once '../includes/security.php';
	ggc_session();
	
	if (isset($_GET['delete_id']))
	{
		//$userID2=$_POST['delete_id'];
		$userID2=preg_replace("/[^0-9]+/", "", $_GET['delete_id']);
		
		$profFirstName2=$_GET['delete_firstname'];
		$profLastName2=$_GET['delete_lastname'];
		
		echo "".$userID2."<br/>".$profFirstName2."<br/>".$profLastName2."";
		echo "potato";
		//$delete_stmt->prepare();
		
		$delete_stmt= $mysqli->query("DELETE FROM user WHERE user_id = '$userID2' AND firstname = '$profFirstName2' AND lastname = '$profLastName2'");
		if ($mysqli->query($delete_stmt) == TRUE)
		{
			echo "the delete worked";
		}
		else
		{
			echo "oh shit, the delete failed";
		}
		
		
		//$delete_stmt->execute();
			
		echo "AND firstname = $profFirstName2 AND lastname = $profLastName2";
		
		header ('Location: ./EditProf.php');
		exit();
		
	}
?>