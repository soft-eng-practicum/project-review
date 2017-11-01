<!Doctype html>
<html>
	<body>
	<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	
	ggc_session();
	
	//$projects = ["EmmaProj", "OliviaProj", "LiamProj", "AvaProj", "NoahProj", "LucasProj", "LoganProj"];
	//$students = ["Emma", "Olivia", "Liam", "Ava", "Noah", "Lucas", "Logan"];
	$stu_projs = array();
	//$x = 1;
	$reviews = array();
	$subs_list = array();
	
	$submissions = $mysqli->query("SELECT * FROM submission");
	$users = $mysqli->query("SELECT * FROM user");
	$user_subs = $mysqli->query("SELECT * FROM user JOIN submission ON user.user_id = submission.student_id");

	while ($rows = $user_subs->fetch_assoc())
	{
		$fullname = "$rows[firstname] $rows[lastname]";
		//echo "$fullname<br>";
		$subs_list[$rows['project_id']] = $fullname;
		$user_id = $rows['user_id'];
		//echo "$rows['user_id']";
	}
	
	echo "$_SESSION[firtname]";// $_SESSION[lastname]";
	
	
	//print out project submissions and owners
	foreach ($subs_list as $key=>$value)
	{
		echo "$value: $key <br>";	
	}
	
	
	/*
	//show project ownership
	for ($i = 0; $i <= sizeof($projects) - 1; $i++)
	{
		//echo "$students[$i]: $projects[$i] <br>";
		$stu_projs[$students[$i]] = $projects[$i];
	}
	
	foreach ($stu_projs as $key=>$value)
	{
		echo "$key: $value <br>";	
	}
	
	shuffle($projects);
	echo "<br><br> Assignments:<br>";
	
	//assign projects
	for ($i = 0; $i <= sizeof($students) - 1; $i++)
	{
		//check project isn't original owner and students aren't reviewing each other
		if ($stu_projs[$students[$i]] != $projects[$i])
		{
			$reviews[$students[$i]] = $projects[$i];
		}
		else
		{
			$temp = $projects[$i];
			$projects[$i] = $projects[$i + 1];
			$projects[$i + 1] = $temp;
		}
	}
	
	//print assignments
	foreach ($reviews as $key=>$value)
	{
		echo "$key: $value <br>";
	}*/
	
	?>
	</body>
</html>