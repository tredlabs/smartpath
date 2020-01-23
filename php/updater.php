<?php 
require_once('db.php');
$purchnum=$_POST['pnumber'];
$date=$_POST['date'];
$type=$_POST['type'];
$name=$_POST['partname'];
$partnum=$_POST['partnumber'];
if(isset($_POST['update'])){


$sql = "UPDATE purchaseorder SET purchasedate='$date',type='$type',stock='$name',partnumber='$partnum' WHERE purchasenumber='$purchnum'";

if (mysqli_query($conn, $sql)) {
    header("Location:../orders.php?id=".$purchnum);
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
}

if(isset($_POST['delete'])){
	$sql = "DELETE FROM purchaseorder WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location:../orders.php");
} else {
    echo "Error deleting record: " . $conn->error;
}
}
$conn->close();


?>