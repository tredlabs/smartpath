<?php
/*
Author: Romaine Whyte
Co-Author: Gavin Palmer
Author URL: http:/www.tredlabs.com

*/
if(isset($_POST['save'])){
require_once('db.php');
session_start();


$id=$_POST['equipid'];
$name=$_POST['name0'];


    
	
	date_default_timezone_set("America/Jamaica");
    $date=date("Y-m-d h:i:sa");
	
	$sql = "INSERT INTO equipment(id, name,created_at)
	VALUES ('$id','$name','$date')";

if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
   //echo $id.$name;
   header('Location: ../equipment.php?id='.$id);
  
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	







$conn->close();






}



?>