<?php
require_once('db.php');
session_start();
$sql1 = "SELECT purchasenumber FROM purchaseorder ORDER BY purchasenumber DESC LIMIT 1";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    // output data of each row
    while($row1 = $result1->fetch_assoc()) {
        $x=$row1["purchasenumber"];
		$_SESSION['orgnum']=$x;
		$z=$x+1;
		$_SESSION['num']=$z;
	
    }
} else {
    echo "0 results";
}
$conn->close();


?>