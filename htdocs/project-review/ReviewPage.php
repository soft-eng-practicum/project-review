<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	
	ggc_session();
	
	$classStmt=$mysqli->query("SELECT * FROM course JOIN user WHERE course_id =" .$_GET['course']);
?>
<html>
	<head>
		<title>Review Page</title>
		<link rel="stylesheet" type="text/css" href="ReviewPageStyle.css" />
		
		
	</head>
	
	<body>
		<div id="container">
			<div id="header">
				<!--<h1>Software Development 2</h1>-->
				<!--<h2>Fall 2017</h2>-->
				<!--<h3>Section 01</h3>-->
				<?php
				//I'll admit this is the most attrocious block of code I've ever written -Coker
				if($classStmt->num_rows != 0)
				{
					$name;
					$semester;
					$section;
					while($rows = $classStmt->fetch_assoc())
					{
						//I'll figure this out later, but this is super innefficient to grab one rows
						//I already have my SELECT ready, but I don't know how to grab a singular row (I'm also out of patience)
						$name = $rows['name'];
						$semester = $rows['semester'];
						$section = $rows['section'];
					}
					echo "<h1>$name</h1>";
					echo "<h2>$semester</h2>";
					echo "<h3>$section</h3>";
				}
				?>
			</div>
		
			<div id="reviewcontents">
				<div class="projectLink basicStyle">
					<a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank">Link to project</a>
					<?php 
						//This is where I need to grab the individual submission
					?>
				</div>
				
				<div class="rating basicStyle">
					<h3>Did the project meet the minimum requirements?</h3>
					
					<div class="circleBox">
						<!--<div class="circle"></div>
						<div class="circle"></div>
						<div class="circle"></div>
						<div class="circle"></div>
						<div class="circle"></div>-->
						<input class = "radioAdj" type = "radio" name = "Q1">
						<input class = "radioAdj" type = "radio" name = "Q1">
						<input class = "radioAdj" type = "radio" name = "Q1">
						<input class = "radioAdj" type = "radio" name = "Q1">
						<input class = "radioAdj" type = "radio" name = "Q1">
					</div>
					
					<div class="circleBoxLabel">
						<div class="stronglyDisagree">
							<h4>Strongly Disagree</h4>
						</div>
						
						<div class="stronglyAgree">
							<h4>Strongly Agree</h4>
						</div>
					</div>
				</div>
				
				<div class="rating basicStyle">
					<h3>Did you like the project?</h3>
					
					<div class="circleBox">
						<!--<div class="circle"></div>
						<div class="circle"></div>
						<div class="circle"></div>
						<div class="circle"></div>
						<div class="circle"></div>-->
						<input class = "radioAdj" type = "radio" name = "Q2">
						<input class = "radioAdj" type = "radio" name = "Q2">
						<input class = "radioAdj" type = "radio" name = "Q2">
						<input class = "radioAdj" type = "radio" name = "Q2">
						<input class = "radioAdj" type = "radio" name = "Q2">
					</div>
					
					<div class="circleBoxLabel">
						<div class="stronglyDisagree">
							<h4>Strongly Disagree</h4>
						</div>
						
						<div class="stronglyAgree">
							<h4>Strongly Agree</h4>
						</div>
					</div>
				</div>
				
				<div class="response basicStyle">
					<h3>Do you have any other thoughts on the project?</h3>
					
					<div><textarea cols = "60" rows = "8" name = "comments"></textarea></div>
				</div>
			</div>
		</div>
	</body>
</html>