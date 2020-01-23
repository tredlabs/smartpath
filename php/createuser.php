<?php
/*
Imani Sterling

*/
if(isset($_POST['createuser']))
{
require_once('db.php');


$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['cpassword'];
$role=$_POST['role'];


$pass=md5($password);

$sql = "INSERT INTO users (username, email, encrypted_password)
VALUES ('$username', '$email', '$pass')";

$sql2 = "INSERT INTO users_roles (role_id, user_email)
VALUES ('$role', '$email')";


if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
    header("Location: ../adminpanel/panel.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}







$conn->close();


}
?>