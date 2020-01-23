<?php

       	 $db_servername = "localhost";
		$db_username = "dert1_path";
		$db_password = "smartpath2000";
		$db_name =  "dert1_smartpath";


// Create connection
$mysqli = mysqli_connect($db_servername, $db_username, $db_password, $db_name);
$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>