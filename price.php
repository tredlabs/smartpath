<?php

session_start();
//$dir="";   
include 'lnav.php';
require_once("classes/Session_Manager.php");

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

                    <link rel="shortcut icon" href="assets/images/creat.ico">

                    <title>Price Listing</title>

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
                url:"edit.php",  
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
                url:"edit.php",  
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
                url:"edit.php",  
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
                url:"edit.php",  
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
                url:"edit.php",  
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
                url:"edit.php",  
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
                url:"edit.php",  
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
                url:"edit.php",  
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
                        <a href="profile.php" class="logo"><i class="md md-equalizer"></i> <span>Jn Creative Unit</span> </a>
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
 $sql = "SELECT * FROM price";  
$result = $mysqli->query($sql);
$output .= '<div class="table-responsive ">
          <table id="datatable" class="table table-striped table table table-hover m-0">
           <thead>
          <tr>
    
          <th width="10%" >Code</th>
          <th width="10%" >unit_cost</th>
          <th width="10%" >name </th>
          <th width="10%" >sale_cost </th>
            
		    <th width="10%" >size</th>

		   <!--<th width="10%" >Actions</th>-->
		  </tr>
		  </thead>
		   <tbody>
		  <tr>
		  
		       <td id="code"contenteditable></td> 
		       <td id="unit_cost" contenteditable></td>  
                <td id="name"contenteditable></td>  
                <td id="sale_cost" contenteditable></td>
                
                <td id="size" contenteditable></td> 
               		  <!--<td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">Add</button></td>  </tr>-->';
 if(mysqli_num_rows($result) > 0)  
 {  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                  
                     <td class="item" data-id0="'.$row["id"].'"contenteditable>'.$row["code"].'</td>
                       <td class="teritory" data-id1="'.$row["id"].'"contenteditable>'.$row["unit_cost"].'</td>  
                     <td class="80gms" data-id2="'.$row["id"].'"contenteditable>'.$row["name"].'</td>  
                     <td class="75gms" data-id3="'.$row["id"].'"contenteditable>'.$row["sale_cost"].'</td>  
                   
                     <td class="envsmall data-id4="'.$row["id"].'"contenteditable>'.$row["size"].'</td>  
             
                     <!--<td><button type="button" name="delete_btn" data-id10="'.$row["id"].'" class="btn btn-xs btn-danger btn_delete">Delete</button></td>-->
                     
                </tr>  
           ';  
      }  
      $output .= '  
           <tr>
            
                <td id="code"contenteditable></td> 
                 <td id="unit_cost" contenteditable></td>    
                <td id="name"contenteditable></td>  
                <td id="sale_cost" contenteditable></td>
               
                <td id="size" contenteditable></td> 
                
            
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
