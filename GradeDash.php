<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	
	ggc_session();
	
	/**GradeDash
   * This page will display all the relevant data for the project
   * from the passed variable from the last page. So all the submissions
   * will be taken from the MySQL database and then all the reviews from
   * those submission will be displayed right next to their respective submissions.
   */

	
	$stmt=$mysqli->query("SELECT * FROM submission WHERE submission.project_id = " .$_GET['project']);
	
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
