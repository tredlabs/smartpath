<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
//error_reporting(E_ALL-E_NOTICE);
//error_reporting(0);
include 'lnav.php';
require 'db.php';
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
				


?>
<!--

-->
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


<!-- Custom Theme files -->
                    <title>Create Stock</title>

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
                                   
                                    <h4 class="page-title">Create Stock</h4>
                                </div>
                            </div>
                        </div>
<div class="card-box" style="overflow: hidden">
            
              
          
               <h3 align="right"></h3>
                        	
                        			
              
                  <div class="" style="overflow-y: auto">
<div id="wrapper" >
       <!----->
      
		 <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
 
 	<!--banner-->	
		  
		    
		
		<!--//banner-->
 	 <!--faq-->
 	<div class="blank">
 <div id="Receival_listing_Message" style="padding: 10px; text-align: center">
			</div>
			<div class="blank-page">  
			<h3 id="headings">Type</h3>
			
				<div class="input-group">

<div class="input-group-addon">

<span class="glyphicon glyphicon-user"></span> 
</div>
<!--<form name="form" method="POST" action="php/creator.php" >-->
	<form name="form" method="POST" action="" autocomplete="off" >
<select class="form-control" id="field" name="field" onchange="check()">
<option value="X">Select One</option>
<?php 
require 'php/db.php';
$sql="Select * from fields"; 
$result=$conn->query($sql);

$post=$_POST['field'];
if ($result ->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    
$name= $row["name"];
json_encode($name);
echo "  <option $name>$name</option> ";
	
    }
} else {

}

?>
</select>


</div>
	        	<hr style="color:grey;">
<h3 id="headings">Item</h3>
<div id="fields">
	
<?php 
$x=$_REQUEST['id'];
session_start();
$_SESSION['name']=$x;
require 'php/db.php';




$sql2="Select * from fields WHERE name='$x'"; 
$result2=$conn->query($sql2);

if ($result2 ->num_rows > 0) {

    while($row2 = $result2->fetch_assoc()) {
    	 $name= $row2["name"];
 $id= $row2["id"];   


// this load the form for Papers
if($id ==$id){

	
echo "<table id='fieldstable'>
    <tr><td>Code: </td><td><input type='text' class='form-control' style='width:100%;' name='code'  id='code' /></td>
	<tr><td>Name: </td><td><input type='text' class='form-control' style='width:100%;' name='name'  id='name' /></td><!--<td><select class='form-control' style='width:100%;' name='ptype'  id='ptype'><option value='' disabled selected>Select Type</option><option>Text</option><option>Card</option><option>Matte</option><option>Gloss</option></select></td>--></tr>
	<tr><td>Location: </td><td><select class='form-control' style='width:100%;' name='locatio'  id='location'> <option value='' hidden selected>Select</option><option value='Warehouse1'>Printery</option><option value='Warehouse2'>Office</option><option value='Warehouse3'>Events</option></select></td></tr>   

	<tr><td>Quantity: </td><td><input type='text' class='form-control' style='width:270%;' name='singles' id='singles' /></td></tr>
	<tr><td>Reorder Level: </td><td><input type='text' class='form-control' style='width:270%;' name='reorder' id='reorder' /></td></tr>
	<tr><td></td><td><input type='hidden' class='form-control' style='width:270%;' name='type' id='type' value='$name' /></td></tr>

	</table>";
//name4 is boxes which is times by 5000	pre box
//name5 is singles
	
}





    }
} else {
   
}



?>

</div>




<!--<hr style="color:grey;">
<h3 id="headings">Stock Numbers</h3>
<div id="numbers">
<table id="fieldstable">

<tr><td>* Instock: </td><td><input type="text" class="form-control" style="width:270%;" name="instock" id="instock"/></td></tr>
<tr><td>* Re-Order Level: </td><td><input type="text" class="form-control" style="width:270%;" name="reorder"  id="reorder"/></td></tr>
<tr><td>* Price: </td><td><input type="number"  min="1" step="0.01" class="form-control" style="width:270%;" name="price" id="price"/></td></tr>-->

</table>
<hr style="color:red;">
<center><input type="submit" class="btn btn-info" value="Create Stock" id="create" name="create" onclick="createStock();"/> <input type="reset" class="btn btn-danger btn-xs" value="Clear Entries" id="clear" onclick="clear();" name="clear"/>
</center></div>
</form>
<div id="txtbxs">



</div>
				
	</div>
	</div>
	<!--//faq-->
		<!---->
<div class="copy">
            
		
		</div>
		</div>
		<div class="clearfix"> </div>
       </div>
       </div>
     </div>
  </div>
	  </div>
	<script>
	
	
	
	
		function createStock()
	{
		
		var type = document.getElementById("type").value;
		
	
		
		//alert("start");
		
		var code = document.getElementById("code").value;
	    var paperName = document.getElementById("name").value;
		var location = document.getElementById("location").value;
		
		var Singles = document.getElementById("singles").value;
		var reorder = document.getElementById("reorder").value;
		//var ptype = document.getElementById("ptype").value;

	    var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
				//alert(type);
					alert(xhttp.responseText);
					document.getElementById("Receival_listing_Message").innerHTML = xhttp.responseText;
					$('#Receival_listing_Message').delay(5000).fadeOut(400);
					document.getElementById("code").value="";
					document.getElementById("name").value="";
					//document.getElementById("ptype").value="";
					document.getElementById("location").value="";
					
					
					document.getElementById("singles").value="";
					document.getElementById("reorder").value="";
			
				
				}
				else
				{
					//alert(xhttp.responseText);
					//alert("An error occured while trying to get the data you requested");
				}
			}
		};
		xhttp.open("POST", "addCreate.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("&code="+code+"&location="+location+"&singles="+Singles+"&name="+paperName+"&type="+type+"&reorder="+reorder);
		
	
	
	
	}
function clear(){
	

	 $(this).closest('form').find("input[type=text]").val("");
	
	
}


	
$(document).ready(function() {
var m = window.location.search.match(/id=([^&]*)/);

if (m) { 
    // => alerts "test"
$('#field').val(m[1]);

} 


	if(m[1]=="ENVELOPE"){
		var element = document.getElementById("BOX");
		
		element.setAttribute("onkeyup", "change()");
		
		var element2 = document.getElementById("SINGLES");
		
		element2.setAttribute("onkeyup", "change2()");
	
		
		
	}

});



function check(){
	
var fields = document.getElementById("field");

if(fields.selectedIndex == 0) {
	
     alert('select one answer');
}
else {
	
    var selectedText = fields.options[fields.selectedIndex].text;

//	var id=selectedText;


	//alert(selectedText);
	window.location.href = "createstock.php?id=" + selectedText; 
	

    
	
}
}
</script>


          
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
        <!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->

    
    </body>
</html>

