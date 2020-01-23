<?php

       $db_servername = "localhost";
		$db_username = "volta9l5_coding";   
		$db_password = "S3@nmichael1!";
		$db_name =  "volta9l5_crayfishwendaze";
   

$con1 = mysqli_connect($db_servername, $db_username, $db_password, $db_name);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>