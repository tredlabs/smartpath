<?php

require 'db.php';

include 'blank.php';

session_start();

error_reporting(E_ALL & ~E_NOTICE);

$dir="";
require_once($dir."classes/Session_Manager.php");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();



    $username = $_SESSION['username'];
	   $name = $_SESSION['name'];

            
					$Session_Manager = new Session_Manager();
					$sid = $Session_Manager->get_custom_SID();
				    $role = $_SESSION[$sid]['role'];
					 $name = $_SESSION[$sid]['name'];
				

if($logged)
{
	
	
}






require 'db.php';
$conn = new mysqli($servername, $username, $password, $dbname);




$sql="SELECT * FROM users WHERE username='$name'";


$result = $conn->query($sql);
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
											
			$userid= $row["id"];									
									
									
											
			}
		}
												
										

$details= "Would like to delete an item";

$sql="INSERT INTO notifications(details,receiver,sender) VALUES('$details','1','$userid')";
$result1= mysqli_real_query($conn,$sql);


if($result1)
{
	echo "Process worked!!!!!!!!";
}
?>