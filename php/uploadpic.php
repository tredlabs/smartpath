<?php

date_default_timezone_set("Jamaica");
session_start();
error_reporting(E_ALL-E_NOTICE);



require 'db.php';


$dir="../";
require_once($dir."classes/Session_Manager.php");

//Set the access level for th query manager -Imani Sterling|| 2018
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Update Students with pic";
$userid = $_SESSION[$sid]['userid'];

$created_at = date("Y-m-d");





$location="Students";
$name=$_POST["name"];
$dob=$_POST["dob"];
echo "$name\n";
echo "$dob\n";

$fileName = $_FILES['imgInp']['name'];
$fileType = $_FILES['imgInp']['type'];
$fileContent = file_get_contents($_FILES['imgInp']['tmp_name']);
$dataUrl = 'data:' . $fileType . ';base64,' . base64_encode($fileContent);
$json = json_encode(array(
  'name' => $fileName,
  'type' => $fileType,
  'dataUrl' => $dataUrl,

));

$imagetmp=addslashes (file_get_contents($_FILES['imgInp']['tmp_name']));


$upload_image=$_FILES['imgInp']['name'];

$folder="./stu_image/";
$img="php/stu_image/";
$pic="$img"."$fileName";

move_uploaded_file($_FILES['imgInp']['tmp_name'], "$folder".$_FILES['imgInp']['name']);



echo"Successful $pic  ";


	// Create connection to database
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		
	
	
		$sql = "UPDATE $location 
				SET pic='$pic'
				WHERE fullname='$name'";
				
				
						
		if($conn->query($sql) === TRUE)
		{
			echo "Updated Successfully\n";
			
			//Update individual line items   -Imani Sterling|| 2018
			//$id = mysqli_insert_id($conn); //Get the inserted ID for the Receival that was inserted above -Imani Sterling|| 2018
				
					
			
				}
				else
				{
					echo "Error updating: 	 ".$conn->error;
				}	
				
	      $purpose="Update Student:$name ";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$id','$purpose','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
  	$uid = mysqli_insert_id($conn);
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   
  
  
} else {
    echo "Error3: " . $sqltr . "<br>" . $conn->error;
}		
	
	
	
	
	}
	


	
?>

