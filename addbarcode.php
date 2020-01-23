<?php
session_start();

error_reporting(E_ALL & ~E_NOTICE);
//error_reporting(E_ALL-E_NOTICE);
//error_reporting(0);
include 'lnav.php';

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
                    <title>Barcode</title>

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
<!--  <link href="css/pic.css" rel="stylesheet" type="text/css">
  <script src="js/pic.js"> </script>-->
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


	
	function switch_page(index)
	{
		switch (index)
		{
			case 0:
			Barcodestudents();
			document.getElementById("_Receival1").style.display = "none";
			    document.getElementById("try2").style.display = "none";
				document.getElementById("try").style.display = "block";
				document.getElementById("_Receival").style.display = "none";
					//$('div.dataTables_filter input').clear();
					$('div.dataTables_filter input').focus();
				break;
				
			case 1:
			document.getElementById("_Receival1").style.display = "none";
				document.getElementById("Enter_Receival").style.display = "block";
				document.getElementById("Receival_listing").style.display = "none";
				document.getElementById("_Receival").style.display = "none";
				document.getElementById("try2").style.display = "none";
				break;
				
			case 2:
			document.getElementById("_Receival").style.display = "block";
			document.getElementById("try").style.display = "none";
			$('#barcode').focus();
			document.getElementById("try2").style.display = "none";
			document.getElementById("_Receival1").style.display = "none";
				break;
				
			case 5:
			document.getElementById("_Receival1").style.display = "block";
			document.getElementById("try").style.display = "none";
			$('#barcode').focus();
			document.getElementById("try2").style.display = "none";
				break;	
				
				
				
				case 4:
			assignBarcode();
			document.getElementById("_Receival1").style.display = "none";
				document.getElementById("try2").style.display = "block";
				document.getElementById("_Receival").style.display = "none";
				document.getElementById("try").style.display = "none";
					document.getElementById("Enter_Receival").style.display = "none";
					//$('div.dataTables_filter input').clear();
					//$('div.dataTables_filter input').focus();
				break;
				
				
				
		}
	}
	function stocks(sid){
	//var sid=sid;
	//alert(sid);
	//localStorage.setItem('sid',sid);
}


function Barcodestudents(){


	    $.ajax({  
                url:"ajax_stu.php",  
                method:"POST",  
                success:function(data){  
              $('#try').html(data);  
      
                }  
           }); 
           
     

}


function assignBarcode(){


	    $.ajax({  
                url:"ajax_bcode.php",  
                method:"POST",  
                success:function(data){  
              $('#try2').html(data);  
      
                }  
           }); 
           
     

}








function reload(){
    setTimeout(function(){location.reload()}, 3000);
    var timer = null;
  }

function Add_barcode()
	{
		

		     var id=document.getElementById('item_id').value;
	               var name=document.getElementById('fullname').value;
				    var barcode=document.getElementById('barcode').value;
					var dob=document.getElementById('dob').value;
				// alert(barcode);	
					var qty=1;
				//alert(location);	
	
		//alert(name);
		if(barcode==""){
			alert('Please Enter Barcode');
			exit();
		}

		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					
		
					
							var result=xhttp.responseText;
			
				
					if (result.match(/Already Added.*/)) {
						alert(xhttp.responseText);
						//x=0;
                      //  alert('match');
                      //  remove();
                           	document.getElementById("barcode").value = "";              
                        
                        //switch_page(1);
                       }
					
					
							if (result.match(/Barcode Successfully Assign.*/)) {
								alert(xhttp.responseText);
								
					//	document.getElementById("Message").innerHTML =xhttp.responseText;
				//	$('#Message').delay(5000).fadeOut(400);
					 var name=document.getElementById('fullname').value="";
				    var barcode=document.getElementById('barcode').value="";
					var dob=document.getElementById('dob').value="";
				switch_page(0);
				
                       }
					
					
	
	
				}
				else
				{
					//alert(xhttp.responseText);
					alert("An error occured while trying to get the data you requested");
				}
			}
		};
		xhttp.open("POST", "php/Query_Manager.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("Query=Assign_barcode&id="+id+"&barcode="+barcode+"&name="+name+"&dob="+dob);
		
		//alert("Stop");
	}


function update_barcode()
	{
		
		
		
	
		   
		     var id=document.getElementById('item_id1').value;
	               var name=document.getElementById('fullname1').value;
				    var barcode=document.getElementById('barcode1').value;
					var dob=document.getElementById('dob1').value;
				// alert(barcode);	
					var qty=1;
				//alert(id);	
	
		//alert(name);

		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					
					
					
						var result=xhttp.responseText;
			
				
					if (result.match(/Already Exist.*/)) {
						alert(xhttp.responseText);
						//x=0;
                      //  alert('match');
                      //  remove();
                           	//document.getElementById("barcode").value = "";              
                        
                        //switch_page(1);
                       }
					
					
							if (result.match(/Updated.*/)) {
								alert(xhttp.responseText);
								
		
		//document.getElementById("Message").innerHTML =xhttp.responseText;
				//	$('#Message').delay(5000).fadeOut(400);
					 var name=document.getElementById('fullname1').value="";
				    var barcode=document.getElementById('barcode1').value="";
					var dob=document.getElementById('dob1').value="";
				switch_page(4);
				
                       }
					
	
				}
				else
				{
					//alert(xhttp.responseText);
					alert("An error occured while trying to get the data you requested");
				}
			}
		};
		xhttp.open("POST", "php/Query_Manager.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("Query=update_barcode&id="+id+"&barcode="+barcode+"&name="+name+"&dob="+dob);
		
		//alert("Stop");
	}








function Show_Receival(id)
	{
		var location="Students";
		//alert(id);
		//Variables
		switch_page(2);
		
		//Switch views to show the receival page -Gavin Palmer || March 2016
		
		
		//Get and display basic receival information -Gavin Palmer || March 2016
		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
					
				if(xhttp.status == 200)
				{
					//alert('Start');
					//alert(id);
				  // alert(xhttp.responseText);
					var receival_object = JSON.parse(xhttp.responseText);
					
					document.getElementById('item_id').value =id;
					var name=receival_object.fname+' '+receival_object.lname;
					document.getElementById('fullname').value=name;
				    document.getElementById('dob').value = receival_object.dob;
		//alert(id);
			
				switch_page(2);
			
				}
				else
				{
					alert("An error occured while trying to get the data you requested: "+xhttp.responseText);
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Add_barcode&id="+id+"&location="+location, true);
		xhttp.send();
		
		
		
		//alert('Stop');
	}
	
	
	
	function Show_Receival1(id)
	{
		var location="Barcode";
		//alert(id);
		//Variables
		
		
		//Switch views to show the receival page -Gavin Palmer || March 2016
		
		
		//Get and display basic receival information -Gavin Palmer || March 2016
		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
					
				if(xhttp.status == 200)
				{
					//alert('Start');
					//alert(id);
				  // alert(xhttp.responseText);
					var receival_object = JSON.parse(xhttp.responseText);
					
					document.getElementById('item_id1').value =id;
					document.getElementById('fullname1').value=receival_object.name;
				    document.getElementById('dob1').value = receival_object.dob;
				    document.getElementById('barcode1').value = receival_object.barcode;
		//alert(id);
			
				switch_page(5);
			
				}
				else
				{
					alert("An error occured while trying to get the data you requested: "+xhttp.responseText);
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Add_barcode1&id="+id+"&location="+location, true);
		xhttp.send();
		
		
		
		//alert('Stop');
	}
	
	
	
	
	
	
	
	function Remove_Usage(id)
	{
		//alert("start");
		var location="Warehouse2";
		var xhttp = new XMLHttpRequest();
		
		//Confirm before action is taken
		/*var action = confirm("Are you sure?");
		
		if(action==false)
		{
		return false;
		}*/
		
	
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					//alert(xhttp.responseText);
					document.getElementById("Receival_listing_Message").innerHTML = xhttp.responseText;
					$('#Receival_listing_Message').delay(5000).fadeOut(400);
					$('#Listing_row_'+id).delay(1000).fadeOut(400);
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Remove_Stock&id="+id+"&location="+location, true);
		xhttp.send();
		//alert("stop");
	}
	
	function Remove_barcode(id)
	{
		//alert("start");
		var location="Barcode";
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
				//	document.getElementById("Receival_listing_Message").innerHTML = xhttp.responseText;
				//	$('#Receival_listing_Message').delay(5000).fadeOut(400);
					$('#Listing_row_'+id).delay(1000).fadeOut(400);
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Remove_barcode&id="+id+"&location="+location, true);
		xhttp.send();
		//alert("stop");
	}
	
	
	//_______________________________[Loaded functions to b executed when the page is ready]______s________________________________________________
	$(document).ready(function()
	{
		Barcodestudents();
		
		
		
		   var oTable = null;
		 oTable = $('#datatable-fixed-header').dataTable( {
                 "sPaginationType": "full_numbers",
                 "aaSorting": [[ 0, "asc" ]],
                 "iDisplayLength": 50,
                 "oLanguage": {
                 "sLengthMenu": 'Show <select>'+
                            
                             
                                '<option value="50">50</option>'+
                                '<option value="100">100</option>'+
                                '<option value="150">150</option>'+
                                '<option value="200">200</option>'+
                                '<option value="-1">All</option>'+
                                '</select> entries'
                  }
             } );
		
		$('div.dataTables_filter input').focus();
		
		



	});
	
-->
</script>
<script>

 
 
 
 </script>      
    </head>


    <body onload="" class="fixed-left">
        
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
                                   
                                    <h4 class="page-title">Path Barcode</h4>
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
		     <div class="banner" id="usg1" style="display:block">
		    	
		    	<h5>
		    		<a href="#" onClick="switch_page(0);" style="color: #22A7F0;">Path Students Listing</a> &nbsp;&nbsp; &nbsp;&nbsp;
		    		<a href="#" onClick="switch_page(4);" style="color: #22A7F0;">Assigned Barcode</a> &nbsp;&nbsp; &nbsp;&nbsp;
		    		
				
			
				<!--span>Receival listing</span-->
			
					
											
			
				</h5>
		    </div>
		<!--//banner-->
 	 <!--faq-->
 	<div id="Receival_listing" class="blank" style="overflow-y: none;">
		
	
		
		<!--Adding in page info-->
		








                        <div id="try" class="row" style="display: block">
                        	
                
                        </div>
	<div id="_Receival" class="blank" style="display: none;  font-size: ; font-weight: ; ">
		<div style="padding: 10px; text-align: center; color: #22A7F0;">
			 Student Info
		</div>
		<form id="_Create_ID" data-toggle="validator" role="form" class="" autocomplete="off" onsubmit="return false">
			<div class="form">
				<div class="row col-md-12 custyle">
					             
					             
					             	<div class="input-group" style="display: none">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-tags"></span> 
										</div>
										<input class="form-control" id="item_id" name="item_id" type="number" placeholder="ID"/>
									</div>
									
									
									<div class="input-group">
										<div class="input-group-addon">Full Name
											<span class=""></span> 
										</div>
										<input class="form-control" id="fullname" name="fullname" type="text" placeholder="Full name" disabled=""/>
									</div>
					             <br>
										<div class="input-group">
										<div class="input-group-addon">D.O.B
											<span class=""></span> 
										</div>
										<input class="form-control" id="dob" name="dob" type="text" placeholder="D.O.B" readonly=""/>
									</div>
									<div class=""></div>
								<br>
			
									
										<div class="input-group">
										<div class="input-group-addon">Barcode
											<span class=""></span> 
										</div>
										<input class="form-control" id="barcode" name="barcode" type="text" placeholder="Barcode"/>
									</div>
									<br>
									
									
									<div class=""></div>
				<br/>
				</div>
					
				<hr style="height: 1px; width: 100%; background-color: #999999;"/>
					
				<div id="Message" style="padding: 10px; text-align: center">
				</div>
					
				<div id="fields_">

				</div>
				
				<div id="new_fields_">
				
				</div>
				
				
				<center>
					<button type="submit" id="" class="btn btn-success" style="width: 80%; border-radius: 10px;" onClick="Add_barcode();">Process&nbsp;<span class="glyphicon glyphicon-plus-sign"></span></button>
				</center>
			</div><!-- End of form group  -->
		</form>
	</div>

	 <div id="try2" class="row" style="display: block">
                        	
        
                        </div>	
                        
                        
                        
             	<div id="_Receival1" class="blank" style="display: none;  font-size: ; font-weight: ; ">
		<div style="padding: 10px; text-align: center; color: #22A7F0;">
			 Student Info
		</div>
		<form id="_Create_ID" data-toggle="validator" role="form" class="" autocomplete="off" onsubmit="return false">
			<div class="form">
				<div class="row col-md-12 custyle">
					             
					             
					             	<div class="input-group" style="display: none">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-tags"></span> 
										</div>
										<input class="form-control" id="item_id1" name="item_id1" type="number" placeholder="ID"/>
									</div>
									
									
									<div class="input-group">
										<div class="input-group-addon">Full Name
											<span class=""></span> 
										</div>
										<input class="form-control" id="fullname1" name="fullname1" type="text" placeholder="Full name" disabled=""/>
									</div>
					             <br>
										<div class="input-group">
										<div class="input-group-addon">D.O.B
											<span class=""></span> 
										</div>
										<input class="form-control" id="dob1" name="dob1" type="text" placeholder="D.O.B" readonly=""/>
									</div>
									<div class=""></div>
								<br>
			
									
										<div class="input-group">
										<div class="input-group-addon">Barcode
											<span class=""></span> 
										</div>
										<input class="form-control" id="barcode1" name="barcode1" type="text" placeholder="Barcode"/>
									</div>
									<br>
									
									
									<div class=""></div>
				<br/>
				</div>
					
				<hr style="height: 1px; width: 100%; background-color: #999999;"/>
					
				<div id="Message" style="padding: 10px; text-align: center">
				</div>
					
				<div id="fields_">

				</div>
				
				<div id="new_fields_">
				
				</div>
				
				
				<center>
					<button type="submit" id="" class="btn btn-success" style="width: 80%; border-radius: 10px;" onClick="update_barcode();">Update&nbsp;<span class="glyphicon glyphicon-plus-sign"></span></button>
				</center>
			</div><!-- End of form group  -->
		</form>
	</div>           
                        
	
	
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
       </div>
       </div>
       </div></div></div></div>
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













        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "../plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                //var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
                
                $('#_Create_ID').validator();
                
                $('#_Create_ID').validator().on('submit', function (e)
		{
			var no_error=true;
			
			e.preventDefault();
			
			if(e.isDefaultPrevented())
		  	{
				
				if($("#barcode").val() == null || $("#barcode").val() === "")
				{
					no_error=false;
				}
				
				Add_barcode(no_error);
				//$('#_submit').prop('disabled', true);
		  	}
		 	 else
		  	{
				// everything looks good!
				//alert("everything is good");
		  	}
		})
                
                
                
            } );
            TableManageButtons.init();

        </script>
        
        <!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->

    
    </body>
</html>
