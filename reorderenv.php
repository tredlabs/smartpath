<?php


require 'db.php';


   if(isset($_POST["sql"])){
 	$sql2 =$_POST["sql"]; 
		
$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
		
		// Create connection to database
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
		
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
				   
				
				if($type=="Envelope"){  
			
			 if(($item=="BTCJa" && $small<$reorderlevel) || ($item=="SagicorJa" && $small<$reorderlevel) ||($item=="UnicomerJa"&& $small<$reorderlevel) ||($item=="LuckyJa" && $small<$reorderlevel)||($item=="SSLJa" && $small<$reorderlevel)||($item=="JaG" && $small<$reorderlevel)||($item=="JaR"&& $small<$reorderlevel)||($item=="Turks"&& $small<$reorderlevel)||($item=="Cayman"&& $small<$reorderlevel)||($item=="Jamaica"&& $small<$reorderlevel)||($item=="Ja"&& $small<$reorderlevel)||($item=="Aruba"&& $small<$reorderlevel)||($item=="Bonaire"&& $small<$reorderlevel)||($item=="Curacao"&& $small<$reorderlevel)||($item=="Digicay"&& $small<$reorderlevel)||($item=="Bahamas"&& $small<$reorderlevel)||($item=="Belize"&& $small<$reorderlevel)||($item=="ScotiaCay"&& $small<$reorderlevel)){
				
				echo "$type $name $item sml env is below Reorder Level: $reorderlevel Instock: $small  \n \n";
			}
			 
			  if(($item=="Turks" && $large<$reorderlevel1)||($item=="Cayman" && $large<$reorderlevel1)||($item=="Jamaica" && $large<$reorderlevel1)||($item=="Ja" && $large<$reorderlevel1)||($item=="Aruba" && $large<$reorderlevel1)||($item=="Bonaire" && $large<$reorderlevel1)||($item=="Curacao" && $large<$reorderlevel1)||($item=="Digicay" && $large<$reorderlevel1)||($item=="Bahamas" && $large<$reorderlevel1)||($item=="Belize" && $large<$reorderlevel1)||($item=="ScotiaCay" && $large<$reorderlevel1)){ 
				
				echo "$type $name $item lrg env is below Reorder Level:$reorderlevel1 Instock: $large  \n \n";
			}
			 }
			
			}
			
			
		}
		
		
		
	}
 



 	  if(isset($_POST["sid"])){
 	$sid =$_POST["sid"]; 	
 	  	
		$sql = "SELECT * FROM stocks, fields.name as type INNER JOIN fields ON stocks.field_id=fields.id WHERE stocks.id=$sid";


$result = $mysqli->query($sql);
if(mysqli_num_rows($result) > 0)  
 {

	
     while($row = mysqli_fetch_assoc($result)) {
       
		 $name=$row["name"];
		 $item=$row["p1"];
		$field_id=$row["field_id"];
		$type=$row["type"];
 
 }

 } 
 

	  if(($field_id==5) && ($item=='75gms')|| ($item=='80gms')){
	  		$instock=0;
		  $reorder=0;
	  	$sql = "SELECT * FROM stocks WHERE p1='$item'  ";
		  
		  	  $result = $mysqli->query($sql);
if(mysqli_num_rows($result) > 0)  
 {

	if($item=="75gms"){
     while($row = mysqli_fetch_assoc($result)) {
	 $instock=$row["instock"];
	 $reorder=$row["reorderlevel"];
	
 
	  }
 
 }
 
 	if($item=="80gms"){
     while($row = mysqli_fetch_assoc($result)) {
	 $instock=$row["instock"];
	 $reorder=$row["reorderlevel"];
	 $name=$row["name"];
	$item=$row["p1"];
 	
	  }

 }
 
 
 
 if($instock<$reorder){
 	echo"Please restock $type $name $item in  Inventory Instock: $instock";
 } 
		  
		
	  }
	 	  	
	  }
	  
	  
	  
	   if(($field_id==6) || ($item=='SagicorJa')|| ($item=='UnicomerJa')|| ($item=='LuckyJa')|| ($item=='BTCJa')|| ($item=='SSLJa')|| ($item=='JaG')|| ($item=='JaR')){
	  		$instock=0;
		  $reorder=0;
	  	$sql = "SELECT stocks.* ,fields.name as type FROM stocks INNER JOIN fields ON stocks.field_id=fields.id WHERE stocks.id='$sid'  ";
		  
		  	  $result = $mysqli->query($sql);
if(mysqli_num_rows($result) > 0)  
 {


     while($row = mysqli_fetch_assoc($result)) {
	 $instock=$row["instock"];
     $name=$row["name"];
	 $reorder=$row["reorderlevel"];
	 $type=$row["type"];
	
 
	  }

 if($instock<$reorder){
 	echo"Please restock $type $name $item in  Inventory Instock: $instock";
 }

	  }
	 	  	
	  }
else{
			
		$small=0;
	    $large=0;
		  $reorder=0;
	  	$sql = "SELECT stocks.* ,fields.name as type FROM stocks INNER JOIN fields ON stocks.field_id=fields.id WHERE stocks.id='$sid'  ";		
		if(mysqli_num_rows($result) > 0)  
 {


     while($row = mysqli_fetch_assoc($result)) {
	 $small=$row["small"];
	 $large=$row["large"];
	  $reorder=$row["reorderlevel"];
	 $reorder1=$row["reorderlevel1"];
	 $type=$row["type"];
	  $name=$row["name"];
	
 
	  }

 if($large<$reorder1){
 	echo"Please restock large $type $name $item in  Inventory Instock: $instock";
 }
	 if($small<$reorder){
 	echo"Please restock small env $type $name $item in  Inventory Instock: $instock";
 }	
	  }
	
	
}
	  
	  
	  
	  }
/*if(($field_id==6) && ($item=='Turks')|| ($item=='Cayman')|| ($item=='Jamaica')|| ($item=='BTCJa')|| ($item=='SSLJa')){
	  		$instock=0;
		  $reorder=0;
	  	$sql = "SELECT stocks.* ,fields.name as type FROM stocks INNER JOIN fields ON stocks.field_id=fields.id WHERE stocks.id='$sid'  ";
		  
		  	  $result = $mysqli->query($sql);
if(mysqli_num_rows($result) > 0)  
 {


     while($row = mysqli_fetch_assoc($result)) {
	 $instock=$row["instock"];
	 $reorder=$row["reorderlevel"];
	 $type=$row["type"];
	
 
	  }


		
	  }
	 	  	
	  }*/
	  
// echo " Type: $name  Reorderlevel: $reorder    Item: $show     Instock: $instock"; 
 
 
 ?>