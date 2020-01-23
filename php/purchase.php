<?php
session_start();
//save.php code

//Show the image
$pnumber=$_POST['pnumber'];
$x="PO-" . $pnumber . ".png";
//echo '<img src="'.$_POST['img_val'].'" />';
 
//Get the base-64 string from data
$filteredData=substr($_POST['img_val'], strpos($_POST['img_val'], ",")+1);
 
//Decode the string
$unencodedData=base64_decode($filteredData);

//Save the image
file_put_contents($x, $unencodedData);

rename($x, 'Purchase Orders/'.$x);

$to = 'romainewhyte001@gmail.com';
$subject='Purchase Order';

$date=$_POST['pdate'];
$type=$_POST['type'];
$stock=$_POST['partname'];
$partnum=$_POST['partnumber'];

$message = "<h3>Purchase Order ".$pnumber."</h3>\r\n<h4>Purchase Date: ".$date."</h4>\r\n<h4>Type: ".$type."</h4>\r\n<h4>Part Name: ".$stock."</h4>\r\n<h4>Part Number: ".$partnum."</h4>\r\n";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70, "\r\n");

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1';

// Additional headers


// Send
mail($to, $subject, $message, $headers);

require_once('db.php');
$sql = "INSERT INTO purchaseorder (purchasenumber,purchasedate,type,stock,partnumber)
VALUES ('$pnumber', '$date', '$type','$stock','$partnum')";
 $og=$_SESSION['orgnum'];
if ($conn->query($sql) === TRUE) {

 
 header('Location: http://ssjlinventory.com/NewSite/orders.php');


} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();





?>