<?php
error_reporting(0);
/*

Author URL: http:/www.tredlabs.com

*/
if(isset($_POST['create']))
{
require_once('db.php');
session_start();

$field=$_SESSION['name'];
$tbox=5000;
$totalsingles=0;
$name0=$_POST['name'];
$name1=$_POST['name1'];
$name2=$_POST['name2'];
$name3=$_POST['name3'];
$box=$_POST['box'];
$single=$_POST['singles'];
$name6=$_POST['name6'];
$small=$_POST['small'];
$large=$_POST['large'];
$sheet1=$_POST['sheet1'];
$sheet2=$_POST['sheet2'];
$totalenvelope=$small+$large;
$totalsheet=$sheet1+$sheet2;
$totalsingles=$single+($box*$tbox); //this calculation add the singles plus boxes that was put from the form
$instock=$_POST['instock'];
$instock+=$totalsingles;// add the total singles to the stock
$instock+=$totalenvelope;
$instock+=$totalsheet;
$reorder=$_POST['reorder'];
//$type=$_POST['type'];
$price=$_POST['price'];

/*
echo $name0;
echo $name1;

echo $instock;
echo $reorder;
echo $price;
*/
   



$selectsql ="SELECT * FROM fields WHERE name='$field'";

$result = $conn->query($selectsql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$fieldid= $row["id"];
	date_default_timezone_set("America/Jamaica");
    $date=date("Y-m-d h:i:sa");
	
	$sql = "INSERT INTO stocks(field_id, name, p1,p2,p3,box,single,p6,small,large,sheet1,sheet2,instock,reorderlevel,price,created_at)
	VALUES ('$fieldid', '$name0', '$name1','$name2','$name3','$box','$single','$name6','$small','$large','$sheet1','$sheet2','$instock','$reorder','$price','$date')";

if ($conn->query($sql) === TRUE) {
   $mess="New record created successfully";
	return $mess;
   
   header('http://localhost/login-system/createstock.php');
  
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	
	
	}
} else {
    echo "0 results";
}
	






$conn->close();









}
?>