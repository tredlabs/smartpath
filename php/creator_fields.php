<?php
/*
Author: Romaine Whyte
Co-Author: Gavin Palmer
Author URL: http:/www.tredlabs.com

*/
if(isset($_POST['save'])){
require_once('db.php');
session_start();

$field=$_SESSION['name'];
$id=$_POST['fieldid'];
$name=$_POST['name0'];
$name1=$_POST['name1'];
$name2=$_POST['name2'];
$name3=$_POST['name3'];
$name4=$_POST['name4'];
$name5=$_POST['name5'];
$name6=$_POST['name6'];

    
	
	date_default_timezone_set("America/Jamaica");
    $date=date("Y-m-d h:i:sa");
	
	$sql = "INSERT INTO fields(id, name, name1,name2,name3,name4,name5,name6,created_at)
	VALUES ('$id','$name','$name1','$name2','$name3','$name4','$name5','$name6','$date')";

if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
   //echo $id.$name;
   header('Location: ../categories.php?id='.$id);
  
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	







$conn->close();






}



?>