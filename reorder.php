<?php


require 'db.php';





   if(isset($_POST["sql"])){
 	$sql2 =$_POST["sql"]; 
		

		
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
			$result = $conn->query($sql2);
				if ($result->num_rows > 0)
		{	
		while($row = $result->fetch_assoc())
			{
				
				 $instock=$row["instock"];
			     $reorderlevel=$row["reorderlevel"];
				
				 $name=$row['name'];
				
				 $type=$row['type'];
				
				   
				
				 if($type==$type  && $instock<$reorderlevel )
				 {
				 	echo "$type $name is below Reorder Level. Instock: $instock  \n";
				 }
			

			}	
		}	
	}
   
   if(isset($_POST["sql1"])){
 	$sql2 =$_POST["sql1"]; 
		

		
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
			$result = $conn->query($sql2);
				if ($result->num_rows > 0)
		{	
		while($row = $result->fetch_assoc())
			{
				
				 $instock=$row["instock"];
			     $reorderlevel=$row["reorderlevel"];
				
				 $name=$row['name'];
				
				 $type=$row['type'];
				
				   
				
				 if($type==$type  && $instock<$reorderlevel )
				 {
				 	echo "$type $name is below Reorder Level. Instock: $instock  \n";
				 }
			

			}	
		}	
	}
   
   
   if(isset($_POST["sql2"])){
 	$sql2 =$_POST["sql2"]; 
		

		
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
			$result = $conn->query($sql2);
				if ($result->num_rows > 0)
		{	
		while($row = $result->fetch_assoc())
			{
				
				 $instock=$row["instock"];
			     $reorderlevel=$row["reorderlevel"];
				
				 $name=$row['name'];
				
				 $type=$row['type'];
				
				   
				
				 if($type==$type  && $instock<$reorderlevel )
				 {
				 	echo "$type $name is below Reorder Level. Instock: $instock  \n";
				 }
			

			}	
		}	
	}
   
   
 	  if(isset($_POST["sid"])){
 	$sid =$_POST["sid"]; 
	$location =$_POST["loc"]; 	
 	  	
		$sql = "SELECT $location.instock, $location.name,$location.type,$location.reorderlevel FROM $location  WHERE $location.id=$sid";


$result = $mysqli->query($sql);
if ($result->num_rows > 0)
 {
	while($row = $result->fetch_assoc())
			{
				
				 $instock=$row["instock"];
			     $reorderlevel=$row["reorderlevel"];
				
				 $name=$row['name'];
				
				 $type=$row['type'];
				
				   
				
				 if($type==$type  && $instock<$reorderlevel )
				 {
				 	echo "$type $name is below Reorder Level. Instock: $instock  \n";
				 }
			}
 }
	  }
	  
	    if(isset($_POST["location"])){
 	$uid =$_POST["location"]; 
	
 	  $sql = "SELECT usage_lineitems.location,usage_lineitems.stock_id FROM usage_lineitems   
 	  WHERE usage_lineitems.id=$uid";
	  
	  $result = $mysqli->query($sql);
if ($result->num_rows > 0)
 {
 	
	while($row = $result->fetch_assoc())
			{
				 $location=$row['location'];
				
			}
 }
	  	echo "$location";	
	  }
	  
	  
  if(isset($_POST["id"])){
 	$uid =$_POST["id"]; 
	
 	  $sql = "SELECT usage_lineitems.location,usage_lineitems.stock_id FROM usage_lineitems   
 	  WHERE usage_lineitems.id=$uid";
	  
	  $result = $mysqli->query($sql);
if ($result->num_rows > 0)
 {
 	
	while($row = $result->fetch_assoc())
			{
				 $location=$row['location'];
				 $stock_id=$row['stock_id'];
			}
 }
	  	
		$sql = "SELECT $location.instock, $location.name,$location.type,$location.reorderlevel FROM $location  WHERE $location.id=$stock_id";


$result = $mysqli->query($sql);
if ($result->num_rows > 0)
 {
 	
	while($row = $result->fetch_assoc())
			{
				
				 $instock=$row["instock"];
			     $reorderlevel=$row["reorderlevel"];
				
				 $name=$row['name'];
				
				 $type=$row['type'];
				
				   
				
				 if($instock<$reorderlevel )
				 {
				 	echo "$type $name is below Reorder Level. Instock: $instock  \n";
				 }
			}
 }
	  }


 ?>