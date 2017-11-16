<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	
	ggc_session();
	
	/**ReviewPage
   * This page's purpose is to allow the student to provide feedback
   * on their peer's submission, taking all their entries from this page
   * and then sending it over to ReviewPageinc for processing.
   */

	
	//reset the time zone
	//date_default_timezone_set('America/New_York');
	//$date = date('m/d/Y h:i:s a', time());
	$date = date('m/d/Y', time());
	$classStmt=$mysqli->query("SELECT * FROM course JOIN user WHERE course_id =" .$_GET['course']);
	
	$course_id = preg_replace("/[^0-9]+/", "", $_GET['course']);
	$project_id = preg_replace("/[^0-9]+/", "", $_GET['project']);
?>
<html>
	<head>
		<title>Review Page</title>
		<link rel="stylesheet" type="text/css" href="css/MainStyle.css" />
		
		
	</head>
	
	<body>
		<?php
			//echo time();
			echo $date;
			//for some reason we're set to Europe/Berlin timezone wise
			//echo date_default_timezone_get();
		?>
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
				
				<form action = "ReviewPageinc.php" method = "get">
					<div class="rating basicStyle">
						<h3>Did the project meet the minimum requirements?</h3>
						
						<div class="circleBox">
							<!--<div class="circle"></div>
							<div class="circle"></div>
							<div class="circle"></div>
							<div class="circle"></div>
							<div class="circle"></div>-->
							<input class = "radioAdj" type = "radio" name = "Q1" value = 1>
							<input class = "radioAdj" type = "radio" name = "Q1" value = 2>
							<input class = "radioAdj" type = "radio" name = "Q1" value = 3>
							<input class = "radioAdj" type = "radio" name = "Q1" value = 4>
							<input class = "radioAdj" type = "radio" name = "Q1" value = 5>
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
							<input class = "radioAdj" type = "radio" name = "Q2" value = 1>
							<input class = "radioAdj" type = "radio" name = "Q2" value = 2>
							<input class = "radioAdj" type = "radio" name = "Q2" value = 3>
							<input class = "radioAdj" type = "radio" name = "Q2" value = 4>
							<input class = "radioAdj" type = "radio" name = "Q2" value = 5>
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
						
						<div><textarea cols = "60" rows = "8" name = "comment"></textarea></div>
					</div>
					
					<div>
						<button type = "submit">Submit Review</button>
						<?php
						echo 
							"<input name='course' value='$course_id' hidden='true'>
							<input name='project' value='$project_id' hidden='true'>" ;
						?>
					</div>
					
				</form>
			</div>
		</div>
	</body>
</html>