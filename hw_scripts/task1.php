

<?php
  require '../vendor/autoload.php';

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
  echo nl2br("\n \n\n");

  // use the factory to create a Faker\Generator instance
  $faker = Faker\Factory::create();
  // generate data by calling methods
  // echo $faker->name();
  // echo $faker->randomNumber(5);

  $max50 = function($string) {
      return mb_strlen($string) <= 49;
  };

  for($i = 0; $i < 5; $i++) {
    $studentFirstName = mysqli_real_escape_string($conn,$faker->firstName());
    $studentLastName = mysqli_real_escape_string($conn,$faker->lastName());
    $studentId = $faker->randomNumber(5);
    $studentDob = $faker->dateTimeBetween('1990-01-01', '2009-12-31')
      ->format('Y-m-d');
    $studentHouse = $faker->streetAddress();
    $studentTown = $faker->city();
    $studentCounty = $faker->state();
    $studentCountry = $faker->country();
    $studentPostcode = $faker->postcode();
    $studentPassword = $faker->regexify('[A-Za-z0-9]{20}');
     echo $studentPassword." ". $studentFirstName . " " . $studentLastName . " " . $studentId . " " . $studentDob . " " . $studentHouse . " " . $studentTown . " " . $studentCounty . " " . $studentCountry . " " . $studentPostcode . " ";

    $sql = "INSERT INTO student(studentid,password,dob,firstname,lastname,house,town,county,country,postcode) VALUES ('$studentId','$studentPassword','$studentDob','$studentFirstName','$studentLastName','$studentHouse','$studentTown','$studentCounty','$studentCountry','$studentPostcode')";

    //echo $sql;
    

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully ";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    echo nl2br("\n \n\n");

  }

  


  
?>