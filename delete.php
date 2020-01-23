<?php
require 'db.php';  // delete records from database

 $sql = "DELETE FROM stocks WHERE id = '".$_POST["id"]."'";  
 
$result = $mysqli->query($sql);
 {  
      echo 'Data Deleted';  
 }  
 ?>