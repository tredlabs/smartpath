<?php
//session_start();
$email=$_SESSION['username'];

require_once('db.php');

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $username= $row["username"];
	
		json_encode($username);
		json_encode($id);
    }
	
	
	
	
	
	
} else {
    echo "0 results";
}

$sql2 = "SELECT role_id FROM users_roles WHERE user_email='$email'";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    // output data of each row
    while($row2 = $result2->fetch_assoc()) {
        $role= $row2["role_id"];
		
		$_SESSION['role']=$role;
    }
} else {
    echo "0 results";
}


$conn->close();
?>

<div class="drop-men">
		        <ul class=" nav_1">
		           
		    		<input type="hidden" value="<?php echo $_SESSION['role']; ?>" id="userrole" name="userrole"/>
					<li class="dropdown">
		              <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class=" name-caret"><?php echo $username;?><i class="caret"></i></span><img src="images/user.png" width="70px" height="70px"></a>
		              <ul class="dropdown-menu " role="menu">
		               
		                <li><a href="php/logout.php"><i class="fa fa-clipboard"></i>Log Out</a></li>
		              </ul>
		            </li>
		           
		        </ul>
		     </div>