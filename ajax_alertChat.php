<?php
   require 'kdb.php'; 
header("Content-Type: application/json");
$_POST['limit']=2;

if (isset($_POST['limit'])){
$limit=$_POST['limit'];	
	

$con1=mysqli_connect("localhost","volta9l5_coding","S3@nmichael1!","volta9l5_crayfishwendaze");

	$i=0;	
	$jsonData='{';
		$q="SELECT * From orders ";
		$result = mysqli_query($con1,$q);
	while($row = mysqli_fetch_array($result)) {
		$i++;
	$id=$row['id'];
	$menu=$row['menu_id'];
    $order_id=$row['order_id'];
    $user_id=$row['user_id'];
	$note=$row['note'];
	$user_date=$row['user_date'];
    $order_status=$row['order_status'];
    $order_time=$row['order_time'];
	
	$jsonData.='"Display'.$i.'":{"menu_id":"'.$menu.'","id":"'.$id.'","order_id":"'.$order_id.'","user_id":"'.$user_id.',"note":"'.$note.',"user_date":"'.$user_date.',"order_status":"'.$order_status.',"order_time":"'.$order_time.'"},';
	
}	
	$jsonData=chop($jsonData, ",");
	
$jsonData.='}';
	echo $jsonData;
	
}
   ?>

