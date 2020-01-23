<?php  
require 'db.php';

 $sql = "INSERT INTO stocks (name,p1,instock,reorderlevel,price) VALUES('".$_POST["name"]."', '".$_POST["p1"]."', '".$_POST["instock"]."', '".$_POST["reorderlevel"]."', '".$_POST["price"]."')";  
$result = $mysqli->query($sql);
 
 {  
      echo 'Data added to the Inventory';  
 }  
 ?> 