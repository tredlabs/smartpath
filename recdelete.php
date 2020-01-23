<?php
require 'db.php';  // delete records from database

 $sql = "DELETE FROM receivals WHERE id = '".$_POST["id"]."'";  
 
$result = $mysqli->query($sql);
 {  
      echo 'Data Deleted From Receivals';  
 }  
 ?>