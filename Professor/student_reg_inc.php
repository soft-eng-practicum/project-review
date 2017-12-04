<?php
	include_once '../includes/connection_string.php';
	include_once '../includes/security.php';

	if(isset($_POST['submit']))
	{		
		//setup while loop to go through the rows
		$course = $_POST['courseID'];
		$i=1;
		
		while(isset($_POST["d2lid".$i]))
		{
			//assign variables for the rows
			$d2lid= $_POST["d2lid".$i];
			$firstname = $_POST["firstname".$i];
			$lastname = $_POST["lastname".$i];
			$email = $_POST["email".$i];
			echo($i."<br>");
			
			//start html email
			$subject = "Thank you " . $firstname . ". Welcome to Project Review";
    		$headers = "From: registration@projectreview.com \r\n";
			$headers .= "To: $email \r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$message = '<html><body>';
			$message .= "<h1>Welcome $firstname</h1>";
			
			//check if the user exist so we dont make duplicates
			$stmt = $mysqli->prepare("SELECT user_id FROM user WHERE email = ? LIMIT 1");

			if ($stmt) 
			{
				$stmt->bind_param('s', $email);
				$stmt->execute();
				$stmt->store_result();

				
				if ($stmt->num_rows == 0) 
				{
					// Create a random salt
					$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

					// Insert the new user into the database 
					if ($insert_stmt = $mysqli->prepare("INSERT INTO user (d2l_code, firstname, lastname, email, salt , s_code) VALUES (?, ?, ?, ?, ?, ?)")) 
					{
						$scode=5;
						$insert_stmt->bind_param('sssssi', $d2lid, $firstname, $lastname, $email, $random_salt, $scode);
						// Execute the prepared query.
						if (! $insert_stmt->execute()) 
						{
							header('Location: ../error.php?err=Registration failure: INSERT');
							exit();
						}
						//more email
						$message .= "<h3>You have been added to Project Review</h3>";
						$message .= "<p>You may follow the link to authinticate your account <a href='http://www.souciernd.com/projectreview/forgot_password.php?alpha=$email&beta=$random_salt'>HERE</a>'</p>";
						echo("$firstname added to user.");
					}
				}
			} 
			
			//get the users db id
			$result = $mysqli->query("SELECT user_id FROM user WHERE email = '$email' LIMIT 1");

			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) 
				{
					$studentid =$row["user_id"];
					echo "  $firstname student id is $studentid";
				}
			}
			
			//check to make sure we dont make duplicate class entries
			$stmt2 = $mysqli->prepare("SELECT class_id FROM class WHERE student_id = '$studentid' AND course_id = '$course' LIMIT 1");

			if ($stmt2) 
			{
				$stmt2->execute();
				$stmt2->store_result();

				
				if ($stmt2->num_rows == 0) 
				{
					// Insert the user into the class defined by the course 
					if ($insert_stmt = $mysqli->prepare("INSERT INTO class (course_id, student_id) VALUES (?, ?)")) 
					{
						$insert_stmt->bind_param('ii', $course, $studentid);
						// Execute the prepared query.
						if (! $insert_stmt->execute()) 
						{
							header('Location: ../error.php?err=Registration failure: INSERT');
							exit();
						}
						//more email
						$message .= "<h3>You have been added to Course: $course</h3>";
					}
				}
			} 
			//more email
			$message .= "</body></html>";
			//send the email
			mail($email,$subject,$message,$headers);
		
			header("Location: ../classdash.php?course=$course");
			//on to the next one
			$i++;
		}
		
	}
?>