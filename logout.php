<?php

/* Log out process, unsets and destroys session variables */

session_start();

date_default_timezone_set("Jamaica");

require 'db.php';



$dir="";

require_once($dir."classes/Session_Manager.php");







	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);

			

				$created_at = date("Y-m-d h:i:s");











$action="Logout";



    $username = $_SESSION['username'];

	$Session_Manager = new Session_Manager();

	$sid = $Session_Manager->get_custom_SID();

	$name = $_SESSION[$sid]['name'];

	$userid = $_SESSION[$sid]['userid'];

	

	

 		$sql = "UPDATE users 

				SET sign_in_count='0',sessionID='' WHERE id='$userid'";

				

				

						

	

	

	



  $sqltr = "INSERT INTO user_action(user_id,user,action,created_at)

	        VALUES ('$userid','$username','$action','$created_at')";

			

  if ($conn->query($sqltr) === TRUE) {

     //$mess="Trace user  ";

	//echo "$mess $username  $userid";

	

		if($conn->query($sql) === TRUE)

		{

			//echo "Updated Successfully";

			header("Location: /");	

		}	

	

	

	

session_unset();

session_destroy(); 

	   

  

  

}







?>

<!--<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width,initial-scale=1">

        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">

        <meta name="author" content="Coderthemes">



       

 <link rel="shortcut icon" href="assets/images/coat1.ico">

        <title> Ministry Of Education CMS</title>



        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">

        <link href="assets/css/core.css" rel="stylesheet" type="text/css">

        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">

        <link href="assets/css/components.css" rel="stylesheet" type="text/css">

        <link href="assets/css/pages.css" rel="stylesheet" type="text/css">

        <link href="assets/css/menu.css" rel="stylesheet" type="text/css">

        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">



        <script src="assets/js/modernizr.min.js"></script>

        

          



<script type="text/javascript"> 

localStorage.removeItem('alerted');

localStorage.removeItem('ware3');

localStorage.removeItem('ware2');

//localStorage.removeItem('pf');

//localStorage.removeItem('env');

</script>



      

        

    </head>

    <body>

<center>

	<img src="assets/images/coat.png" width="25%"alt="logo">

	</center>

        <div class="ex-page-content">

            <div class="container">

                <div class="row">

                    <div class="col-sm-6">

                        <svg class="svg-box" width="380px" height="500px" viewBox="0 0 837 1045" version="1.1"

                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"

                             xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">

                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"

                               sketch:type="MSPage">

                                <path d="M353,9 L626.664028,170 L626.664028,487 L353,642 L79.3359724,487 L79.3359724,170 L353,9 Z"

                                      id="Polygon-1" stroke="#3bafda" stroke-width="6" sketch:type="MSShapeGroup"></path>

                                <path d="M78.5,529 L147,569.186414 L147,648.311216 L78.5,687 L10,648.311216 L10,569.186414 L78.5,529 Z"

                                      id="Polygon-2" stroke="#7266ba" stroke-width="6" sketch:type="MSShapeGroup"></path>

                                <path d="M773,186 L827,217.538705 L827,279.636651 L773,310 L719,279.636651 L719,217.538705 L773,186 Z"

                                      id="Polygon-3" stroke="#f76397" stroke-width="6" sketch:type="MSShapeGroup"></path>

                                <path d="M639,529 L773,607.846761 L773,763.091627 L639,839 L505,763.091627 L505,607.846761 L639,529 Z"

                                      id="Polygon-4" stroke="#00b19d" stroke-width="6" sketch:type="MSShapeGroup"></path>

                                <path d="M281,801 L383,861.025276 L383,979.21169 L281,1037 L179,979.21169 L179,861.025276 L281,801 Z"

                                      id="Polygon-5" stroke="#ffaa00" stroke-width="6" sketch:type="MSShapeGroup"></path>

                            </g>

                        </svg>

                    </div>



                    <div class="col-sm-6">

                        <div class="message-box">

                            

                           

                            <div class="buttons-con">

                                <div class="action-link-wrap">

                                   

                                    <a href="/" class="btn btn-custom btn-primary waves-effect waves-light m-t-20">Login Page</a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        

    	<script>

            var resizefunc = [];

        </script>



        

       

	

	</body>

</html>-->