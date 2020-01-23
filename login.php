<?php

/* User login process, checks if user exists and password is correct */

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ssjlinve_inventorysystem";

// Create connection
$mysqli = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }// Escape email to protect against SQL injections



$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ($_POST['username']== $user['username']) {
        
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['username'];
      $_SESSION['userid'] = $user['id'];
        $_SESSION['active'] = $user['active'];
     
        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: profile.php");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}

