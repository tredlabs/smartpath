<?php
require 'php/db.php';
date_default_timezone_set("Jamaica");
session_start();
if(isset($_SESSION['message'])){
    echo "<script type='text/javascript'>
            alert('" . $_SESSION['message'] . "');
          
          </script>";
		  
    //to not make the error message appear again after refresh:
    session_unset($_SESSION['message']);
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL-E_NOTICE);
/**
*

*
*/

$dir="";
require_once($dir."classes/Session_Manager.php");

$Session_Manager = new Session_Manager();  //Create Session Manager$sid = $Session_Manager->get_custom_SID();
$sid = $Session_Manager->get_custom_SID();


//check if the logged variable is set 

	if($_POST)
	{
		$username = $_POST['Email'];
		
		$password = $_POST['password'];
		
		
		$login = $Session_Manager->checkLogin($username, $password);
		
		
			
if($login == "no")
		{
		$_SESSION['message']= "Incorrect Email Or Password";
		header("Location: /");	
			
			
		
			
	}
		
		
			
			if($login == "alreadylogin")
		{
			
			//$login = $Session_Manager->checkLogin1($username, $password);	
			
		//$_SESSION['message']= "Already Login! ";
		//header("Location: /");		
			
		
		header("Location: profile.php");
			
	}
		
		
		
		

			if($login == "yes")
		{ 
				 	
	header("Location: profile");

	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
			
				$created_at = date("Y-m-d h:i:s");
$action="Login";
$userid = $_SESSION[$sid]['userid'];

			$username = $_POST['Email'];
			$_SESSION['username']=$username;
		   
	               $sqltr = "INSERT INTO user_action(user_id,user,action,created_at)
	               VALUES ('$userid','$username','$action','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   
  
  
}


				
		
			
		}
		
		
	}


?>

<!DOCTYPE html>
<html>
  <title>Smart Path</title>
  
  <link href="../plugins/switchery/switchery.min.css" rel="stylesheet" />
                    <link href="../plugins/jquery-circliful/css/jquery.circliful.css" rel="stylesheet" type="text/css" />

                    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/pages.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/menu.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">
                    <link rel="shortcut icon" href="assets/images/lunch1.ico">
                    
                    <script src="assets/js/modernizr.min.js"></script>
 <body>
  <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
               

                <!-- Navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                          

                            <ul class="nav navbar-nav hidden-xs" style="display: none">
                            
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect" data-toggle="dropdown"
                                       role="button" aria-haspopup="true" aria-expanded="false">User <span
                                            class="caret"></span></a>
                                    <ul class="dropdown-menu">
                           
                                        <li><a href="adminpanel/index.php">Admin</a></li>
                                     
                                    </ul>
                                </li>
                            </ul>

                       

                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <div class="text-center">
            
            </div>

               <div class="container">	<div class="card-box1" style="border-color: blue" >
                    	
                    	 
                    
                    	  <div class="wrapper-page" style="height: 200px;
    width: 50%;">

				
        	
	<img src="assets/images/lunch.png" width="100%"alt="logo">
            <form class="form-horizontal m-t-20" action="" autocomplete="on" method="post">

                <div class="form-group">
                
                    <div class="col-xs-12">
                        <input class="form-control" type="email" id="Email" name="Email" required="" placeholder="Enter Email">
                        <i class="md md-account-circle form-control-feedback l-h-34"></i>
                    </div>
                </div>
            <!--Login form to enter password-->
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Enter password">
                        <i class="md md-vpn-key form-control-feedback l-h-34"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox">
                           
                        </div>

                    </div>
                </div>
   <div class="form-group text-right m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-custom w-md waves-effect waves-light" name="login">Log In
                        </button>
                    </div>
                </div>
           
                <div class="form-group m-t-30">
                    <div class="col-sm-7">
                       
                    </div>
                
                </div>
            </form>
        </div>
                    	
 <div class="row">
                        	<div class="col-sm-12">
                        		
                        		
                        		
                        	
                        	
                        		
                        		
                        				<div class="col-md-6">
                        				

                        				</div>

                        		</div>
                        	</div>
                        </div>

                    <!-- end container -->
                </div>
        </div>

        
    	<script>
            var resizefunc = [];
        </script>

        <!-- Main  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- Custom main Js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
	
	</body>      
</html>