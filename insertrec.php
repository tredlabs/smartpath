<?php  
require 'db.php';

 $sql = "INSERT INTO receivals (invoice_number,recdate,created_at) VALUES('".$_POST["invoice_number"]."', '".$_POST["recdate"]."', '".$_POST["created_at"]."')";  
$result = $mysqli->query($sql);
 
 {  
      echo 'Data Inserted into Receivals';  
 }  
 ?> 