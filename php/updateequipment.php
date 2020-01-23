<?php 

require_once('db.php');
$id=$_POST['fieldid'];
$name=$_POST['name0'];


if(isset($_POST['update'])){

date_default_timezone_set("America/Jamaica");
$date=date("Y-m-d h:i:sa");

$sql = "UPDATE equipment SET name='$name',updated_at='$date' WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
     header("Location:../equipment.php?id=".$id);

} else {
    echo "Error updating record: " . mysqli_error($conn);
}

}


if(isset($_POST['delete'])){
$sql = "DELETE FROM equipment WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location:../equipment.php");
} else {
    echo "Error deleting record: " . $conn->error;
}	
}
$conn->close();


?>