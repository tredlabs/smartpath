<?php 

require_once('db.php');
$id=$_POST['fieldid'];
$name=$_POST['name0'];
$name1=$_POST['name1'];
$name2=$_POST['name2'];
$name3=$_POST['name3'];
$name4=$_POST['name4'];
$name5=$_POST['name5'];
$name6=$_POST['name6'];

if(isset($_POST['update'])){

date_default_timezone_set("America/Jamaica");
$date=date("Y-m-d h:i:sa");

$sql = "UPDATE fields SET name='$name',name1='$name1',name2='$name2',name3='$name3',name4='$name4',name5='$name5',name6='$name6',updated_at='$date' WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
     header("Location:../categories.php?id=".$id);

} else {
    echo "Error updating record: " . mysqli_error($conn);
}

}


if(isset($_POST['delete'])){
$sql = "DELETE FROM fields WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location:../categories.php");
} else {
    echo "Error deleting record: " . $conn->error;
}	
}
$conn->close();


?>