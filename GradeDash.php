<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	
	ggc_session();
	
	//Important SQL statement
	//$stmt=$mysqli->query("SELECT * FROM course JOIN user WHERE course_id =" .$_GET['course'] . "AND course.professor_id = user.user_id");
	
	/*
	$projstmt=$mysqli->query("SELECT * FROM project WHERE project.course_id =" .$_GET['course']);
	$substmt=$mysqli->query("SELECT * FROM submission JOIN project ON project.project_id AND submission.project_id WHERE project_id = ".$_GET['project_id']);
	$revstmt=$mysqli->query("SELECT * FROM review AND submission ON submission.submission_id = review.submission_id ");
	*/
	//$stmt=$mysqli->query("SELECT * FROM submission JOIN review ON submission.submission_id = review.submission_id WHERE submission.submission_id = ".$_GET['project_id']);
	//$stmt=$mysqli->query("SELECT * FROM submission WHERE submission.submission_id = ".$_GET['project_id']);
	$stmt=$mysqli->query("SELECT * FROM submission WHERE submission.project_id = " .$_GET['project']);
	

	//$revstmt=$mysqli->query("SELECT * FROM review");
?>

<?php
	if($stmt->num_rows != 0)
	{
		while($rows = $stmt->fetch_assoc())
		{
			
			$sub_id = $rows['submission_id'];
			$stu_id = $rows['student_id'];
			$proj_id = $rows['project_id'];
			$link = $rows['link'];
			echo "
					<h1>Submission</h1>
					<h3>$sub_id</h3>
					<h3>$stu_id</h3>
					<h3>$proj_id</h3>
					
					<a href=$link target='_blank'><td>$link</td></a>
				
			";
			//$revstmt=$mysqli->query("SELECT * FROM review WHERE review.submission_id = ".$sub_id);
			
			$revstmt=$mysqli->query("SELECT * FROM review WHERE review.submission_id = ".$sub_id);
			if ($revstmt->num_rows != 0)
			{
				while($rows = $revstmt->fetch_assoc())
				{
					$rev_id = $rows['review_id'];
					$stu_id = $rows['student_id'];
					$first = $rows['first'];
					$second = $rows['second'];
					$comment = $rows['comment'];
					echo "
							<h2>Review</h2>
							<td>$rev_id</td>
						
							<td>$stu_id</td>
						
							<td>$first</td>
						
							<td>$second</td>
						
							<td>$comment</td>
					";
				}
			}
			
		}
	}
	
?>
