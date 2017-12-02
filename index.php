<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	
	ggc_session();

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
    	Georgia Gwinnett College Project Review
    </title>
<!-- StyleSheets -->
	<link href="./css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/MainStyle.css" />
<!-- Bootstrap JQ & plugins--> 
	<script src="./js/jquery-1.11.3.min.js"></script> 
	<script src="./js/bootstrap.js"></script>
   <script src="js/password_encryption.js"></script>
    <script src="js/sha512.js"></script>
</head>

<body>
	<div class="title"><h1>Project Review</h1></div>
	
	<div id="container">
		<div class="loginStyle">
			<form class="form-horizontal" role="form" action="includes/login.php" method="post" name="login_form">
				<h4 style="margin-top:30px;">Email:</h4>
				<input type="text" class="form-control" id="email" name="email" placeholder="Email">
				
				<h4 style="margin-top:40px;">Password:</h4>
				<input type="password" class="form-control" name="password" id="password" placeholder="Password">
				<!--"btn btn-primary"-->
				<button type="submit" class="buttonStyle" value="Login" onclick="loginhash(this.form, this.form.password);" style="margin-top:40px;">Log-in</button>
				<button type="button" class="buttonStyle" value="FAQ" onclick="location.href='FAQ.html'" style="margin-top:40px;">Help</button>
			</form>
		</div>
	</div>
</body>


<!-- Top Navigation bar -->
	<!--<nav class="navbar navbar-default navbar-fixed-top" style="height: 100px;">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">
						<img alt="Brand" src="./Images/logo.png" height="75px">&nbsp;
					</a>
				</div>
				<div class="nav navbar-nav navbar-right" style="padding-top: 30px; padding-right: 5px;">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
						Log in <span class="glyphicon glyphicon-log-in"></span>
					</button>
				</div>
			</div>
		</nav>-->
		<!-- Modal -->
		<!--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<form class="form-horizontal" role="form" action="includes/login.php" method="post" name="login_form">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Log In</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Email:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="email" name="email" placeholder="Email">
									</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="password">Password:</label>
								<div class="col-sm-10"> 
									<input type="password" class="form-control" name="password" id="password" placeholder="Password">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary pull-right" value="Login" onclick="loginhash(this.form, this.form.password);">Log-in</button>
							<a class="btn btn-default pull-right" href="forgot_password.php">Password Reset</a>  
						</div>
					</div>
				</form>
			</div>
		</div>-->
<!-- Spanner Image -->
	<!--<div id="carousel_index" class="carousel slide" data-ride="carousel">-->
<!-- Wrapper for slides -->
			<!--<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img src="./Images/web-10.png" width="100%">
				</div>
				<div class="item">
					<img src="./Images/web-1.jpg" width="100%">
				</div>
				<div class="item">
					<img src="./Images/web-2.jpg" width="100%">
				</div>
				<div class="item">
					<img src="./Images/web-3.jpg" width="100%">
				</div>
				<div class="item">
					<img src="./Images/web-4.jpg" width="100%">
				</div>
				<div class="item">
					<img src="./Images/web-5.jpg" width="100%">
				</div>
				<div class="item">
					<img src="./Images/web-6.jpg" width="100%">
				</div>
				<div class="item">
					<img src="./Images/web-7.jpg" width="100%">
				</div>
				<div class="item">
					<img src="./Images/web-8.jpg" width="100%">
				</div>
				<div class="item">
					<img src="./Images/web-9.jpg" width="100%">
				</div>
			</div>-->
		<!--</div>-->
	
</html>