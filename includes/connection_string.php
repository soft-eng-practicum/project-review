<?php
	$mysqli = new mysqli("localhost", "ggc_user", "ggc", "ggc_project_review");
	if ($mysqli->connect_error) {
		header("Location: ../error.php?message=NO FREAKIN MAIN FRAME");
		exit();
	}
?>