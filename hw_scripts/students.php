<!DOCTYPE html> 
	<body> 
	<head>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<title>Student records</title>
		<?php
			
			$servername = "localhost";
			$username = "root";
		  	$password = "";
		  	$database = "oss-cw2";

		  // Create connection
		  	$conn = new mysqli($servername, $username, $password, $database);

		  // Check connection
			if ($conn->connect_error) {
		    	die("Connection failed: " . $conn->connect_error);
			}else{
				//echo "Connected successfully";
			}
			$countTemporaryRecord = 0;
			$sql = "SELECT studentid,dob,firstname,lastname,house,town,county,country,postcode FROM student";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				
				while($row = $result->fetch_assoc()) {
					$countTemporaryRecord++;
				}
			}
			//echo $countTemporaryRecord;
			$arrayOfCheckBox=[];
			$arrayOfStudentId=[];
			$arrayOfStudentName=[];

			

			function alert($msg) {
		    	echo "<script type='text/javascript'>alert('$msg');</script>";
			}

			function deleteUser($studentId,$conn){
				$sql = "DELETE FROM student WHERE studentid=$studentId;";
				//$result = $conn->query($sql);
				echo $sql;
				if ($conn->query($sql) === TRUE) {
				  echo "User deleted successfully";
				} else {
				  echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}

			function yesNoDialog($msg,$studentId){
				echo "<script type='text/javascript'>if(window.confirm('$msg')){
					
				}else{}</script>";
			}
			// function abc($msg){
			// 	.$msg);
			// }

			if($_SERVER['REQUEST_METHOD'] == "POST"){
				for ($countTemporary=0;$countTemporary<$countTemporaryRecord;$countTemporary++){
					echo nl2br(" ");
					if(isset($_POST["checkbox".($countTemporary+1)])){
						$arrayOfCheckBox[$countTemporary] = $_POST["checkbox".($countTemporary+1)];
					}else{
						$arrayOfCheckBox[$countTemporary]="off";
					}	
					$arrayOfStudentId[$countTemporary]= $_POST['student_id'.($countTemporary+1)];
					$arrayOfStudentName[$countTemporary]= $_POST['student_name_'.($countTemporary+1)];
					//echo $arrayOfStudentId[$countTemporary];
				}
				echo nl2br("\n");
				// for ($countTemporary=0;$countTemporary<$countTemporaryRecord;$countTemporary++){
				// 	echo $arrayOfCheckBox[$countTemporary];
				// }
				// echo nl2br(" ");
				$hasOneSelection = false;
				$selectedCount = 0;
				for ($countTemporary=0;$countTemporary<$countTemporaryRecord;$countTemporary++){
					// echo $arrayOfCheckBox[$countTemporary]." ";
					// echo $hasOneSelection ? 'true' : 'false';
					// echo nl2br(" \n");
					if($arrayOfCheckBox[$countTemporary]=="on"){
						if($hasOneSelection==true){
							//echo "came here once";
							//echo "<script type='text/javascript'>alert('Cant select two record at once. Please try again.');</script>";
							alert('Cant select two record at once. Please try again.');
							break;
						}else{
							$hasOneSelection=true;
							$selectedCount=$countTemporary;
							//echo $selectedCount;
						}
					}
					if($countTemporary==($countTemporaryRecord-1)){
						if($hasOneSelection==false){
							alert('Nothing selected. Please try again.');
						}else{
							echo "selected Student name is : ".$arrayOfStudentName[$selectedCount];
							$messageToShow = "You are about to delete user ".$arrayOfStudentName[$selectedCount];
							alert($messageToShow);
							deleteUser($arrayOfStudentId[$selectedCount],$conn);
						}
						
					}
				}
				
			}
			

		?>
	</head> 
	<form action="students.php" method="POST">
	<table class="table" align = "left" border = "1" cellpadding = "3" cellspacing = "0">  
	<thead><tr class="success">  
		<th>Id</th>  
		<th>First name</th>
		<th>Second name</th>
		<th>DOB</th>
		<th>House</th>
		<th>Town</th>
		<th>County</th>
		<th>Country</th>
		<th>Postcode</th>
		<th>Profile Picture</th>
		<th>Select record</th>
	</tr>  
	</thead>
	<?php
		// echo nl2br(" \n");
		$sql = "SELECT studentid,dob,firstname,lastname,house,town,county,country,postcode,profile_picture FROM student";
		$result = $conn->query($sql);


		if ($result->num_rows > 0) {
		  // output data of each row
			echo "<tbody>";

			$countOfRecords=0;
		  while($row = $result->fetch_assoc()) {
		  	$arrayOfSelectedRecord[$countOfRecords]=false;
		  	echo '<tr><td>'.$row["studentid"].'</td><td>'.$row["firstname"].'</td><td>'.$row["lastname"].'</td><td>'.$row["dob"].'</td><td>'.$row["house"].'</td><td>'.$row["town"].'</td><td>'.$row["county"].'</td><td>'.$row["country"].'</td><td>'.$row["postcode"].'</td>';
		  	echo '<td><img src="data:image/jpeg;base64,'.base64_encode($row['profile_picture']).'" height="50" width="50"/></td>';
		    //echo "id: " . $row["studentid"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
		    echo '<td>'.'<div><input type="checkbox" name="'.'checkbox'.strval($countOfRecords+1).'" /></div>';
		    echo'</td><input type="hidden" name="student_id'.($countOfRecords+1).'" value="'.$row["studentid"].'"/>';
		    echo'</td><input type="hidden" name="student_name_'.($countOfRecords+1).'" value="'.$row["firstname"]." ".$row["lastname"].'"/>';
		    echo '</tr>';
		    $countOfRecords++;
		  }
		  echo '</tbody></table>';
		  echo '<input type="submit" value="delete" /></form>';
		} else {
		  echo "0 results";
		}
	?>