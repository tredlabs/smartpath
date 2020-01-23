



<?php

session_start();
$dir="";
require_once($dir."classes/Session_Manager.php");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();



    $username = $_SESSION['username'];
	  // $name = $_SESSION['name'];

            
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

                    <link rel="shortcut icon" href="assets/images/ssl.ico">

                    <title>Welcome <?= $name?></title>

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
                    
                    
                    
                     <!-- Datatables-->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="plugins/datatables/jszip.min.js"></script>
        <script src="plugins/datatables/pdfmake.min.js"></script>
        <script src="plugins/datatables/vfs_fonts.js"></script>
        <script src="plugins/datatables/buttons.html5.min.js"></script>
        <script src="plugins/datatables/buttons.print.min.js"></script>
        <script src="plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="plugins/datatables/dataTables.scroller.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>
        
           <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
            TableManageButtons.init();

        </script>
    
                    

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        

<script>

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
      
      
 	/* $(document).on('click', '.80gms', function(){ //call function to get stock data from database 
        

           var id = $(this).data("id2");  
           var name = $(this).text();  
           edit_data(id, name, "80gms");  
            
      });  */
      
                 //this is to edit the price list
          $(document).on('blur', '.80gms', function(){  
          	

           var id = $(this).data("id2");  
           var name = $(this).text();  
           edit_data(id, name, "80gms");  
      });
         

     function edit_data(id, text, name)  
      {   
      	     
           $.ajax({  
                url:"editprice.php",  
                method:"POST",  
                data:{id:id, text:text, column_name:name},  
                dataType:"text",  
                success:function(data){  
                     //alert(data);  
                }  
           }); 
          
      }
      $(document).on('blur', '.75gms', function(){  
           var id = $(this).data("id3");  
           var name = $(this).text();  
           edit_data(id, name, "75gms");  
      });
         

     function edit_data(id, text, name)  
      {  
           $.ajax({  
                url:"editprice.php",  
                method:"POST",  
                data:{id:id, text:text, column_name:name},  
                dataType:"text",  
                success:function(data){  
                     //alert(data);  
                }  
           });  
      }
       $(document).on('blur', '.envsmall', function(){  
           var id = $(this).data("id4");  
           var name = $(this).text();  
           edit_data(id, name, "envsmall");  
      });
         

     function edit_data(id, text, name)  
      {  
           $.ajax({  
                url:"editprice.php",  
                method:"POST",  
                data:{id:id, text:text, column_name:name},  
                dataType:"text",  
                success:function(data){  
                     //alert(data);  
                }  
           });  
      }
       $(document).on('blur', '.9*12', function(){  
           var id = $(this).data("id5");  
           var name = $(this).text();  
           edit_data(id, name, "9*12");  
      });
         

     function edit_data(id, text, name)  
      {  
           $.ajax({  
                url:"editprice.php",  
                method:"POST",  
                data:{id:id, text:text, column_name:name},  
                dataType:"text",  
                success:function(data){  
                     //alert(data);  
                }  
           });  
      }
       $(document).on('blur', '.10*12', function(){  
           var id = $(this).data("id6");  
           var name = $(this).text();  
           edit_data(id, name, "10*12");  
      });
         

     function edit_data(id, text, name)  
      {  
           $.ajax({  
                url:"editprice.php",  
                method:"POST",  
                data:{id:id, text:text, column_name:name},  
                dataType:"text",  
                success:function(data){  
                     //alert(data);  
                }  
           });  
      }
       $(document).on('blur', '.12*15', function(){  
           var id = $(this).data("id7");  
           var name = $(this).text();  
           edit_data(id, name, "12*15");  
      });
         

     function edit_data(id, text, name)  
      {  
           $.ajax({  
                url:"editprice.php",  
                method:"POST",  
                data:{id:id, text:text, column_name:name},  
                dataType:"text",  
                success:function(data){  
                     //alert(data);  
                }  
           });  
      }
       $(document).on('blur', '.sheet1', function(){  
           var id = $(this).data("id8");  
           var name = $(this).text();  
           edit_data(id, name, "sheet1");  
      });
         

     function edit_data(id, text, name)  
      {  
           $.ajax({  
                url:"editprice.php",  
                method:"POST",  
                data:{id:id, text:text, column_name:name},  
                dataType:"text",  
                success:function(data){  
                     //alert(data);  
                }  
           });  
      }
       $(document).on('blur', '.sheet2', function(){  
           var id = $(this).data("id9");  
           var name = $(this).text();  
           edit_data(id, name, "sheet2");  
      });
         

     function edit_data(id, text, name)  
      {  
           $.ajax({  
                url:"editprice.php",  
                method:"POST",  
                data:{id:id, text:text, column_name:name},  
                dataType:"text",  
                success:function(data){  
                     //alert(data);  
                }  
           });  
      }
      

     
      
      
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
                                  
                                  
                                  	<?php
					$Session_Manager = new Session_Manager();
					$sid = $Session_Manager->get_custom_SID();
					
					$role = $_SESSION[$sid]['role'];
				
					?>
                  								
		  <li id="cur" style="display: none"><a href="createstock.php">Create Stock</a></li>
			   
                                  
                                </ul>
                                 
                            
                               
                            </li>
                            
                 <li class="has_sub">
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
                                  
                                </ul>
                            </li>
				
			
                            

                            <li class="has_sub">
                                <a href="usage.php" class="waves-effect waves-primary"><i class="md md-now-widgets"></i><span> Usage </span> <span class="menu-arrow"></span></a>
                           
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="md md-view-list"></i><span> Reports </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="inventoryreport.php">Inventory Listing</a></li>
                                    
                                    <!-- <li><a href="reportbydate.php">Date</a></li>-->
                                    
                                    <li><a href="usagereport.php">Usage Reports</a></li>
                                    <li><a href="receival_report.php">Receivals Reports</a></li>
                                    <li><a href="javascript:void(0);">Purchase Reports</a></li>
                     
                                </ul>
                            </li>

                     
    <li class="has_sub" id="tool" style="display: block">
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="md md-view-list"></i><span> Tools </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="price.php">Price Listing</a></li>
                              
                             
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
                            <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                            <li><a href="javascript:void(0)"><i class="md md-lock"></i> Lock screen</a></li>
                            <li><a href="logout.php"><i class="md md-settings-power"></i> Logout</a></li>
                        </ul>

                    </div>
                </div>
            </div>
            <!-- Left Sidebar End --> 
            <!-- Left Sidebar End --> 


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page" style=" overflow-y: auto;">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                   
                                    <h4 class="page-title">Price List</h4>
                                </div>
                            </div>
                        </div>
<div class="card-box" style=" overflow-y: auto;">
           
                <div class="table table-striped custab "style="overflow-y:hidden">  
         
                     
                     
                     
                    <div id="live_data" style="overflow-x:hidden"></div>                 
                
                <?php  

require 'db.php';

 $output = '';  
 $sql = "SELECT * FROM pricefinal";  
$result = $mysqli->query($sql);
$output .= '<div class="table-responsive ">
          <table id="datatable" class="table table-striped table table table-hover m-0">
           <thead>
          <tr>
    
          <th width="10%" >Item</th>
          <th width="10%" >Teritory</th>
          <th width="10%" >80gms </th>
          <th width="10%" >75gms </th>
            
		    <th width="10%" >Envsmall</th>
		    <th width="10%" >9*12</th>
		    <th width="10%" >10*12</th>
		    <th width="10%" >12*15</th>
		    <th width="10%" >Sheet1</th>
		    <th width="10%" >Sheet2</th>
		   <!--<th width="10%" >Actions</th>-->
		  </tr>
		  </thead>
		   <tbody>
		  <tr>
		  
		       <td id="item"contenteditable></td> 
		       <td id="teritory" contenteditable></td>  
                <td id="80gms"contenteditable></td>  
                <td id="75gms" contenteditable></td>
                
                <td id="envsmall" contenteditable></td> 
                <td id="9*12" contenteditable></td>
                <td id="10*12" contenteditable></td> 
                <td id="12*15" contenteditable></td> 
                <td id="sheet1" contenteditable></td> 
                <td id="sheet2" contenteditable></td>   
		  <!--<td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">Add</button></td>  </tr>-->';
 if(mysqli_num_rows($result) > 0)  
 {  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                  
                     <td class="item" data-id0="'.$row["id"].'"contenteditable>'.$row["item"].'</td>
                       <td class="teritory" data-id1="'.$row["id"].'"contenteditable>'.$row["teritory"].'</td>  
                     <td class="80gms" data-id2="'.$row["id"].'"contenteditable>'.$row["80gms"].'</td>  
                     <td class="75gms" data-id3="'.$row["id"].'"contenteditable>'.$row["75gms"].'</td>  
                   
                     <td class="envsmall data-id4="'.$row["id"].'"contenteditable>'.$row["envsmall"].'</td>  
                     <td class="9*12" data-id5="'.$row["id"].'"contenteditable>'.$row["9*12"].'</td>  
                     <td class="10*12" data-id6="'.$row["id"].'"contenteditable>'.$row["10*12"].'</td>
                     <td class="12*15" data-id7="'.$row["id"].'"contenteditable>'.$row["12*15"].'</td>
                     <td class="sheet1" data-id8="'.$row["id"].'"contenteditable>'.$row["sheet1"].'</td>
                     <td class="sheet2" data-id9="'.$row["id"].'"contenteditable>'.$row["sheet2"].'</td>
                     <!--<td><button type="button" name="delete_btn" data-id10="'.$row["id"].'" class="btn btn-xs btn-danger btn_delete">Delete</button></td>-->
                     
                </tr>  
           ';  
      }  
      $output .= '  
           <tr>
            
                <td id="item"contenteditable></td> 
                 <td id="teritory" contenteditable></td>    
                <td id="80gms"contenteditable></td>  
                <td id="75gms" contenteditable></td>
               
                <td id="envsmall" contenteditable></td> 
                <td id="9*12" contenteditable></td>
                <td id="10*12" contenteditable></td> 
                <td id="12*15" contenteditable></td> 
                <td id="sheet1" contenteditable></td> 
                <td id="sheet2" contenteditable></td>   
            
                <!--<td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">Add</button></td>--> 
           </tr>  
      ';  
 }  
 else  
 {  
      $output .= '<tr>  
                          <td colspan="4">Data not Found</td>  
                     </tr>';  
 }  
 $output .= '</tbody> </table>  
      </div>';  
 echo $output;  
 ?>
 
                
                
                
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

        
        <script type="text/javascript">
           $().DataTable()   

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
