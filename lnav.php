<?php
set_error_handler('session_error_handling_function');
session_start();
restore_error_handler();
require 'db.php';

function session_error_handling_function($code, $msg, $file, $line) {
    // your handling code here
}



error_reporting(E_ALL & ~E_NOTICE);

$dir="";
require_once($dir."classes/Session_Manager.php");


					$Session_Manager = new Session_Manager();
					
					//$logged = $Session_Manager->checkSession();
					$sid = $Session_Manager->get_custom_SID();

    $username = $_SESSION['username'];
	   $name = $_SESSION['name'];

            
				    $role = $_SESSION[$sid]['role'];
					 $name = $_SESSION[$sid]['name'];
	
					
				if($name==""){
	//echo "<script>alert('yes');</script>";
					header("Location: /");	
					
				
	

}   
?>	


<!DOCTYPE html>
<html>
    <head>
    	
    	
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
                    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
                    <meta name="author" content="Coderthemes">

					<link rel="shortcut icon" href="assets/images/lunch1.ico">
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
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                     <link href="plugins/nvd3/build/nv.d3.min.css" rel="stylesheet" type="text/css"/>
</head>

<script>

var role=<?php echo $role;?>


function myFunction(){
	//localStorage.setItem('pf','yes');

	if(role==1||role==2){
	

//document.getElementById('cur').style.display="block";
document.getElementById('tool').style.display="block";


}
else{

}
}

 
 
 
 
 </script>      


 <body onload="myFunction();" class="fixed-left">
 	  <div id="wrapper">
            <!-- Top Bar Start -->
            <div class="topbar">
     
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="profile.php" class="logo"><i class="md md-equalizer"></i> <span>Smart Path LMS</span> </a>
                    </div>
                </div>

                <!-- Navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                            <ul class="nav navbar-nav hidden-xs">
                            
                            
                            </ul>

                         
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->

<!-- ========== Left Sidebar Start ========== -->
              <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <div id="sidebar-menu">
                        <ul>
                            <li class="menu-title"></li>

                            <li>
                                <a href= "profile.php" class="waves-effect waves-primary"><i
                                        class="md md-dashboard"></i><span> Dashboard </span></a>
                            </li>

                   
                            
                                 <li class="has_sub">
                                <a href="student.php"class="waves-effect waves-primary"><i
                                        class="md md-input"></i><span>Students </span> <span
                                        class="menu-arrow"></span> </a>
                                         <ul class="list-unstyled">
                                
                               
                                </ul>
                              
                            </li>
                            
                            
                            
                            
                           
                            
                            
                            
                            
                                <li class="has_sub" style="display: none">
                                <a href="bookstatus.php"class="waves-effect waves-primary"><i
                                        class="md md-input"></i><span>Book Status </span> <span
                                        class="menu-arrow"></span> </a>
                                         <ul class="list-unstyled">
                                
                               
                                </ul>
                              
                            </li>
                            
                            
                            
                 <li class="has_sub" style="display: none">
                                <a href="receival1.php"class="waves-effect waves-primary"><i
                                        class="md md-input"></i><span>Scan ISBN </span> <span
                                        class="menu-arrow"></span> </a>
                                         <ul class="list-unstyled">
                                
                               
                                </ul>
                              
                            </li>
                            
                            
                            
                                         
                 <li class="has_sub">
                                <a href="checkbarcode.php"class="waves-effect waves-primary"><i
                                        class="md md-input"></i><span>Lunch Process </span> <span
                                        class="menu-arrow"></span> </a>
                                         <ul class="list-unstyled">
                                
                               
                                </ul>
                              
                            </li>
                            
                            
                            
                            
                              <li class="has_sub">
                                <a href="addbarcode.php"class="waves-effect waves-primary"><i
                                        class="md md-settings-remote"></i><span>Add Barcode</span> <span
                                        class="menu-arrow"></span> </a>
                                         <ul class="list-unstyled">
                                
                               
                                </ul>
                              
                            </li>
                          
     	
												
	<!--	  <li class="has_sub" id="pur" style="display: none">
		  	
		  	 
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="md md-redeem"></i>
                                    <span> Purchase Order </span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <!--<li id="pur"><a href="javascript:void(0);">Add Purchase Order</a></li>
                           
                           
                 <li id=><a href="purchaseorder.php">Add Purchase Order</a></li>
                                  
                                </ul>
                            </li> -->
				
			
                            

                           

                            <li class="has_sub" style="display: block">
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="md md-view-list"></i><span> Reports </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="inventoryreport.php">Path Student List</a></li>
                                    
                                    <!-- <li><a href="reportbydate.php">Date</a></li>-->
                                    
                                    <li><a href="usagereport.php">Lunch Report</a></li>
                                    
                                  
                                 
                                </ul>
                            </li>

                     
    <li class="has_sub" id="tool" style="display: none">
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="md md-view-list"></i><span> Tools </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                   <!-- <li><a href="pricelisting.php">Price Listing</a></li>-->
                                   <li><a href="admin.php">Admin Control</a></li>
                              
                             
                                </ul>
                            </li>

                     

                  

                        </ul>
                       
                    </div>

                    <div class="clearfix"></div>
                </div>

              <div class="user-detail">
                    <div class="dropup">
                        <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">
                            <img  src="assets/images/users/pic.png" alt="user-img" class="img-circle">
                            <span class="user-info-span">
                                <h5 class="m-t-0 m-b-0"><?= $name?></h5>
                                <p class="text-muted m-b-0">
                                    <small><i class="fa fa-circle text-success"></i> <span>Online</span></small>
                                </p>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                          
                            <li><a href="logout.php"><i class="md md-settings-power"></i> Logout</a></li>
                        </ul>

                    </div>
                </div>
            </div>
            
            
            
            
            <!-- ========== Left Sidebar Start ========== -->
           <footer class="footer text-right">
                    Pembroke Hall HS
                </footer>
           <!-- </div>  --> 
            <script>
   
            	
</script>
