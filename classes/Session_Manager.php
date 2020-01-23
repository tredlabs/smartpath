<?php
require 'db.php';

class Session_Manager
{
	var $app_name = "smartPath";
	var $signedIn=false;
	var $sessionId;
	var $date;//current date
	var $time;//current time(should be date and time)
	var $failed;//stores whether login was failed
	var $id;//stores logged in member/user id
	var $cookiename='smartPath';//default cookie name if not set from $_SESSION['cookiename']
	var $session_expiry=3000; //set to 15 mins 900
	//DB variables
	


	public function __construct()
	{
		$this->date			= gmdate("Y-m-d", time());
		$this->time			= date("H:i:s A",time());
		$this->sessionId	= $this->app_name."_".session_id();
		$sid = $this->sessionId;
	}
	
	/*
		Initializes session defaults
	*/
	function sessionDefaults()
	{
		$sid = $this->sessionId;
		
		//$_SESSION[$sid]['logged']=false;
		//$_SESSION[$sid]['username']='Guest';
		//$_SESSION[$sid]['role']='3';
	}


	/** 
	*	@param void
	*
	*	@return (boolean) 
	*/
	function checkSession()
	{
		$sid = $this->sessionId;

		if($_SESSION[$sid]['logged'])
		{
			return true;
		}
		else
		{
			//$this->logout();
			return false;
		}
	}


	/** -
	*	
	*					
	*	
	*	@param (String) $username - Supplied username
	*	@param (String) $password - Supplied password
	*
	*	@return (boolean) 
	*/
		function checkLogin($username, $password)
	{
  	
  
  
  $db_servername = "localhost";
		$db_username = "dert1_path";
		$db_password = "smartpath2000";
		$db_name =  "dert1_smartpath";
		
		
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
  
  
  
  
 $username = mysqli_real_escape_string($conn, $username);
   $password = mysqli_real_escape_string($conn, $password);
		
		
	
	$password = md5($password);	

			$this->sessionId	= $this->app_name."_".session_id();
		
		

		$sid = $this->sessionId;
		
		 

		
		//Encrypt and create hash for the password to best tested with the database  -Gavin Palmer || March 2016
		//$password = md5($password);
		//echo $username."<br/>";
		//echo $password."<br/>";
		
		//Create SQL string -Gavin Palmer || March 2016
		$sql = "SELECT users.id,users.email,users.username,users_roles.role_id as role,users.sign_in_count
				FROM users
				INNER JOIN users_roles
				ON users.email=users_roles.user_email
				WHERE email = '".$username."'
				AND encrypted_password = '".$password."' ";
				
		


	
		
	
		
			
			$result = $conn->query($sql);

			if ($result->num_rows > 0)
			{	
				// output data of each row
				while($row = $result->fetch_assoc())
				{
					//only checks one row and then cloes the connect
					$this->setSession($row["email"], $row["role"],$row["username"],$id=$row["id"]);
					 $id=$row["id"];
					  $_SESSION['id']=$id;
							
				 	return $login='yes';
			
				}
			
				
			}		
				
	
			
			
			$sql2 = "SELECT users.id,users.email,users.username,users_roles.role_id as role,users.sign_in_count
				FROM users
				INNER JOIN users_roles
				ON users.email=users_roles.user_email
				WHERE email = '".$username."'
				AND encrypted_password != '".$password."' ";
				
	


		// Create connection to database
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
		
				
			$result = $conn->query($sql2);

			if ($result->num_rows > 0)
			{	
				
			//	echo"yes";
				return $login='no';
				
			}
			
		
			
			$sql3 = "SELECT users.id,users.email,users.username,users_roles.role_id as role,users.sessionID,users.sign_in_count
				FROM users
				INNER JOIN users_roles
				ON users.email=users_roles.user_email
				WHERE email = '".$username."'
				AND encrypted_password = '".$password."' AND sessionID='$sid' ";
				
				
				$result = $conn->query($sql3);

			if ($result->num_rows > 0)
			{	
				// output data of each row
				while($row = $result->fetch_assoc())
				{
					//only checks one row and then cloes the connect
					$this->setSession($row["email"], $row["role"],$row["username"],$id=$row["id"]);
					 $id=$row["id"];
					  $_SESSION['id']=$id;
							
				 	return $login='yes';
			
				}
			
				
			}else

			{	
				
				//echo"alreadylogin";
		
				
				return $login='alreadylogin';
				
				
			}
			
				
				

	}
	
	
	/*
	*	This method sets the session variables
	*/
		function setSession($username,$role,$name,$userid)
	{
	 	 $db_servername = "localhost";
		$db_username = "dert1_path";
		$db_password = "smartpath2000";
		$db_name =  "dert1_smartpath";
						
	$this->sessionId	= $this->app_name."_".session_id();
			
			
		$sid = $this->sessionId;
	//echo"<script>alert('$sid');</script>";
		//$_SESSION['sid']=$sid;
		
		$_SESSION[$sid]['username']	= $username;
		$_SESSION[$sid]['role']	= $role;
		$_SESSION[$sid]['name']	= $name;
		$_SESSION[$sid]['userid']= $userid;
	
		$_SESSION[$sid]['logged'] = true;
		
	


		// Create connection to database
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
			$sql2 = "UPDATE users 
				SET sign_in_count='1',sessionID='$sid' WHERE id='$userid'";
					if($conn->query($sql2) === TRUE)
		{
			
		}
		
		
		
	}
	
	
	/**
	*	Logout a user, removes there session and  restarts the session timer
	*
	*/
	function logout()
	{   
		$sid = $this->sessionId;

		$this->sessionDefaults();
		unset($_SESSION[$sid]);
		header("Location: logout.php");
	}
	  
	
function get_custom_SID()
	{
		
 $db_servername = "localhost";
		$db_username = "dert1_path";
		$db_password = "smartpath2000";
		$db_name =  "dert1_smartpath";
		// Create connection to database
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);


   $this->sessionId	= $this->app_name."_". session_id(); 

		$sid = $this->sessionId;
		
		
		$sql3 = "SELECT users.id,users.email,users.username,users_roles.role_id as role,users.sessionID,users.sign_in_count
				FROM users
				INNER JOIN users_roles
				ON users.email=users_roles.user_email
				WHERE sessionID='$sid' ";
				
				
				$result = $conn->query($sql3);

			if ($result->num_rows > 0)
			{	
				// output data of each row
				while($row = $result->fetch_assoc())
				{
					//only checks one row and then cloes the connect
					$this->setSession($row["email"], $row["role"],$row["username"],$id=$row["id"]);
					 $id=$row["id"];
					  $_SESSION['id']=$id;
							
				 	
			
				}
			
				
			}	


  
   // echo $sid;
  

		

	return  $sid;	
	
	}
	
}
?>