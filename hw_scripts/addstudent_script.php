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
		echo "Connected successfully";
	}

	$studentId = $_POST["student_id"];
	$studentPassword = $_POST["student_password"];
	$studentFirstName = $_POST["student_first_name"];
	$studentLastName = $_POST["student_last_name"];
	$studentDOB = $_POST["student_dob"];
	$studentHouse = $_POST["student_house"];
	$studentTown = $_POST["student_town"];
	$studentCounty = $_POST["student_county"];
	$studentCountry = $_POST["student_country"];
	$studentPostCode = $_POST["student_postcode"];
	$studentImage = $_FILES["student_image"]["tmp_name"];
	$imagedata = addslashes(fread(fopen($studentImage, "r"), filesize($studentImage)));


	$sql = "INSERT INTO student (studentid,password,dob,firstname,lastname,house,town,county,country,postcode,profile_picture) VALUES ($studentId,'$studentPassword',str_to_date('$studentDOB','%d-%m-%Y'),'$studentFirstName','$studentLastName','$studentHouse','$studentTown','$studentCounty','$studentCountry','$studentPostCode','$imagedata')";
	//echo $sql;
	//$result = $conn->query($sql);

	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}

	// if(){
	// 	echo "cannot leave form empty";
	// }

?>