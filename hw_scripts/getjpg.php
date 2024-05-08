<?php

	//header("Content-type: image/jpeg");
	$servername = "127.0.0.1";
	$username = "root";
	$password = "";
	$database_name = "oss-cw2";

	// Create connection
	$conn = new mysqli($servername, $username, $password,$database_name);
	//echo $_GET['id'];

	$sql = "SELECT profile_picture,studentid FROM student WHERE studentid=".$_GET['id'];
	echo $sql;
	$result = $conn->query($sql);
	while($row = mysqli_fetch_assoc($result)){
		$jpg = $row["profile_picture"];
		echo $jpg;
	}

?>
