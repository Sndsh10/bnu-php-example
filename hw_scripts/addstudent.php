<!DOCTYPE html> 
	<head>
		<title></title>
	</head>
	<body>
		<h2>Add new student</h2>
		<form enctype="multipart/form-data" method="post" action="addstudent_script.php">
			<label> Enter student id </label>
			<input type="number" name="student_id"/><br/><br/>
			<label> Enter password </label>
			<input type="password" name="student_password"/><br/><br/>
			<label> Enter first name </label>
			<input type="text" name="student_first_name"/><br/><br/>
			<label> Enter last name </label>
			<input type="text" name="student_last_name"/><br/><br/>
			<label> Enter DOB </label>
			<input type="text" name="student_dob"/><br/><br/>
			<label> Enter house </label>
			<input type="text" name="student_house"/><br/><br/>
			<label> Enter town </label>
			<input type="text" name="student_town"/><br/><br/>
			<label> Enter County </label>
			<input type="text" name="student_county"/><br/><br/>
			<label> Enter Country </label>
			<input type="text" name="student_country"/><br/><br/>
			<label> Enter postcode </label>
			<input type="text" name="student_postcode"/><br/><br/>
			<label> Upload profile picture </label>
			<input type="file" name="student_image" accept="image/jpeg"/><br/><br/>
			<input type="submit"/>
		</form>
	</body>
</html>