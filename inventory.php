<?php
session_start();

error_reporting(E_ALL & ~E_NOTICE);
//error_reporting(E_ALL-E_NOTICE);
//error_reporting(0);

$dir="";
require_once($dir."classes/Session_Manager.php");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();



    $username = $_SESSION['username'];

            
					$Session_Manager = new Session_Manager();
					$sid = $Session_Manager->get_custom_SID();
				    $role = $_SESSION[$sid]['role'];
			        $name = $_SESSION[$sid]['name'];
?>
<!DOCTYPE html>
<html>
    <head>
    	
    	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
                    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
                    <meta name="author" content="Coderthemes">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
                     <link rel="shortcut icon" href="assets/images/creat.ico">
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->

<link href="css/font-awesome.css" rel="stylesheet"> 


<script src="js/bootstrap.min.js"> </script>

<link href="css/bootstrap-3.3.6-dist/css/bootstrap.css" rel='stylesheet' type='text/css' />
<script src="css/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
<script src="css/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">

<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script src="http://w3resource.com/twitter-bootstrap/twitter-bootstrap-v2/js/bootstrap-tooltip.js"></script>
<script src="http://w3resource.com/twitter-bootstrap/twitter-bootstrap-v2/js/bootstrap-popover.js"></script>

<script src="js/validator.js"></script>


<!-- DataTables -->
        <link href="../plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />




<!-- Custom Theme files -->
                    <title>Inventory</title>

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
                    <script src="js/scripts(Tredlabs).js"></script>

      <script>



</script>
  
<!-- Mainly scripts -->
<script src="js/jquery.metisMenu.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<link href="css/custom.css" rel="stylesheet">
<script src="js/custom.js"></script>
<script src="js/screenfull.js"></script>
<script>


	
	function Remove_Usage(id)
	{
		//alert("start");
		var xhttp = new XMLHttpRequest();
		
		//Confirm before action is taken
		var action = confirm("Are you sure?");
		
		if(action==false)
		{
			return false;
		}
		
	
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					alert(xhttp.responseText);
					document.getElementById("Receival_listing_Message").innerHTML = "Stock deleted";
					$('#Receival_listing_Message').delay(5000).fadeOut(400);
					$('#Listing_row_'+id).delay(1000).fadeOut(400);
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Remove_Stock&id="+id, true);
		xhttp.send();
		//alert("stop");
	}
	
	
	
	
	//_______________________________[Loaded functions to b executed when the page is ready]______s________________________________________________
	$(document).ready(function()
	{
		//Load inventory table
		Load_Default_Inventory_table();
		
		$('#search_field').keyup(function()
		{
			Search_Inventory_table();
		});
		
		//Apply style to check box
		//$("[name='Equipment_checkbox']").bootstrapSwitch();
		
	});
	
-->
</script>
<script>
var role=<?php echo $role;?>

function myFunction(){
	//localStorage.setItem('pf','yes');

	if(role==1||role==2){
	
document.getElementById('pur').style.display="block";
document.getElementById('cur').style.display="block";
document.getElementById('usa').style.display="block";
document.getElementById('tool').style.display="block";
document.getElementById('rec').style.display="block";
document.getElementById('inv').style.display="block";






//alert(role);
}
else{
	
	document.getElementById('usg1').style.display="none";
}
}
 
 
 
 
 </script>      
    </head>


    <body onload="myFunction();" class="fixed-left">
        
        <!-- Begin page -->
        <div id="wrapper">
        
            <!-- Top Bar Start -->
            <div class="topbar">
     
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="profile.php" class="logo"><i class="md md-equalizer"></i> <span>The Creative Unit</span> </a>
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

                            <li class="has_sub" id="inv" style="display: none">
                                <a href= "javascript:void(0);"  class="waves-effect waves-primary"><i class="md md-palette"></i> <span> Inventory </span>
                                 <span class="menu-arrow"></span></a>
                                 
                                   <ul class="list-unstyled">
                                    <!--<li id="pur"><a href="javascript:void(0);">Add Purchase Order</a></li>-->
                                   
                                  <li id=><a href="warehouse1.php">Warehouse1</a></li>
                                  
                                  	<?php
					$Session_Manager = new Session_Manager();
					$sid = $Session_Manager->get_custom_SID();
					
					$role = $_SESSION[$sid]['role'];
				
					?>
                  								
		  <li id="cur" style="display: none"><a href="createstock.php">Create Stock</a></li>
			   
                                  
                                </ul>
                                 
                            
                               
                            </li>
                            
                 <li class="has_sub" id="rec" style="display: none">
                                <a href="receival1.php"class="waves-effect waves-primary"><i
                                        class="md md-invert-colors-on"></i><span> Receivals </span> <span
                                        class="menu-arrow"></span> </a>
                                         <ul class="list-unstyled">
                                
                               
                                </ul>
                              
                            </li>
     	
												
		  <li class="has_sub" id="pur" style="display: none">
		  	
		  	 
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="md md-redeem"></i>
                                    <span> Purchase Order </span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <!--<li id="pur"><a href="javascript:void(0);">Add Purchase Order</a></li>-->
                           
                           
                 <li id=><a href="purchaseorder.php">Add Purchase Order</a></li>
                 <li id=><a href="all_purchase.php">View Purchase Orders</a></li>
                                  
                                </ul>
                            </li>
				
			
                            

                            <li class="has_sub" id="usa" style="display: none">
                                <a href="usage.php" class="waves-effect waves-primary"><i class="md md-now-widgets"></i><span> Usage </span> <span class="menu-arrow"></span></a>
                           
                            </li>

                            <li class="has_sub" id="" style="display: block">
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="md md-view-list"></i><span> Reports </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="inventoryreport.php">Inventory Listing</a></li>
                                    
                                    <!-- <li><a href="reportbydate.php">Date</a></li>-->
                                    
                                    <li><a href="usagereport.php">Usage Reports</a></li>
                                    <li><a href="receival_report.php">Receivals Reports</a></li>
                                   <li><a href="purchaseorder_report.php">Purchase Reports</a></li>
                                    <li><a href="spoilreport.php">Spoilage Reports</a></li>
                     
                                </ul>
                            </li>

                     
    <li class="has_sub" id="tool" style="display: none">
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="md md-view-list"></i><span> Tools </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="price.php">Price Listing</a></li>
                                   <!-- <li><a href="pricefinal.php">Final Cost Price</a></li>-->
                              
                             
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
            <!-- Left Sidebar End --> 


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                   
                                    <h4 class="page-title">Stock Listing</h4>
                                </div>
                            </div>
                        </div>
<div class="card-box" style="overflow: hidden">
	
	

           
                <div class="table-responsive">  
         
                          
                </div>  
                      
                 <div class="card-box">
           
                <div class="table-responsive">  
         	<div class="receivaldata">
               <h3 align="right"></h3>
                        	
                        			
              
                  <div class="" style="">
 
 	<!--banner-->	
		     <div class="banner">
		    	<h4>
	

				<!--span>Receival listing</span-->
				
				</h4>
		    </div>
		<!--//banner-->
 	 <!--faq-->
 	<div id="Receival_listing" class="blank" style="overflow-y: none;">
		
	
		
		<!--Adding in page info-->
		








                        <div id="try" class="row">
                        	
                            <div class="col-sm-12">
                               

                                    <h4 class="m-t-0 header-title"><b>Inventory</b></h4>
                                 <div id="Receival_listing_Message" style="padding: 10px; text-align: center">
			</div>

                                    <table id="datatable-fixed-header" class="table table table-hover m-0 ">
                                       
                                       
                                        <thead>
                                            <tr>
                                                
                                              
                                                <th>Type</th>
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>Desc</th>
                                                <th>Env sml</th>
                                                <th>Env lrg</th>
                                                <th>Sheet1</th>
                                                <th>Sheet2</th>
                                                <th>Instock</th>
                                                <th>Reorder</th>
                                                <th>Cost</th>
                                                
      <?php	if($GLOBALS['role']>0 && $GLOBALS['role']<2)
				{
				  echo "<th>Action</th>";	
                     }
?>
                                                
                                            </tr>
                                        </thead>
<tbody id="" style="">

                                      
                                        	
                                       <?php
require 'db.php';

 $db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";




	
		$sql = "SELECT stocks.id, fields.name as type, stocks.name,stocks.updated_at, stocks.p1, stocks.p2, stocks.p3, stocks.small,stocks.large,stocks.papersize,stocks.sheet1,stocks.sheet2, stocks.instock, stocks.reorderlevel, stocks.cost
		    FROM stocks
			INNER JOIN fields
			ON stocks.field_id=fields.id"; 
			

	
	//If the individual is searching for specific vendors  -Gavin Palmer || March 2016
	if(isset($_REQUEST["search_value"]))
	{
		$search_value=$_REQUEST["search_value"];
		$sql=$sql." WHERE invoice_number LIKE '".$search_value."%'";
	}
	
	if(isset($_REQUEST["search_start_date"]) && isset($_REQUEST["search_end_date"]))
	{
		if(($_REQUEST["search_start_date"]!="") && ($_REQUEST["search_end_date"]!=""))
		{
			$sql=$sql." and usagedate BETWEEN '".$_REQUEST["search_start_date"]."' and '".$_REQUEST["search_end_date"]."'";
		}
	}
	
$sql=$sql." ORDER BY stocks.id DESC";
	
	//echo "[".$sql."]";*/
					
					
	// Create connection to database
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		//echo "Connected successfully<br/>";
						
		$result = $conn->query($sql);
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
						
										       $id=$row["id"];
										       $date=$row["updated_at"];
										       $type=$row["type"];
											   $name=$row["name"];
											   $pur=$row["p1"];
											   $small=$row["small"];
								               $large=$row["large"];
												$sheet1=$row["sheet1"];
												$sheet2=$row["sheet2"];
												$instock=$row["instock"];
											    $reorder=$row["reorderlevel"];
												$cost=$row["cost"];
												
												
												$equip=$row["equip"];
												$pack=$row["pack"];
												$qty=$row["qty"];
							$myNumber = $cost;

// Displays "1,234,568"
					
												
												
									if($large=="")
									{$large="-";
									}
										if($small=="")
									{$small="-";
									}	
										if($sheet1=="")
									{$sheet1="-";
									}		
										if($sheet2=="")
									{$sheet2="-";
									}			
										if($sheet2=="")
									{$sheet2="-";
									}				
										echo"
												
											<tr id='Listing_row_$id'>
											
											<td>$type</td>
											<td>$date</td>
											<td>$name</td>
											<td>$pur</td>
											<td>$small</td>
										    <td>$large</td>
											<td> $sheet1</td>
										    <td>$sheet2</td>
										    <td>$instock</td>
								            <td>$reorder</td>
								            
										    <td  align='right'> $"?><?php echo number_format($myNumber,2);"</td> 
										    <td class='text-center'>";														
			
					if($GLOBALS['role']>0 && $GLOBALS['role']<2)
				{
				  echo " <td><a href='#' class='btn btn-danger btn-md button_style_addon' style='border-radius: 5px;' onClick='Remove_Usage($id);'><span class='glyphicon glyphicon-remove'></span> Del</a></td> ";
				}
										echo"</td></tr>";					
											
												
												
												
												
			}
		}


}
?> 	
                                       	
                                        	
                                        	
                                            
                                            
                              	</tbody>
                                    </table>
                                
                            </div>
                        </div></div>
	

		
	
	
	<!--//faq-->
		<!---->
<div class="copy">
<div class="row col-md-12 custyle">
            
		</div>
		</div>
		</div>
		<div class="clearfix"> </div>
       </div>
     </div>
     </div>
<!---->
<!--scrolling js-->
<script>
            var resizefunc = [];
        </script>

        <!-- Plugins  -->
 
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>
        
        <!-- Counter Up  -->
        <script src="../plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="../plugins/counterup/jquery.counterup.min.js"></script>

        <!-- circliful Chart -->
        <script src="../plugins/jquery-circliful/js/jquery.circliful.min.js"></script>
        <script src="../plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

        <!-- skycons -->
        <script src="../plugins/skyicons/skycons.min.js" type="text/javascript"></script>
        
        <!-- Page js  -->
        <script src="assets/pages/jquery.dashboard.js"></script>

        <!-- Custom main Js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>





        
        <script type="text/javascript">
              

            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
                $('.circliful-chart').circliful();
            });

            // BEGIN SVG WEATHER ICON
            if (typeof Skycons !== 'undefined'){
            var icons = new Skycons(
                {"color": "#3bafda"},
                {"resizeClear": true}
                ),
                    list  = [
                        "clear-day", "clear-night", "partly-cloudy-day",
                        "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                        "fog"
                    ],
                    i;

                for(i = list.length; i--; )
                icons.set(list[i], list[i]);
                icons.play();
            };
</script>
       <!-- Datatables-->
        <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="../plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="../plugins/datatables/jszip.min.js"></script>
        <script src="../plugins/datatables/pdfmake.min.js"></script>
        <script src="../plugins/datatables/vfs_fonts.js"></script>
        <script src="../plugins/datatables/buttons.html5.min.js"></script>
        <script src="../plugins/datatables/buttons.print.min.js"></script>
        <script src="../plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="../plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="../plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="../plugins/datatables/dataTables.scroller.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>

    

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "../plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
            TableManageButtons.init();

        </script>
        
        <!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
<footer class="footer text-right">
                    Streamline.
                </footer>
    
    </body>
</html>
