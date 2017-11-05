<?php
	include_once 'includes/connection_string.php';
	include_once 'includes/security.php';
	
	ggc_session();
	
	//$stmt=$mysqli->query("SELECT * FROM course WHERE course_id =" .$_GET['course']);
	$stmt=$mysqli->query("SELECT * FROM course JOIN user WHERE course_id =" .$_GET['course'] . "AND course.professor_id = user.user_id");
	//$stmt=$mysqli->query("SELECT * FROM user JOIN class WHERE user.user_id = class.student_id");
	if($stmt->num_rows != 0)
				{
					while($rows = $stmt->fetch_assoc())
					{
						$id = $rows['course_id'];
						$name = $rows['name'];
						$prof = $rows['professor_id'];
						$sec = $rows['section'];
						$semester = $rows['semester'];
						$profName = $rows['firstname'];
						
						echo "
						
						<tr>
							<td>
								$id
							</td>
							<td>
								$name
							</td>
							<td>
								$prof
							</td>
							<td>
								$sec
							</td>
							<td>
								$semester
							</td>
							<td>
								$profName
							</td>
						</tr>";
					}
				}
?>
