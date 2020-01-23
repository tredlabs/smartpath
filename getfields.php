<?php
require 'db.php';
 if (isset($_POST["addNewRow"])) {
	$sql ="SELECT * FROM fields ";
	$result = $mysqli->query($sql);
	
	

?>
 

     <tr>
        <td><b class="number"></b></td>
        <td>
        <select id="pname" name="pname[]" class="form-control form-control-sm pname"onChange="get_partname();" >
        <option value="0">Select Item</option>
     <?php
     foreach ($result as $row) {
     	?>
     		<option value="<?php echo $row['id']; ?>"><?php echo $row["name"]; ?></option>
     	<?php
     }
   
 }