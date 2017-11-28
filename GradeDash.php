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
	
	/**fetchSubmissionRows
   * fetches the submissions according to the passed course and project
   * variables and displays all the submissions the professor clicked on
   * before they entered that page.
   * Void
   */
	if($stmt->num_rows != 0)
	{
		while($rows = $stmt->fetch_assoc())
		{
			
			$sub_id = $rows['submission_id'];
			$stu_id = $rows['student_id'];
			$proj_id = $rows['project_id'];
			$link = $rows['link'];
			
			/**fetchStudentRows
		   * fetches the student's first name and last name
		   * based on the information in the outer loop
		   * Void
		   */
			$stuStmt=$mysqli->query("SELECT * FROM user WHERE user_id = " . $stu_id);
			if ($stuStmt->num_rows != 0)
			{
				while($rows = $stuStmt->fetch_assoc())
				{
					$stuFirstName = $rows['firstname'];
					$stuLastName = $rows['lastname'];
					
					echo
					"
						<h1>SUBMISSION</h1>
						<h2>$stuFirstName</h2>
						<h2>$stuLastName</h2>
					";
				}
			}
			
			echo "
				<!--
					<h1>Submission</h1>

					<h3>$sub_id</h3>
					
					<h3>$stu_id</h3>
					
					<h3>$proj_id</h3>
				-->
					
					
					<a href=$link target='_blank'><td>$link</td></a>
				
			";
			
			/**fetchFinalGradeRows
		   * calculates the submissions grade based on
		   * a fetch of the reviews off that submission
		   * Void
		   */
			$revstmt=$mysqli->query("SELECT * FROM review WHERE review.submission_id = ".$sub_id);
			if ($revstmt->num_rows != 0)
			{
				$requirementsGrade = 0;
				$satisfactionGrade = 0;
				$incrementer = 0;
				while($rows = $revstmt->fetch_assoc())
				{
					$rev_id = $rows['review_id'];
					$stu_id = $rows['student_id'];
					$first = $rows['first'];
					$second = $rows['second'];
					$comment = $rows['comment'];
					
					$requirementsGrade += $first;
					$satisfactionGrade += $second;
					$incrementer++;
				}
				$requirementsGrade/=$incrementer;
				$satisfactionGrade/=$incrementer;
				echo "
				
						<h2>Requirements Grade: $requirementsGrade / 5</h2>
						<h2>Satisfaction Grade: $satisfactionGrade / 5</h2>
				
				";
			}
			
			/**fetchReviewRows
		   * fetches the review rows using the variable from the last loop
		   * being it grabs the submission id and grabs all the reviews for
		   * those submissions
		   * Void
		   */
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
					
					/**fetchStudentRows
				   * fetches the student's first name and last name
				   * based on the information in the outer loop
				   * Void
				   */
					$stuStmt=$mysqli->query("SELECT * FROM user WHERE user_id = " . $stu_id);
					if ($stuStmt->num_rows != 0)
					{
						while($rows = $stuStmt->fetch_assoc())
						{
							$stuFirstName = $rows['firstname'];
							$stuLastName = $rows['lastname'];
							
							echo
							"
								<h3>$stuFirstName</h2>
								<h3>$stuLastName</h2>
							";
						}
					}
					
					echo "
							<h2>Review</h2>
						<!--
							<td>$rev_id</td>
						
							<td>$stu_id</td>
						-->
							<h3>Requirements Rating: $first</h3>
						
							<h3>Satisfaction Rating: $second</h3>
						
							<h3>Comment: $comment</h3>
					";
				}
			}
			
		}
	}
	
?>
