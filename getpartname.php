<?php
require 'db.php';

//$_POST['partid']=4;
if(isset($_POST["partid"])){
    //Get all part name data
    $sql="SELECT*FROM stocks WHERE field_id=".$_POST['partid'];
	$result = $mysqli->query($sql);
    
    //Count total number of rows
    $rowCount = $result->num_rows;
    
    //Display part list
    if($rowCount > 0){
        echo '<option value="">Select Part</option>';
        while($row = mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['p1'].'">'.$row['name'].'</option>';
        }
    }else{
        echo '<option value="">Part not available</option>';
    }
}
else{
	echo '<option value="">Not available</option>';
}
?>