<?php
	include_once '../includes/connection_string.php';
	include_once '../includes/security.php';

	if(isset($_POST['submit']))
	{		
		//setup while loop
		$i=1;
		while(isset($_POST["d2lid".$i]))
		{
			$d2lid= $_POST["d2lid".$i];
			$firstname = $_POST["firstname".$i];
			$lastname = $_POST["lastname".$i];
			$email = $_POST["email".$i];
			echo($i."<br>");
			$stmt = $mysqli->prepare("SELECT user_id FROM user WHERE email = ? LIMIT 1");

			if ($stmt) 
			{
				$stmt->bind_param('s', $email);
				$stmt->execute();
				$stmt->store_result();

				if ($stmt->num_rows == 1) 
				{
					// email just adding to the class
					echo "added to course " . $email . "<br>";
					
				}
				if ($stmt->num_rows == 0) 
				{
					
					echo "emailed and added " . $email . "<br>";
				}
			} 
		//check if user is alread in
			//if not add to user list send email
		//add to the course
		
		//on to the next one
			$i++;
		}
		
	}
?>