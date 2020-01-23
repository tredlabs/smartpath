<?php 
require 'db.php';

 	 $db_servername = "localhost";
		$db_username = "dert1_path";
		$db_password = "smartpath2000";
		$db_name =  "dert1_smartpath";

// Create connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

$email=$_POST['email'];
$ID=$_POST['ID'];
$username=$_POST['username'];
$levels=$_POST['levels'];
$password=$_POST['password'];


$role=$_POST['rolebx'];//echo "$password" ;
if(isset($_POST['saveuser']))
{
	
$sql2="SELECT users_roles.id AS id,users_roles.role_id,users_roles.user_email, users.email, users.encrypted_password AS pass, users.username,users.id AS ID    
FROM users INNER JOIN users_roles            
ON users.email = users_roles.user_email   
 WHERE users.id = '$ID'"; 
 
 $result2=$conn->query($sql2);
 if ($result2 ->num_rows > 0) 
 {$role="";    
 while($row2 = $result2->fetch_assoc()) {
 	    $IDs= $row2["ID"];
 	    $id= $row2["id"];
        $upass= $row2["pass"];
		
 }}
 
 
 if($password==''){
	//$pass=md5($upass);
$sql = "UPDATE users SET email='$email',encrypted_password='$upass' WHERE id='$ID'";	
$sql2 = "UPDATE users_roles SET role_id='$levels',user_email='$email' WHERE id='$id'";
$result = $conn->query($sql);
	if($conn->query($sql2)===TRUE)				{ 
    header("Location:../adminpanel/panel.php?id=".$pass);


}
}
 
 
 
 
 
 
if(isset($_POST['email'])&& isset($_POST['password'])){
			
			
			if($password==$upass){
				
			$pass=	$password;
			}	else{
			$pass=md5($password);	
			}
	
$sql = "UPDATE users SET email='$email',encrypted_password='$pass' WHERE id='$ID'";	
$sql2 = "UPDATE users_roles SET role_id='$levels',user_email='$email' WHERE id='$id'";
$result = $conn->query($sql);
	if($conn->query($sql2)===TRUE)				{ 
    header("Location:../adminpanel/panel.php?id=".$username);
}

}
	



}

if(isset($_POST['deluser'])){
	$sql = "DELETE FROM users WHERE id='$ID'";
	$sql1 = "DELETE FROM users_roles WHERE user_email='$email'";

$result1 = $conn->query($sql);if($conn->query($sql1)===TRUE){	
    header("Location:../adminpanel/panel.php");
} else {
    echo "Error deleting record: " . $conn->error;
}
}
$conn->close();


?>