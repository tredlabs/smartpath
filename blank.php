<?php
date_default_timezone_set("Jamaica");

require 'db.php';
$created_at = date("Y-m-d");
 
 $sql = "SELECT path_lunch.qty,SUM(path_lunch.qty) AS value_qty FROM path_lunch WHERE created_at='$created_at'";

$result = $mysqli->query($sql);
if(mysqli_num_rows($result) > 0)  
 {
    $a=0;
    while($row = mysqli_fetch_assoc($result)) {
       $qty=$row["value_qty"];
		
		 
		
		

	

 $a++;
 // echo "<br>";
 
 }
 } 
 /*
  $show=1;  
 $sql = "SELECT * FROM Warehouse1 WHERE books='$show'";
 //$sql = "SELECT * FROM stocks";
$result = $mysqli->query($sql);
if(mysqli_num_rows($result) > 0)  
 { 
 $a=0;
    while($row = mysqli_fetch_assoc($result)) {
       
		 $instock1[$a]=$row["instock"];
		 
		 $item1[$a]=$row["name"];
		
	
	

 $a++;
 // echo "<br>";
 
 }
 } 
 */
 
 
   // this is for Paper

 
 
 
 
 ?>