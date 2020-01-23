<?php
/*



*/
if(isset($_POST['create']))
{
require_once('db.php');
session_start();

$field=$_SESSION['name'];

$name0=$_POST['$name0'];
$name1=$_POST['$name1'];
$name2=$_POST['$name2'];
$name3=$_POST['$name3'];
$name4=$_POST['$name4'];
$name5=$_POST['$name5'];
$name6=$_POST['$name6'];

$instock=$_POST['instock'];
$reorder=$_POST['reorder'];
$type=$_POST['type'];
$price=$_POST['price'];



$selectsql ="SELECT * FROM fields WHERE name='$field'";

$result = $conn->query($selectsql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$fieldid= $row["id"];
	date_default_timezone_set("America/Jamaica");
    $date=date("Y-m-d h:i:sa");
	
	$sql = "INSERT INTO stocks(field_id, name, p1,p2,p3,p4,p5,p6,instock,reorderlevel,stock_type,price,created_at)
	VALUES ('$fieldid', '$name0', '$name1','$name2','$name3','$name4','$name5','$name6','$instock','$reorder','$type','$price','$date')";

if ($conn->query($sql) === TRUE) {
   // echo "New record created successfully";
   
   header('Location: http://ssjlinventory.com/NewSite/createstock.php');
  
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