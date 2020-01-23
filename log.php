
<?php



//$username=$_POST['username']; //assign form user input to variable
//$email=$_POST['email'];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ssjlinve_inventorysystem";

// Create connection
$con = mysqli_connect($servername,$username,$password,$dbname);

// Check connection
if ($con){
	echo "working";
	} else
  {
  echo "Failed to connect to MySQL";
  }


?>
