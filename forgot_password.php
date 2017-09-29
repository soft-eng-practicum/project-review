<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	
	ggc_session();

	if(isset($_POST['submit'])&& $_POST['submit']=='Email Me')
	{
		$step=1;
		$email= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		
		if ($prep_stmt = $mysqli->prepare("SELECT firstname,lastname, email, password, salt FROM members WHERE email LIKE ? LIMIT 1")) 
		{
			$prep_stmt->bind_param('s', $email);
			$prep_stmt->execute();
			$prep_stmt->store_result();
			$prep_stmt->bind_result($firstname, $lastname, $email_db, $alpha, $beta);
			$prep_stmt->fetch();

			if ($prep_stmt->num_rows == 1) 
			{
				$subject = "Project Review Pasword Reset";
				$headers = "From: project.review@ggc.edu\r\n";
				$headers .= "To: " . $email_db . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$message = '<html><body>';
				$message .= '<h1>Please Click on the link below to reset your password</h1>';
				$message .= '<a href="http://localhost/forgot_password.php?alpha=' . $email . '&beta=' . $beta . '">Reset My Password</a>';
				$message .= "</body></html>";

				mail($email,$subject,$message,$headers);
				header('Location: ./login_password_request.php');
				exit();	
			}
		} 
		else 
		{
			header('Location: ./error.php?message=THE CARRIER PIGEON DELIVERING YOUR EMAIL WAS STRUCK BY LIGHTNING');
			exit();
		}
	}
	if(isset($_GET['alpha']))
	{
		$step=2;
	}
	if(isset($_POST['pass']))
	{
		$step=3;
		if (isset( $_POST['email'], $_POST['salt'], $_POST['pass'])) 
		{
			// Sanitize and validate the data passed in
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
			$salt = filter_input(INPUT_POST, 'salt', FILTER_SANITIZE_EMAIL);
			$password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
			if (strlen($password) != 128) 
			{
				header('Location: ./error.php?message=NOT ENOUGH CHARACTERS, MY DUDE');
				exit();
			}

			if ($verification_stmt = $mysqli->prepare("SELECT email, salt FROM user WHERE email = ?")) 
			{
				$verification_stmt->bind_param('s', $email);
				$verification_stmt->execute();
				$verification_stmt->store_result();
				$verification_stmt->bind_result($email_db, $salt_db);
				$verification_stmt->fetch();

				if ($salt_db != $salt) 
				{
					header('Location: ./error.php?message=SALT NO SALTS');
					exit();
				}
			} 
			else 
			{
				header('Location: ./error.php?message=YOU FORGOT HOW TO CREATE A SQL STATEMENT FOR THE RESET YO');
				exit();
			}

			if (empty($error_msg)) 
			{
				// Create a random salt
				$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

				$password = hash('sha512', $password . $random_salt);

				// Insert the new user into the database 
				if ($reset_stmt = $mysqli->prepare("UPDATE user 
													SET password=? , salt=?
													WHERE email=?")) 
				{
					$reset_stmt->bind_param('sss',$password, $random_salt, $email);
					// Execute the prepared query.
					if (! $reset_stmt->execute()) 
					{
						header('Location: ./error.php?message=THE POOR MOUSE THAT RESETS PASSWORDS IS TIRED');
						exit();
					}
				}
				$from = $_POST['email']; // this is the sender's Email address
				$subject = $firstname . " your pasword has been reset";
				$headers = "To: " . strip_tags($from) . "\r\n";
				$headers .= "From: project.review@ggc.edu\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$message = '<html><body>';
				$message .= '<h1>Your password has been reset.</h1>';
				$message .= "<p>If you did not request this please contact us immediatly.</p>";
				$message .= "</body></html>";

				mail($from,$subject,$message,$headers);
			}
		}
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
    	Georgia Gwinnett College Project Review: Test
    </title>
<!-- StyleSheets -->
	<link href="./css/bootstrap.css" rel="stylesheet">
<!-- Bootstrap JQ & plugins--> 
	<script src="./js/jquery-1.11.3.min.js"></script> 
	<script src="./js/bootstrap.js"></script>
	<script src="./js/password_encryption.js"></script>
	<script src="./js/sha512.js"></script>
	
</head>

<body>
	<div class="container tcispacer" style="padding-top:25px;">
   	<?php if(!isset($step)){?>
    	<form role="form" method="post" name="registration_form" action="forgot_password.php">
        	<div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
         	<div class="row">
                <div class="form-group col-xs-12">
                    <label for="Email">Enter Your Account Email</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
         	</div>
        	<input type="submit" name="submit" id="submit" value="Email Me" class="btn btn-info pull-right">
        </form>
        <?php }?>
        <?php if(isset($step)&& $step==1){?>
        	<h1>
        		Please check your email for the password update link.
			</h1>
        <?php }?>
        <?php if(isset($step)&& $step==2){?>
        	<form role="form" method="post" name="registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']);?>">
                <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
				 <input type="hidden" name="email" id="email" value="<?php echo $_GET['alpha'];?>">
				 <input type="hidden" name="salt"  id="salt" value="<?php echo $_GET['beta'];?>">
				 <div class="row">
						<div class="form-group col-xs-12">
							<label for="password">Enter New Password</label>
							<div class="input-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
								<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
							</div>
						</div>
				 </div>
				 <div class="row">
						<div class="form-group col-xs-12">
							<label for="confirmpwd">Confirm New Password</label>
							<div class="input-group">
								<input type="password" class="form-control" id="confirmpwd" name="confirmpwd" placeholder="Confirm Password" required>
								<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
							</div>
						</div>
				</div>
				<input type="button" value="Submit New Password" class="btn btn-info pull-right" onclick="return resetformhash(this.form, this.form.email, this.form.salt, this.form.password, this.form.confirmpwd);">
				</form>
        <?php }?>
        <?php if(isset($step)&& $step==3){?>
        <h1>
			Your Password has been reset. Visit the <a href="./index.php">home page</a> to use your new password. 
		</h1>
        <?php }?>
    </div>
</body>
</html>