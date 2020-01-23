<?php
include('../php/db.php');
$email=$_POST['email'];
$password=$_POST['password'];
$pass=md5($password);

$sql = "SELECT * FROM users WHERE email='$email' AND encrypted_password='$pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
	$uemail= $row["email"];

	$sql2 = "SELECT * FROM users_roles WHERE user_email='$uemail'";
	$result2 = $conn->query($sql2);
	if ($result2->num_rows > 0) {
	// output data of each row
	while($row2 = $result2->fetch_assoc()) {
		$role= $row2["role_id"];
	
		if($role==1){
		header("Location:panel.php");
		}else{
			echo "Only admins are allowed in this section...Redirecting";
			echo "<meta http-equiv='refresh' content='5;url=../login.php'>";
		}
					}
	} else {
		//echo "10 results";
	}

}
} else {
	
echo "Login Failed...Redirecting in 5 secs";

			echo "<meta http-equiv='refresh' content='5;url=index.php'>";
}
$conn->close();
?>