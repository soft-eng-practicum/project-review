<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
        

if (isset($_POST['fname'], $_POST['lname'], $_POST['phone'], $_POST['email'], $_POST['pass'], $_POST['confirm'])) 
{
    // Sanitize and validate the data passed in
    $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
	$lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
	$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$password = filter_input(INPUT_POST, 'pass',FILTER_SANITIZE_STRING);
    $carrier='@vtext.com';
	
    $prep_stmt = "SELECT email FROM user WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
    
    if ($stmt) 
	{
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows == 1) 
		{
            $error_msg .= '<p>this email already in here fool.</p>';
        }
    } 
	else 
	{
        $error_msg .= '<p>the database is dead</p>';
    }
    
    if (empty($error_msg)) 
	{
		$salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

        // Create salted password 
        $password = hash('sha512', $password . $salt);
        if ($insert_stmt = $mysqli->prepare("INSERT INTO user (firstname, lastname, phone, email, carrier, password, salt) VALUES (?, ?, ?, ?, ?, ?, ?)")) 
		{
            $insert_stmt->bind_param('sssssss', $fname, $lname, $phone, $email, $carrier,  $password, $salt);
            if (! $insert_stmt->execute()) 
			{
                header("Location: ../error.php?message=can_you_remind_me_how_to_register_someone.lol");
        		exit();
            }
        } 
        header('Location: ./index.php');
        exit();
    }
	echo('we dead');
}
?>
<script type="text/javascript">
	function regformhash(form, fname, lname, phone, email, password, confirm) 
	{
    if (fname.value == '' || lname.value == '' || phone.value == '' || email.value == '' || password.value == '' || confirm.value == '') 
	{
        alert('you didnt fill everything out');
        return false;
    }
    
    if (password.value.length < 8) 
	{
        alert('8 character long password buddy');
        form.password.focus();
        return false;
    }
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) 
	{
        alert('atleast one number, one lowercase and one uppercase letter');
        return false;
    }
    if (password.value != confirm.value) 
	{
        alert('pssword dont match');
        form.password.focus();
        return false;
    }
       
    var pass = document.createElement("input");

    // Add the new element to our form. 
    form.appendChild(pass);
    pass.name = "pass";
    pass.type = "hidden";
    pass.value = hex_sha512(password.value);
 
    password.value = "";
    confirm.value = "";

    form.submit();
    return true;
	}
</script>
<script src="js/sha512.js"></script>
<link href="./css/bootstrap.css" rel="stylesheet">

<div class="">
	<form class="form-horizontal" role="form" method="post" name="registration_form" action="">
		<div class="form-group">
			<label class="control-label col-sm-2" for="fname">First Name:</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="fname" name="fname" placeholder="fname">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="lname">Last Name:</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="lname" name="lname" placeholder="lname">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="phone">Phone:</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="phone" name="phone" placeholder="phone">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="email">Email:</label>
			<div class="col-sm-8">
				<input type="email" class="form-control" id="email" name="email" placeholder="Email">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="password">Password:</label>
			<div class="col-sm-8"> 
				<input type="password" class="form-control" name="password" id="password" placeholder="Password">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="confirm">Confirm Password:</label>
			<div class="col-sm-8"> 
				<input type="password" class="form-control" name="confirm" id="confirm" placeholder="confirm">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-6">
				<input type="button"value="Register" class="btn btn-info pull-right"onclick="return regformhash(this.form,
                                   this.form.fname,
                                   this.form.lname,
                                   this.form.phone,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirm);">            
			</div>
		</div>
	</form>
</div>