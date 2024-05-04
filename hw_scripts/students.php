<!DOCTYPE html> 
	<body>  
	<table align = "left" border = "1" cellpadding = "3" cellspacing = "0">  
	<tr>  
		<td>Id</td>  
		<td>First name</td>  
		<td>Second name</td>   
		<td>DOB</td>  
		<td>House</td>  
		<td>Town</td>   
		<td>County</td>  
		<td>Country</td>  
		<td>Postcode</td>
	</tr>  
	<?php
		// echo "hello world";
		// echo nl2br(" ");
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

		// echo nl2br(" \n");
		$sql = "SELECT studentid,dob,firstname,lastname,house,town,county,country,postcode FROM student";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
			echo "<tr>";
		  while($row = $result->fetch_assoc()) {
		  	echo '<td>'.$row["studentid"].'</td><td>'.$row["firstname"].'</td><td>'.$row["lastname"].'</td><td>'.$row["dob"].'</td><td>'.$row["house"].'</td><td>'.$row["town"].'</td><td>'.$row["county"].'</td><td>'.$row["country"].'</td><td>'.$row["postcode"].'</td>';
		    //echo "id: " . $row["studentid"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
		    echo "</tr>";
		  }

		} else {
		  echo "0 results";
		}
	?>