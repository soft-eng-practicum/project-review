<?php
	include_once '../includes/connection_string.php';
	include_once '../includes/security.php';
	
	ggc_session();

	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script type="text/javascript">
	function youdecide(theone)
	{
		var csv = document.getElementById("easy_way"); 
		var ind = document.getElementById("hard_way");
		var sel = document.getElementById("selection");
		
		if(theone==1)
			{
				csv.hidden=false;
			}
		if(theone==2)
			{
				ind.hidden=false;
			}
		
		sel.hidden=true;
	}
	function ottno(place)
	{
		var but = document.getElementById("btnfor"+place);
		var row = document.getElementById("row"+place);
		but.hidden=true;
		row.hidden=false;
	}
</script>
<script type="text/javascript">
	function Upload() 
	{
		var fileUpload = document.getElementById("csvFile");
		var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;
		if (regex.test(fileUpload.value.toLowerCase())) 
		{
			if (typeof (FileReader) != "undefined") 
			{
				var reader = new FileReader();
				reader.onload = function (e) 
				{
					var table = document.createElement("table");
					var rows = e.target.result.split("\n");
					for (var i = 0; i < rows.length; i++) 
					{
						if(i!=0)
							{
								var row = table.insertRow(-1);
								var cells = rows[i].split(",");
								for (var j = 0; j < cells.length-1; j++) 
								{
									var where = ["d2lid","lastname","firstname", "email"];
									var cell = row.insertCell(-1);
									cell.innerHTML = "<input type='text' name='" + where[j] + i +"' value='" + cells[j] + "'>";
								}
							}
					}
					var dvCSV = document.getElementById("csv_table");
					dvCSV.innerHTML = "";
					dvCSV.appendChild(table);
				}
				reader.readAsText(fileUpload.files[0]);
			} 
			else 
			{
				alert("This browser does not support HTML5.");
			}
		} 
		else 
		{
			alert("Please upload a valid CSV file.");
		}
	}
</script>
</head>

<body>
<?php if(!isset($_GET['complete'])){?>
	<div id="selection">
		<button type="button" onClick="youdecide(1)">Upload via CSV</button>
		&nbsp;
		&nbsp;
		<button type="button" onClick="youdecide(2)">Add as Individual</button>
	</div>
	<form id="easy_way" action="./includes/student_reg_inc.php" method="post" hidden="true" enctype="multipart/form-data">
	<input type="file" name="csvFile" id="csvFile" onChange="Upload()">
	<div id="csv_table">
	
	</div>
	<input type="submit" name="submit">
	</form>
	
	<form id="hard_way" action="./student_reg_inc.php" method="post" hidden="true">
		<table>
			<tr>
				<td>
					<strong>#</strong>
				</td>
				<td>
					<strong>D2L Id:</strong>
				</td>
				<td>
					<strong>First Name:</strong>
				</td>
				<td>
					<strong>Last Name:</strong>
				</td>
				<td>
					<strong>Email:</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>1</strong>
				</td>
				<td>
					<input type="text" name="d2lid1">
				</td>
				<td>
					<input type="text" name="firstname1">
				</td>
				<td>
					<input type="text" name="lastname1">
				</td>
				<td>
					<input type="text" name="email1" onChange="ottno(2)">
				</td>
			</tr>
			<?php
				
					for($i = 2; $i <= 32; $i++)
					{ 
						$ip=$i+1;?>
					<tr id="row<?php echo $i; ?>" hidden="true">
						<td>
							<strong><?php echo $i; ?></strong>
						</td>
						<td>
							<input type="text" name="d2lid<?php echo $i; ?>">
						</td>
						<td>
							<input type="text" name="firstname<?php echo $i; ?>">
						</td>
						<td>
							<input type="text" name="lastname<?php echo $i; ?>">
						</td>
						<td>
							<input type="text" name="email<?php echo $i; ?>" 
							<?php
								if($i!=32)
								{ ?>
									onChange="ottno(<?php echo $ip; ?>)"
							<?php } ?>>
							
						</td>
					</tr>
			<?php 	}
						
			?>
		</table>
	</form>
<?php } ?>
<?php if(isset($_GET['complete'])&&$_GET['complete']=='true'){?>
	<h1>
		You did it!! echo out class role
	</h1>
<?php } 
	if(isset($_GET['complete'])&&$_GET['complete']=='true'){?>
	<h1>
		The upload failed... contact the system admin.
	</h1>
<?php } ?>
</body>
</html>


