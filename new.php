<?php

			

if (isset($_POST['btnSubmit1'])) {  //If form was submitted

	
	require 'db.php'; // loading the database


	
	if ($_POST['name']) { //Check if user has actually added additional items to prevent a php error
		
		
		$invoice=$_POST['invoice_no'];	
	    $type=$_POST['type'];	
		$name=$_POST['name'];
		$qty=$_POST['qty'];
		$unit_price=$_POST['unitprice'];
		$total=$_POST['total'];
		
	
		$max = sizeof($name);
        for ($i=0; $i<$max; $i++) {
		$ty=$type[$i];		
		$na=$name[$i];	
		$qt=$qty[$i];
		$up=$unit_price[$i];
		$up= (double)$up; //converting the array value to a double
		$to=$total[$i];
		$to=(double)$to; //converting the array value to a double
		  
	
	$sql = "INSERT INTO receivals1(invoice_no,date,type,name,quantity,unit_price,total) VALUES('".$_POST["invoice_no"]."', '".$_POST["date"]."', '".$ty."', '".$na."', '".$qt."', '".$up."', '".$to."')"; //storing the value from the user into the database 
	$result = mysqli_real_query($mysqli,$sql); #$mysqli->query($sql);
	
#var_dump($sql); //display query to database
	
}
		
	
		
		
	} else {
	

		
	}
	echo "<h1> Added, <strong>" . count($_POST['name']) . "</strong></h1>";
	
	//disconnect mysql connection
	
}
?>