<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL-E_NOTICE);
/**
*
*	This is the login page, it collects login credentials and attempt to log onto the system.
*	It will set the initial log in session and allow for access to the reset of the system. 
*	-Gavin Palmer || March 2016
*
*/

$dir="";
require_once($dir."classes/Session_Manager.php");


$Session_Manager = new Session_Manager();  //Create Session Manager Objetc -Gavin Palmer || March 2016

$sid = $Session_Manager->sessionId; //Get session ID -Gavin Palmer || March 2016
$logged = $_SESSION[$sid]['logged']; //store logged state -Gavin Palmer || March 2016

//check if the logged variable is set -Gavin Palmer || March 2016
if(!$logged)
{
	
	if($_POST)
	{
		$username = $_POST['Email'];
		$password = $_POST['password'];
		
		$login = $Session_Manager->checkLogin($username, $password);

		//$userData = $Session_Manager->getUserInformation($id); //user details, name, address , contact, etc. -Gavin Palmer || March 2016
		
		if($login == true)
		{

			$username = $_POST['Email'];
			$_SESSION['username']=$username;

			header("Location: profile.php");
		}
		
		if($login == false)
		{
			header("Location: login1.php");
			$_SESSION[$sid]['system_message']="Invalid login attempt. Please try again!";//set invalid login message -Gavin Palmer || March 2016

		}
	}
}
else
{	
	if($_POST)
	{
		$username = $_POST['Email'];
		$_SESSION['username']=$username;
		header("Location: login1.php");
	}
	
}
?>
<!--
Author: Romaine Whyte
Co-Author: Gavin Palmer
Author URL: http://tredlabs.com

-->
<!DOCTYPE html>
<html>
  <title>Streamline</title>
  
  <link href="../plugins/switchery/switchery.min.css" rel="stylesheet" />
                    <link href="../plugins/jquery-circliful/css/jquery.circliful.css" rel="stylesheet" type="text/css" />

                    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/pages.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/menu.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">

                    <script src="assets/js/modernizr.min.js"></script>
 <body>
  <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="sign.php" class="logo"><i class="md md-equalizer"></i> <span>Streamline</span> </a>
                    </div>
                </div>

                <!-- Navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                          

                            <ul class="nav navbar-nav hidden-xs">
                            
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect" data-toggle="dropdown"
                                       role="button" aria-haspopup="true" aria-expanded="false">User <span
                                            class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Guest</a></li>
                                        <li><a href="#">Staff</a></li>
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

               <div class="container">	<div class="card-box1">
                    	
                    	
                    
                    	  <div class="wrapper-page">

				
        	
	<img src="assets/images/streamline.jpg" width="100%"alt="logo" >
            <form class="form-horizontal m-t-20" action="" autocomplete="on" method="post">

                <div class="form-group">
                
                    <div class="col-xs-12">
                        <input class="form-control" type="email" id="Email" name="Email" required="" value="EMAIL" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'EMAIL';}">
                        <i class="md md-account-circle form-control-feedback l-h-34"></i>
                    </div>
                </div>
            <!--Login form to enter password-->
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" name="password" id="password" value="PASSWORD" required="" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'PASSWORD';}">
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