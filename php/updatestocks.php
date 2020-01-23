<?php 

require_once('db.php');
$id=$_POST['stockid'];
$fieldid=$_POST['fid'];
$p1=$_POST['p1'];
$p2=$_POST['p2'];
$p3=$_POST['p3'];
$p4=$_POST['p4'];
$p5=$_POST['p5'];
$p6=$_POST['p6'];
$ro= $_POST["ro"];
$instock= $_POST["instock"];
$created= $_POST["created"];


if(isset($_POST['update'])){

date_default_timezone_set("America/Jamaica");
$date=date("Y-m-d h:i:sa");

$sql = "UPDATE stocks SET field_id='$fieldid',reorderlevel='$ro',instock='$instock',p1='$p1',p2='$p2',p3='$p3',p4='$p4',p5='$p5',p6='$p6',created_at='$created',updated_at='$date' WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
     header("Location:../inventory.php");

} else {
    echo "Error updating record: " . mysqli_error($conn);
}

}


$conn->close();


?>