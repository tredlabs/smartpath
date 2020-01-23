<?php
require 'db.php';
 if (isset($_POST["addNewRow"])) {
	$sql ="SELECT * FROM fields ";
	$result = $mysqli->query($sql);
	
	

?>
  <option value="" disabled selected>Select Item</option>
     <?php
    
     foreach ($result as $row) {
     	?>
     	
     		<option value="<?php echo $row['id']; ?>"><?php echo $row["name"]; ?></option>
     	<?php
     }
   
 }