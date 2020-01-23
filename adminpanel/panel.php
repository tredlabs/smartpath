<?php

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Control Panel :: Smart Path LMS</title>
 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!-- Custom Theme files -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="Plans & Pricing Tables Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!--web-fonts-->
<link href='//fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
<!--web-fonts-->

</head>
<body>
			<div class="main">
			<!--<a href="logout.php"><h1 style="margin-left:1030px;">Logout</h1></a>-->
				<div class="login">
					
					<div class="login-top">
						<img src="images/p.png">
					
					</div>
					
					<h1>Control Panel</h1>
					<div class="login-bottom">
						<center><input type="submit" style="display:inline;" value="Add User" id="adduserbtn"/> <input type="submit" style="display:inline;" value="Edit User" id="edituserbtn"/>
						</center>
					<hr>
					</div>
<div id="adduser" class="login-bottom">
<form name="cuser" action="../php/createuser.php" method="POST">
<input type="text" placeholder="Email" name="email" required=" "/>
<input type="text" placeholder="Username" name="username" required=" "/>					
<input type="password" class="password" name="password" placeholder="Password" required=" "/>
<input type="password" class="password" name="cpassword" placeholder="Confirm Password" required=" "/>
<center><select name="role" id="role">
<option value="0" hidden>Select One</option>
<option value="1">Administrator</option>
<option value="2">Data Entry Clerk</option>
<option value="3">Guest</option>

</select>	</center>

<input type="submit" name="createuser" value="Create User"/>
</form>
</div>


<div id="edituser" class="login-bottom">
<form name="eduser" method="post" action="../php/edituser.php">
<center>Username:</center>
<center> <select id="usernames" name="usernames" onchange="check()">
<option value="0">Select One</option>
<?php 
include('../php/db.php');
$sql="Select email,username from users"; 
$result=$conn->query($sql);


if ($result ->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    
$username= $row["username"];$ID= $row["id"];
$id= $row["email"];
$x=$_REQUEST['id'];
$_SESSION['id']=$x;
json_encode($username);
json_encode($id);
echo "  <option value='$id'>$username</option> ";
	
    }
} else {

}

?>

</select>	</center>

<div id="fields">
<?php 





$x=$_SESSION['id'];


$sql2="SELECT users_roles.role_id,users_roles.user_email, users.email, users.encrypted_password, users.username,users.id AS ID
    FROM users 
    INNER JOIN users_roles
            ON users.email = users_roles.user_email
    WHERE users.email = '$x'"; 
$result2=$conn->query($sql2);

if ($result2 ->num_rows > 0) {
$role="";
    while($row2 = $result2->fetch_assoc()) {
    
$ID= $row2["ID"];
$role_id= $row2["role_id"];
$username= $row2["username"];
$email= $row2["email"];
$pass= $row2["encrypted_password"];

if($role_id==1){
	$role="Administrator";
}
if($role_id==2){
	$role="Data Entry Clerk";
}
if($role_id==3){
	$role="Guest";
}

json_encode($role);
json_encode($username);
json_encode($email);
json_encode($pass);

echo "
<center><table align='center'>

<tr>
<td align='center' colspan='8'>Access Level: <input type='text' id='rolebx' name='rolebx' readonly value='$role'/>

<center><select name='levels' id='levels' hidden>
<option value='$role_id' >$role</option>
<option value='1'>Administrator</option>
<option value='2'>Data Entry Clerk</option>
<option value='3'>Guest</option>

</select>	</center>



</td>
</tr>

<tr ><td align='center'>ID: <input type='text' id='ID' name='ID' readonly value='$ID'/></td>
<td align='center'>Email: <input type='text' id='email' name='email' readonly value='$email'/></td>
<td align='center'>Password: <input type='text' id='password' name='password' readonly value='$pass'/></td>

</tr>

</table></center>

";

 }
} else {
 
}




?>

</div>


<br>
<br>
<center><input type="button" style="display:inline;" id="updateuser" name="updateuser" value="Update User"/><input type="hidden" style="display:inline; background:green;" id="saveuser" name="saveuser" value="Save User"/><br>
<input type="submit" style="display:inline; background:red; font-size:1em; " id="deluser" name="deluser" value="Delete User"/></center>
</form>
</div>

					</div>
			</div>
		<div class="footer">
			<?php include('../php/footer.php');?></div>
<script>
jQuery(document).ready(function(){
        jQuery('#adduserbtn').on('click', function(event) {    
			
             jQuery('#adduser').toggle('show');
			jQuery('#edituser').hide();
			
        });
		jQuery('#edituserbtn').on('click', function(event) {        
           
			jQuery('#edituser').toggle('show');
			jQuery('#adduser').hide();
			
						 
        });
    });
	
 $(document).ready(function(){
	 jQuery('#adduser').toggle('hide');
	 jQuery('#edituser').toggle('hide');
	 

var m = window.location.search.match(/id=([^&]*)/);

if (m) { 
    // => alerts "test"
$('#usernames').val(m[1]);
jQuery('#edituser').toggle('show');
} 
	 });
	 
	 
	 
function check(){
	
var fields = document.getElementById("usernames");

if(fields.selectedIndex == 0) {
	
     alert('select one answer');
}
else {
	
    var selectedText = fields.options[fields.selectedIndex].value;

	

	//alert(selectedText);
	window.location.href = "panel.php?id=" + selectedText; 
	 

    
	
}
}	


  $('#updateuser').click(function(){
	  
$("#email").removeAttr('readonly');
$("#password").removeAttr('readonly');
$("#levels").removeAttr('hidden');
$("#rolebx").attr('type','hidden');
$("#updateuser").attr('type','hidden');
$("#saveuser").attr('type','button');

 }); 
 
  $('#saveuser').click(function(){
  var fields = document.getElementById("levels");
	   document.getElementById("rolebx").value = fields.options[fields.selectedIndex].value;
	
$("#email").attr('readonly','readonly');
$("#password").attr('readonly','readonly');
$("#levels").attr('hidden','hidden');
$("#rolebx").attr('type','text');
$("#updateuser").attr('type','button');
$("#saveuser").attr('type','hidden');
document.eduser.submit();
 }); 
 // $('#deluser').click(function(){

//document.eduser.submit();
// }); 
</script>
</body>
</html>
