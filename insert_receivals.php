<?php

			

if (isset($_POST['btnSubmit1'])) {  //If form was submitted

	
	require 'db.php'; // loading the database


	
	if ($_POST['name']) { //Check if user has actually added additional items to prevent a php error
		
		
		$invoice=$_POST['invoice_no'];	
	$type=$_POST['type'];	
		$name=$_POST['name'];
		$qty=$_POST['qty'];
		$unit_price=$_POST['unit_price'];
		$total=$_POST['total'];
		
	
/*		$max = sizeof($name);
for ($i=0; $i<$max; $i++) {
		$ty=$type[$i];		
		$na=$name[$i];	
		$qt=$qty[$i];
		$up=$unit_price[$i];
		$up= (double)$up; //converting the array value to a double
		$to=$total[$i];
		$to=(double)$to; //converting the array value to a double
		  
		  
		  
		 
	$sql = "INSERT INTO receivals1(part_no,date,type,name,quantity,unit_price,total) VALUES('".$_POST["invoice_no"]."', '".$_POST["date"]."', '".$ty."', '".$na."', '".$qt."', '".$up."', '".$to."')"; //storing the value from the user into the database 
	$result = $mysqli->query($sql); */
		  
		  
		  foreach($_POST['name'] as $key => $value){
		  	
			$type1= $_POST['type'][$key];
		  }
	
	$sql = "INSERT INTO receivals1(part_no,date,type,name,quantity,unit_price,total) VALUES('".$_POST["invoice_no"]."', '".$_POST["date"]."', '".$ty."', '".$na."', '".$qt."', '".$up."', '".$to."')"; //storing the value from the user into the database 
	$result = $mysqli->query($sql);
	

	
/*}*/
		  
		
	
		
		
	} else {
	

		
	}
	echo "<h1> Added, <strong>" . count($_POST['name']) . "</strong></h1>";
	
	//disconnect mysql connection
	
}
?>