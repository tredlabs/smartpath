<?php

require('mysql_table.php');
require 'db.php';

include 'blank.php';


session_start();

error_reporting(E_ALL & ~E_NOTICE);

$dir="";
require_once($dir."classes/Session_Manager.php");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();



    $username = $_SESSION['username'];
	   $name = $_SESSION['name'];

            
					$Session_Manager = new Session_Manager();
					$sid = $Session_Manager->get_custom_SID();
				    $role = $_SESSION[$sid]['role'];
					 $name = $_SESSION[$sid]['name'];
				
					

if($logged)
{
	
	
}
else
{
	header("Location: index.php");
}





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

                    <link rel="shortcut icon" href="assets/images/favicon_1.ico">

                    <title>Welcome <?= $username  ?></title>

                    <link href="../plugins/switchery/switchery.min.css" rel="stylesheet" />
                    <link href="../plugins/jquery-circliful/css/jquery.circliful.css" rel="stylesheet" type="text/css" />

        <link href="../plugins/nvd3/build/nv.d3.min.css" rel="stylesheet" type="text/css" />

                    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/pages.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/menu.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">

                    <script src="assets/js/modernizr.min.js"></script>

   <link href="plugins/switchery/switchery.min.css" rel="stylesheet" />
                    <link href="plugins/jquery-circliful/css/jquery.circliful.css" rel="stylesheet" type="text/css" />


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        

<script>

//Global JS variables
	




function check(){  //this function load content to a div
$('#live_data').load('purchaseorder.html');
}
  </script>

<script type="text/javascript"> 
 $(document).ready(function(){
 	
   
 	
 	 $(document).on('click', '#fun', function(){ //call function to get stock data from database 
            fetch_stock();  
            
      });  
       $(document).on('click', '#pur', function(){ //call function to get stock data from database 
             
check();
      });  
      
 	
        	

$(document).on('click', '.btn_delete', function(){  
           var id=$(this).data("id3");  
           if(confirm("Are you sure you want to delete this?"))  
           {  
           	
              $.ajax({  
                     url:"delete.php",  
                     method:"POST",  
                     data:{id:id},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);  
                          fetch_stock();  
                     }  
                });  
           }  
      }); 
      
        
       // =======================================Get data from receivals database
       
      $(document).on('click', '#btn_add', function(){   //function to assign table records to add to stock database 
           
           var name = $('#name').text();  
          
           var p1 = $('#p1').text();   
           
           var instock = $('#instock').text();  
          
           var reorderlevel = $('#reorderlevel').text();  
            
           var price = $('#price').text();  
           
           if(name == '')  
           {  
                alert("Enter Part name");  
                return false;  
           }  
           if(p1 == '')  
           {  
                alert("Enter Part No.");  
                return false;  
           }  
           if(instock == '')  
           {  
                alert("Enter instock");  
                return false;  
           }  
           if(reorderlevel == '')  
           {  
                alert("Enter Reorder level");  
                return false;  
           }  
           if(price == '')  
           {
           	  alert("Enter Price");  
                return false; 
           }
           $.ajax({  
                url:"insert.php",  
                method:"POST",  
                data:{name:name, p1:p1, price:price, instock:instock, reorderlevel:reorderlevel},  
                dataType:"text",  
                success:function(data)  
                {  	
                     alert(data);  
                     fetch_stock();  
                }  
           })  
      });      //000000000000000000000000000000function to assign table records to add to stock database
       
      
            $(document).on('click', '#btn_addr', function(){ //function to assign table records to add to receivals database 
           
           var invoice_number = $('#invoice_number').text();  
          
           var recdate = $('#recdate').text();   
           
           var created_at= $('#created_at').text();  
          
           
           if(invoice_number == '')  
           {  
                alert("Enter Invoice Number");  
                return false;  
           }  
           if(recdate == '')  
           {  
                alert("Enter Record date.");  
                return false;  
           }  
           if(created_at == '')  
           {  
                alert("Enter Date and time");  
                return false;  
           } 
       
           $.ajax({  
                url:"insertrec.php",  
                method:"POST",  
                data:{invoice_number:invoice_number, recdate:recdate, created_at:created_at}, 
                success:function(data)  
                {  	
                     alert(data);  
                     fetch_receivals();  
                }  
           })  
      }); //0000000000000000000000000000000000000000000End Add to receivals database
    
     
 	$(document).on('click', '#btn_delete1', function(){  
           var id=$(this).data("id3");  
           if(confirm("Are you sure you want to delete this?"))  
           {  
           	
              $.ajax({  
                     url:"recdelete.php",  
                     method:"POST",  
                     data:{id:id},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);  
                          fetch_receivals();  
                     }  
                });  
           }  
      });

         
         

    
 

     
      
      
      function fetch_stock()  
      {  
           $.ajax({  
                url:"showinventory.php",  
                method:"POST",  
                success:function(data){  
                     $('#live_data').html(data);  
                }  
           });  
      } 
      
        $(document).on('click', '#rec', function(){  // -----------Get data from receivals database
            fetch_receivals();  
            
      }); 
      
        function fetch_receivals()    //============= Get data from stock database
      {  
           $.ajax({  
                url:"addreceivals.php",  
                method:"POST",  
                success:function(data){  
                     $('#live_data').html(data);  
                }  
           });  
      }       
 }); 
 

 </script>

    </head>


    <body class="fixed-left">
        
        <!-- Begin page -->
        <div id="wrapper">
        
            <!-- Top Bar Start -->
            <div class="topbar">
     
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="profile.php" class="logo"><i class="md md-equalizer"></i> <span>Streamline</span> </a>
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

                            <ul class="nav navbar-nav navbar-right pull-right">

                                <li class="dropdown hidden-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light"
                                       data-toggle="dropdown" aria-expanded="true">
                                        <i class="md md-notifications"></i> <span
                                            class="badge badge-xs badge-pink">3</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="text-center notifi-title">Notification</li>
                                        <li class="list-group nicescroll notification-list">
                                            <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        <em class="fa fa-diamond noti-primary"></em>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">A new order has been placed A new
                                                            order has been placed</h5>
                                                        <p class="m-0">
                                                            <small>There are new settings available</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>

                                            <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        <em class="fa fa-cog noti-warning"></em>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">New settings</h5>
                                                        <p class="m-0">
                                                            <small>There are new settings available</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>

                                            <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        <em class="fa fa-bell-o noti-success"></em>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">Updates</h5>
                                                        <p class="m-0">
                                                            <small>There are <span class="text-primary">2</span> new
                                                                updates available
                                                            </small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>

                                        </li>

                                        <li>
                                            <a href="javascript:void(0);" class=" text-right">
                                                <small><b>See all notifications</b></small>
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" class="right-bar-toggle waves-effect waves-light"><i
                                            class="md md-settings"></i></a>
                                </li>

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
                                <a href= "javascript:void(0);"  class="waves-effect waves-primary"><i class="md md-palette"></i> <span> Inventory </span>
                                 <span class="menu-arrow"></span></a>
                                 
                                   <ul class="list-unstyled">
                                    <!--<li id="pur"><a href="javascript:void(0);">Add Purchase Order</a></li>-->
                                   <li id=><a href="inventory.php">Stock Listing</a></li>
                                    <li id=><a href="createstock.php">Create Stock</a></li>
                                </ul>
                                 
                            
                               
                            </li>
                            
                 <li class="has_sub">
                                <a href="receival1.php"class="waves-effect waves-primary"><i
                                        class="md md-invert-colors-on"></i><span> Receivals </span> <span
                                        class="menu-arrow"></span> </a>
                                         <ul class="list-unstyled">
                                
                               
                                </ul>
                              
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="md md-redeem"></i>
                                    <span> Purchase Order </span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <!--<li id="pur"><a href="javascript:void(0);">Add Purchase Order</a></li>-->
                             <li id=><a href="purchaseorder.php">Add Purchase Order</a></li>
                                  
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="usage.php" class="waves-effect waves-primary"><i class="md md-now-widgets"></i><span> Usage </span> <span class="menu-arrow"></span></a>
                           
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="md md-view-list"></i><span> Reports </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="inventoryreport.php">Inventory Listing</a></li>
                                    <li><a href="javascript:void(0);">Usage Reports</a></li>
                                    <li><a href="javascript:void(0);">Receivals Reports</a></li>
                                    <li><a href="javascript:void(0);">Purchase Reports</a></li>
                     
                                </ul>
                            </li>

                     
     <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="md md-view-list"></i><span> Tools </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="javascript:void(0);">Add Item</a></li>
                                    <li><a href="javascript:void(0);">Add Euipment</a></li>
                             
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
                                <h5 class="m-t-0 m-b-0"><?= $username?></h5>
                                <p class="text-muted m-b-0">
                                    <small><i class="fa fa-circle text-success"></i> <span>Online</span></small>
                                </p>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                            <li><a href="javascript:void(0)"><i class="md md-lock"></i> Lock screen</a></li>
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
                                   
                                    <h4 class="page-title">Streamline Inventory System</h4>
                                </div>
                            </div>
                        </div>
<div class="card-box" >
	
<div class="blank">
	

				<div id="all" class="blank-page">

				<iframe src="php/fpdf/inventoryreport.php" width="1050px" height="1000px"></iframe>
				</div>
				
				
			
				
				
			
				
				
				
	       </div>
               
                     </div>

                        </div>
                        
                   
                        <!-- end ro
                   	
                   </div>
                     


                         </div>

         


                    </div>
                    <!-- end container -->
                </div>
                <!-- end content -->

                <footer class="footer text-right">
                    Streamline.
                </footer>

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            <div class="side-bar right-bar">
                <div class="nicescroll">
                    
            </div>
            <!-- /Right-bar -->

        </div>
        <!-- END wrapper -->

	
        <script>
            var resizefunc = [];
        </script>

        <!-- Plugins  -->
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



      <!--Chartist Chart-->
		<script src="plugins/chartist/dist/chartist.min.js"></script>
		<script src="assets/pages/jquery.chartist.init.js"></script>
		
		
		
		
		

  <!-- Nvd3 js -->
        <script src="plugins/d3/d3.min.js"></script>
        <script src="plugins/nvd3/build/nv.d3.min.js"></script>
        <script src="assets/pages/jquery.nvd3.init.js"></script>



		
        
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





////gfhgfhgfhgfhfghfh
function exampleData() {
	  return  [
	      { 
	        "label": "Lime",
	        "value" : <?php echo $totalsheet1?>,
	        "color" : "#00b19d"
	      } , 
	      { 
	        "label": "Two",
	        "value" : 60,
	        'color': '#ef5350'
	      } , 
	      { 
	        "label": "Three",
	        "value" : 39.69895,
	        'color': '#3ddcf7'
	      } , 
	      { 
	        "label": "Four",
	        "value" : 160.45946739256,
	        'color': '#ffaa00'
	      } , 
	      { 
	        "label": "Five",
	        "value" : 89.02525,
	        'color': '#81c868'
	      } , 
	      { 
	        "label": "Six",
	        "value" : 98.079782601442,
	        'color': '#dcdcdc'
	      } , 
	      { 
	        "label": "Seven",
	        "value" : 98.925743130903,
	        'color': '#3bafda'
	      } 
	      
	    ];
	}
	
	
    nv.addGraph(function() {
        var barChart = nv.models.discreteBarChart().x(function(d) {
            return d.label;
        }).y(function(d) {
            return d.value;
        }).staggerLabels(true).tooltips(false).showValues(true).duration(250);
        barChart.yAxis.axisLabel('');
        d3.select('.bar-chart svg').datum(historicalBarChart).call(barChart);
        nv.utils.windowResize(barChart.update);
        return barChart;
    });
	
	
	
    var historicalBarChart = [{
        key: 'Cumulative Return',
        values: [{
            'label': 'Turks Small',
            'value': <?php echo $totalsmall?>,
            'color': '#00b19d'
        }, {
            'label': 'Turks Large',
            'value': <?php echo $totallarge?>,
            'color': '#ef5350'
        }, {
            'label': 'Cayman small',
            'value': <?php echo $catotalsmall?>,
            'color': '#3DDCF7'
        }, {
            'label': 'Cayman large',
            'value': <?php echo $catotallarge?>,
            'color': '#ffaa00'
        }, {
            'label': 'Jamaica Small',
            'value': <?php echo $jatotalsmall?>,
            'color': '#81c868'
        }, {
            'label': 'Jamaica large',
            'value': <?php echo $jatotallarge?>,
            'color': 'red'
        }, {
            'label': 'BTC Small',
            'value': <?php echo $bttotalsmall?>,
            'color': '#333333'
            
        }, {
            'label': 'Sagicor',
            'value': <?php echo $sjtotalsmall?>,
            'color': '#3bafda'
        }]
    }];

function get_stock_field(stock_type, inline_item_id)
	{
		//alert(stock_type);
		///alert(inline_item_id);
		//Variables

		alert(stock_type);
	
		if(stock_type=="PAPER"){
	
				document.getElementById('paper').style.visibility="visible";
			
			//alert(stock_type);
			
			
			
			
			
			
			
		}
}
	

        </script>
     
        
    </body>
</html>
