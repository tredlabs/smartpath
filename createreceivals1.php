<?php
require 'db.php';

	$sql ="SELECT * FROM fields ";
	$result = $mysqli->query($sql);
	
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

                    <title>Receivals</title>

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


<script>
 function selectType()
 {
 	alert();

 
  		
 }

  	function get_partname(){
 	
count += 1;

var partid=document.getElementById('count').value;
alert(partid);
        if(partid){
            $.ajax({
                type:'POST',
                url:'getpartname.php',
                data:'partid='+partid,
                success:function(html){
                    $('#test').html(html);
                    
                }
            })
        }else{
            $('#count').html('<option value="">Select state first</option>'); 
        }
        
    
}
</script>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>  
  <script type="text/javascript"> 
 $(document).ready(function(){  
   
var i= 1;

var count=0;


  	
$(function(){
	$('#add_field1').click(function(){
		getfield(); //this function calls the fields members

	i++;
	count++;
	
		 
		$('#addrow1').append( 
		''+ '<tr><td><select id="count"'+i+'" class="form-control" name="type[]" onChange="get_partname()" ></select></td>' 
		+ '<td><select id="test" class="form-control test"'+count+'" name="name[]"></select></td>'
		+ '<td><input class="form-control"' +count+ '"name="qty[]" type="double"  placeholder=""/></td>'
		+ '<td><input class="form-control"' + count + '" name="unitprice[]" type="double"  placeholder=""/></td>'
		+ '<td><input class="form-control"' + count + '" name="total[]" type="double"  placeholder=""/></td>');
			
				 });
				 });


  function getfield(){

    $.ajax({
      url :"getfield.php",
      method : "POST",
      data :{addNewRow:1,number:1},
      success : function(data){
        $("#count").html(data);//code can run
        
      
      }
    })

 
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
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <div id="sidebar-menu">
                        <ul>
                            <li class="menu-title"></li>

                            <li>
                                <a href= "javascript:void(0);" class="waves-effect waves-primary"><i
                                        class="md md-dashboard"></i><span> Dashboard </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="md md-palette"></i> <span> Inventory </span>
                                 <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li id="fun"><a href="javascript:void(0);">Stock Listing</a></li>
                                    <li><a href="javascript:void(0);">Create Stock</a></li>
                                    
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i
                                        class="md md-invert-colors-on"></i><span> Receivals </span> <span
                                        class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <li id="rec"><a href="javascript:void(0);">View Receivals</a></li>
                                    <li><a href="">Reports</a></li>
                                   
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="md md-redeem"></i>
                                    <span> Purchase Order </span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <!--<li id="pur"><a href="javascript:void(0);">Add Purchase Order</a></li>-->
                             <li id=><a href="Purchase_order.html">Add Purchase Order</a></li>
                                  
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="md md-now-widgets"></i><span> Usage </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="javascript:void(0);">View all Usage</a></li>
                                    <li><a href="javascript:void(0);">Create Usage</a></li>
  
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="md md-view-list"></i><span> Reports </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="javascript:void(0);">Inventory Listing</a></li>
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
                        <div class="clearfix"></div>
                    </div>

                    <div class="clearfix"></div>
                </div>

              <div class="user-detail">
                    <div class="dropup">
                        <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">
                            <img  src="assets/images/users/pic.png" alt="user-img" class="img-circle">
                            <span class="user-info-span">
                                <h5 class="m-t-0 m-b-0"></h5>
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
                                   
                                    <h4 class="page-title">Receivals</h4>
                                </div>
                            </div>
                        </div>
<div class="card-box">
           
                <div class="table-responsive">  
         	<div class="card-box">
                        			<h3 align="right"></h3>
                        	
                        			
                        	
                                        <form action="new.php" method="post">
                        			<div align="left" >
                        		
               
                        			<table>
                        				<th> Receive Date</th>
                        				<th> Invoice Number</th>
                        				<tr>
                        					<td>
                        						<div class="input-group ">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span> 
										</div>
										<input class="form-control " type="date" name="date"placeholder="Received date" required/>
									</div>	
                        						
                        						
                        						</td>
                        					<td>
                        						
                        						
                        						<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-tags"></span> 
										</div>
										<input class="form-control" type="text" name="invoice_no" placeholder="Invoice number" required/>
	
									</div>
                        					
                        						</td>
                        					
                        				</tr>
                        			 	</table>
                                              
	                          	
	                                             <h4>Receivals Item 	</h4>
	                             <div  align="center">                	<br/>
	                                             	
	                                          	
	                         	<table class="table table-responsive col-sm-12 " id="addrow1" >
                        				
                        				
                        				<th> Type</th>
                        				<th> Name</th>
                        				<th> Qty</th>
                        				<th>Unit Price</th>
                        				<th>Total</th>
                        				
                        		
                        		
                        			
                        				</table>               
	                                       	
	                                            	
	                                            	
	                               
                         <button type="button" class=" glyphicon glyphicon-plus btn btn-primary" id="add_field1">Add Item</button>  			
                        		
          	<input class="glyphicon glyphicon-plus btn btn-success " type="submit" name="btnSubmit1"  value="Submit"/>
          	
                        				
                      
                        			</div>
	                                         
	                       	
	                                            	
	                                            	
	                                            	
	                                            	
	                             
	                                	  
	                                	      </form>
	                                	      
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
        <script src="assets/pages/jquery.dashboard.js">
        	
        </script>

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
        
    
    </body>
</html>
