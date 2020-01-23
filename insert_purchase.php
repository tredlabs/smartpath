<?php

			

if (isset($_POST['btnSubmit'])) {  //If form was submitted

	
	require 'db.php'; // loading the database


	
	if ($_POST['item']) { //Check if user has actually added additional items to prevent a php error
		
		
			
		$item=$_POST['item'];
		$desc=$_POST['desc'];
		$qty=$_POST['qty'];
		$rate=$_POST['rate'];
		$amount=$_POST['amount'];
	
		$max = sizeof($item);
for ($i=0; $i<$max; $i++) {
			
		$it=$item[$i];	
		$de=$desc[$i];
		$qt=$qty[$i];
		$qt= (double)$qt;  //converting the array value to a double
		$rt=$rate[$i];
		$rt=(double)$rt;
		$at=$amount[$i];
		$at = (double)$at;
	$sql = "INSERT INTO purchase_order(purchase_no,date,vendor,shipto,item,description,quantity,rate,amount) VALUES('".$_POST["partno"]."', '".$_POST["date"]."', '".$_POST["vendoradd"]."', '".$_POST["shiptoadd"]."', '".$it."', '".$de."', '".$qt."', '".$rt."', '".$at."')"; //storing the value from the user into the database 
	$result = $mysqli->query($sql);
	

	
}
		
	
		
		
	} else {
	

		
	}
	echo "<h1> Added, <strong>" . count($_POST['item']) . "</strong></h1>";
	
	//disconnect mysql connection
	
}
?>