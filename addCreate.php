<?php
date_default_timezone_set("Jamaica");
session_start();
error_reporting(E_ALL-E_NOTICE);

require 'db.php';


//Prevent direct access, via browser
defined('SSJLinventory');

//Global Variables
$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";

$dir="";
require_once($dir."classes/Session_Manager.php");

//Set the access level for th query manager -Gavin Palmer || March 2016
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();


$action="Create Stock";
$username = $_SESSION['username'];
$userid = $_SESSION[$sid]['userid'];
//echo "[".$_SESSION[$sid]['userid']."]";



	//variables
	$sql = "";

	$Type ="";
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	
			
	//Checking for the presents of the required variables  
	if(isset($_POST["type"]))
	{
		$name = $_POST["name"];
		$code = $_POST["code"];
		//$ptype = $_POST["ptype"];
		$type=$_POST["type"];
		$location = $_POST["location"]; 
		$qty = $_POST["singles"];
		$reorder = $_POST["reorder"];
		
		

	}
	

$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";				
	// Create connection to database
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
//	$fieldid=5;	

	if($type==$type){
		
		$sql ="SELECT * FROM price WHERE code ='$code'";
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$unit_cost= $row["unit_cost"];
	$size= $row["size"];
	  
	}
}
	


	$cost=$qty*$unit_cost;
	
	
	$selectsql ="SELECT * FROM fields WHERE name='$type'";

$result = $conn->query($selectsql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$fieldid= $row["id"];
	
	}
}
	
$sql = "INSERT INTO $location(field_id,code,name,type,location,instock,reorderlevel,cost,created_at)
	VALUES ('$fieldid','$code','$name','$type','$location','$qty','$reorder','$cost','$created_at')";




if ($conn->query($sql) === TRUE) {
     $mess="$type $name created successfully";
	echo $mess;
    
    $details="Item: $name Code: $code  Quantity: $qty reorder: $reorder  Cost:$ $cost Location: $location";  
		$id = mysqli_insert_id($conn);
	
		$sql1 = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','stock id: $id','$details','$updated_at')";
			
  if ($conn->query($sql1) === TRUE) {
    // $mess="Trace user  $userid ";
	//echo $mess;
     
  
  
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
  
  
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	}

else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	
	?>