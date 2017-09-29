<?php
$message = filter_input(INPUT_GET, 'message', $filter = FILTER_SANITIZE_STRING);

if (! $message) {
    $message = 'Oops! An unknown error happened.';
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Alpha</title>
        <link rel="stylesheet" href="css/bootstrap.css" />
    </head>
    <body class="container-fluid bg-primary">
        <div class="row">
        	<div class="col-xs-9 col-xs-push-1">
        		<br>
        		<br>
				<h1 >There was a problem</h1>
				<p><?php echo $message; ?></p>
			</div>
			<div class="col-xs-2">
				<p style="font-size: 10em;">:(</p>
			</div>
		</div>  
    </body>
</html>
