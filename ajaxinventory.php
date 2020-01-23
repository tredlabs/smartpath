<?php  

require 'db.php';
$check="Inserter";

	
		//$field_id=4;
	$sql =("SELECT * FROM stocks ");
	$result = $mysqli->query($sql);
 $data=array();
	   while($row=mysqli_fetch_array($result)){
	   	$data[]=array(
		'partname'=>$row['name'],
		'partid'=>$row['p1']
		
		
		);
		
	   }
	header("Content-Type: application/json");
	echo json_encode($data);
	/*
	$i=0;	
	$jsonData='{';
	while($row = mysqli_fetch_array($result)) {
		$i++;
	$partnumber=$row['p1'];
	$name=$row['name'];
 
	
	$jsonData.='"Display'.$i.'":{"partnumber":"'.$p1.'","name":"'.$name.'"},';
	
}	
	$jsonData=chop($jsonData, ",");
	
$jsonData.='}';
	echo $jsonData;
	
} 

                    
	
	?>

	
	