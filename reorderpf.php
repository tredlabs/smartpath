<?php
require 'db.php';

   if(isset($_POST["sql"])){
 	$sql2 =$_POST["sql"]; 
	
	//$sql2="SELECT stocks.*,fields.name as type FROM stocks INNER JOIN fields ON stocks.field_id=10";
$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
		
		// Create connection to database
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);

		$result = $conn->query($sql2);
				if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				 $instock=$row["instock"];
			     $reorderlevel=$row["reorderlevel"];
				 $reorderlevel1=$row["reorderlevel1"];
				 $name=$row['name'];
				 $item=$row['p1'];
				 $type=$row['type'];
				  $small=$row['small'];
				  $large=$row['large'];
				   $sheet1=$row['sheet1'];
				   $sheet2=$row['sheet2'];
				   
				  if ($type=="PrintedForm"){
				
				 if(($item=="DigiPlay" && $sheet1<$reorderlevel )|| ($item=="Jam" && $sheet1<$reorderlevel)|| ($item=="Ja" && $sheet1<$reorderlevel)|| ($item=="Aruba" && $sheet1<$reorderlevel)|| ($item=="Bonaire" && $sheet1<$reorderlevel)|| ($item=="Curacao" && $sheet1<$reorderlevel)|| ($item=="DigiCay" && $sheet1<$reorderlevel))  
				 {
				 	echo "$type $name $item sheet1 is below Reorder Level:$reorderlevel1 Instock: $sheet1 \n \n";
				 }
				 
				  if(($item=="DigiPlay" && $sheet2<$reorderlevel1 )|| ($item=="Jam" && $sheet2<$reorderlevel1)|| ($item=="Ja" && $sheet2<$reorderlevel1)|| ($item=="Islands" && $sheet2<$reorderlevel1))  
				 {
				 	echo "$type $name $item sheet2 is below Reorder Level:$reorderlevel1 Instock: $sheet2 \n \n";
				 }
				
				 
			}   
				   }
			}
		}
 
 ?>