<?php  
require 'db.php';  // delete records from databaseid = $_POST["id"];  
 $text = $_POST["text"];  
 $id = $_POST["id"];
 $column_name = $_POST["column_name"];  
 $sql = "UPDATE price SET ".$column_name."='".$text."' WHERE id='".$id."'";  
$result = $mysqli->query($sql);
 {  
     // echo 'Data Updated';  
 }  
 ?>