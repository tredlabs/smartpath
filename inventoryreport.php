<?php

require('mysql_table.php');
require 'db.php';
include 'lnav.php';
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
          <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
                    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
                    <meta name="author" content="Coderthemes">

                    

                    <title>Lunch Room</title>

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

var inline_item_index=0;
	var edit_new_inline_item_index=0;
	
	//Dynamically get all the types

					




//Global JS variables
	
 showframe()
    {
    	alert('love');
    	 document.getElementById('myframe').style.visibility="visible";
    	
    }



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
          
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
        

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
                                   
                                    <h4 class="page-title">Pembroke Hall HS</h4>
                                </div>
                            </div>
                        </div>
<div class="card-box" >


<div id="wrapper">
       <!----->
     
		 <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
 
 	<!--banner-->	
		     <div class="banner">
		    	<h4>
				<a id="full" href="#"><i class="fa fa-bar-chart"></i> Path Students list </a>  &nbsp &nbsp &nbsp
				
				<!---<a id="date" href="#"><i class="fa fa-calendar-check-o"></i>  Book Listing By Date </a>  &nbsp &nbsp &nbsp-->
				
		
				
				
				
				</h4>
		    </div>
		<!--//banner-->
 	 <!--faq-->
 	<div class="blank">
	
	<div id="warehouse" class="blank-page">
				
			
				
				<form method="GET" action="php/fpdf/inventoryreport.php" target="frame">
				Location:<select class="form-control" id="loc" name="loc" onchange="">
<option value='Students' selected>Students</option></select>



</select>
<br>

<input type="submit" style="width:100%;" class="btn btn-info" value="Search..." id="typebtn" name="typebtn" onclick="showDiv()"/>
				
				</form>
				<center>
					<div id="myframe">
						
						</br></br>
				<iframe src="" width="1040px" height="1000px" id="frame" name="frame"></iframe>
				</div>
				</center>
				</div>
			</center>	
			
				
				<div id="bytype" class="blank-page">
				
			
				
				<form method="GET" action="php/fpdf/inventbytype.php" target="frame2">
				
				Location:<select class="form-control" id="location1" name="location1" onchange="add_field();" required>
                <option value='' hidden selected>Select</option><option value='Warehouse1'>Book Room</option></select>
	
				</br>		

<br>
<div id="sel">
				
				</div>

</br>
				</br>	

<input type="submit" style="width:100%;" class="btn btn-info" value="Search..." id="typebtn" name="typebtn" onclick="showDiv1()"/>
				
				</form>
				<center>
					<div id="myframe1">
						
						</br></br>
				<iframe src="" width="1040px" height="1000px" id="frame2" name="frame2"></iframe>
				</div>
				</center>
				</div>
				
				
			
				
				
				
				
				<div id="bydate" class="blank-page">
				<form method="GET" action="php/fpdf/inventbydate.php" target="frame1">
				Location:<select class="form-control" id="field" name="field" onchange="" required>
              <option value='' hidden selected>Select</option><option value='Warehouse1'>Printery</option><option value='Warehouse2'>Office</option><option value='Warehouse3'>Events</option></select>
	
				</br>	
				<center>
				From: <input type="date" class="form-control" style="width:40%; display:inline;" id="from" name="from"/> To: <input type="date"  style="width:40%; display:inline;" class="form-control" id="to" name="to"/>
				<br>
				<br>
				<input type="submit" style="width:100%;" class="btn btn-info" value="Search..." id="datebtn" name="datebtn" onclick="showDiv2()"/>
				</center>
				</form>
				</br></br></br>
				
				<center>
				<div id="myframe2">
					<iframe src="" width="1040px" height="1000px" id="frame1" name="frame1"></iframe>
			</div>
				</div>
			
				
				</center>
				
	       </div>
	
	<!--//faq-->
		<!---->

		</div>
		</div>
		<div class="clearfix"> </div>
       </div>
     
<!---->
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->

	<script>
	function type2()
	{
	
     var location=document.getElementById('location1').value;
	
	if(location=="Warehouse1")
	{
		<?
		$type="fields";
		
		?>
	}
	
	
	
	
	if(location=="Warehouse2")
	{
		<?
		$type="office_type";
		
		?>
	}
	

		
	}
	
	
	
	function showDiv() {
   document.getElementById('myframe').style.display = "block";
}
	function showDiv2() {
   document.getElementById('myframe2').style.display = "block";
}


	function showDiv1() {
   document.getElementById('myframe1').style.display = "block";
}
	
	
	 $(document).ready(function(){
	// document.getElementById('myframe').style.visibility="hidden";
	document.getElementById("myframe").style.display = "none";
	document.getElementById("myframe2").style.display = "none";
	document.getElementById("myframe1").style.display = "none";
	 jQuery('#bytype').toggle('hide');
	 jQuery('#bydate').toggle('hide');
	 
});


jQuery(document).ready(function(){
        jQuery('#full').on('click', function(event) {    
			
             jQuery('#warehouse').toggle('show');
			jQuery('#bytype').hide();
			jQuery('#bydate').hide();
			
        });
		jQuery('#date').on('click', function(event) {        
           
			  jQuery('#bydate').toggle('show');
			jQuery('#bytype').hide();
			jQuery('#all').hide();
			jQuery('#warehouse').hide();
						 
        });
		jQuery('#type').on('click', function(event) {        
          	  jQuery('#bytype').toggle('show');
          	  
			jQuery('#bydate').hide();
			jQuery('#all').hide();
			jQuery('#warehouse').hide();
			
						 
        });
    });
    
   
	</script>




               
                     </div>
                     <div id="fields">
                     	
                     	
                     	
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
	
	
	
	function reportDate()
	{
		alert('start');
	
		 var from = document.getElementById("from").value;
		 var to = document.getElementById("to").value;

alert(from);
		
		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					
						//$('#frame1').attr('src', 'php/fpdf/inventbydate.php');
				alert('working');
				alert(to);
			
					document.getElementById("from").value="";
					document.getElementById("to").value="";
		
					//document.getElementById("frame1").src = "php/fpdf/inventbydate.php";
					//document.getElementById("Message").innerHTML = "Usage Created";
				//	$('#Message').delay(5000).fadeOut(400)
					//add_fields();
					$('#frame1').attr('src', 'php/fpdf/inventbydate.php');
				}
				else
				{
					//alert(xhttp.responseText);
					alert("An error occured while trying to get the data you requested");
				}
			}
		};
			xhttp.open("GET", "php/fpdf/inventbydate.php?from="+from+"&to="+to, true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		//xhttp.send("Query=Add_Usage&Invoice_Number="+Invoice_Number+"&Usagedate="+Usagedate+"&Inline_items="+Inline_items_Sringyfied);
		xhttp.send();
		//alert(Inline_items_Sringyfied );
		//alert("End");
		
	}

	
	

        </script>
     
        
    </body>
</html>
