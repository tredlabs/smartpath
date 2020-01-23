<?php
include 'reorder.php';
session_start();
require 'db.php';
include 'lnav.php';
error_reporting(E_ALL & ~E_NOTICE);

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
                    <link rel="shortcut icon" href="assets/images/pem.ico">
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
                    <title>Lunch Room</title>

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
                   
  
<!-- Mainly scripts -->
<script src="js/jquery.metisMenu.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<link href="css/custom.css" rel="stylesheet">
<script src="js/custom.js"></script>
<script src="js/screenfull.js"></script>

 <script>


function reorder(){
	var reorder='<?php echo $reorder;?>';
	var instock='<?php echo $instock;?>';
	var name='<?php echo $pname;?>';
	var item='<?php echo $item;?>';
	var type='<?php echo $type;?>';
	 
	if(instock<reorder )
	{
	//alert('test');
  var alerted = localStorage.getItem('alerted')|| '';
		    if (alerted != 'yes') {
		alert(type+' '+ name+' ' +item+" is below Reorder Level Instock: " +instock  + alerted);
	localStorage.setItem('alerted','yes');
	var mess= type+' '+ name+' ' +item+" is below Reorder Level Instock: " +instock;
	var sub="Reorder"+type+' '+ name+' ' +item;
	sendMail(mess,sub);
	//localStorage.setItem('status','yes');
	}
	
	}
	else{
		//localStorage.clear();
		localStorage.removeItem('alerted');
	}
	
		//status=0;
	
	
	
}

$(function()
{
	$(function()
	{
    	$( "#search_start_date" ).datepicker({
            dateFormat:"yy-mm-dd"
         });
		 
		 $( "#search_end_date" ).datepicker({
          dateFormat:"yy-mm-dd"
         });
		 
		 $( "#Recdate" ).datepicker({
           dateFormat:"yy-mm-dd"
         });
         
         
         $( "#Recdater" ).datepicker({
           dateFormat:"yy-mm-dd"
         });
         
          $( "#Recdate1" ).datepicker({
           dateFormat:"yy-mm-dd"
         });
		 
		 
		 $( "#Recdate_Edit" ).datepicker({
            dateFormat:"yy-mm-dd"
         });
  
     });
});



</script>	


      <script>
	//Global JS variables
	var inline_item_index=0;
	var inline_item_index1=0;
	var edit_new_inline_item_index=0;
	
	//Dynamically get all the types
	var type_options = "<?php
							//database connection variables
	
							
							$sql = "SELECT name FROM fields";
							$formatted_result="";
													
							// Create connection to database
							$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
													
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
										$data_row_item_formatted = '<option>'.$row["name"].'</option>';
										$formatted_result=$formatted_result.$data_row_item_formatted;
									}
									$conn->close();
									echo $formatted_result;
								}
								else
								{
									$conn->close();
								}
							}
						?>";
					</script>
					<script type="text/javascript"> 

	$(function ()
	{
		$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

		if (!screenfull.enabled)
		{
				return false;
		}

		$('#toggle').click(function()
		{
				screenfull.toggle($('#container')[0]);
		});
		
	});
	
	
	/*__________________________________________________________________[Functions]____________________________________________________________*/
	
	/** 
	*		switch between the 3 viewable options on this page
	*	
	*	@param (integer) index - the number that marks the key for that index
	*
	*	@return void
	*/
	function switch_page(index)
	{
		switch (index)
		{
			case 0:
			document.getElementById("Enter_Return").style.display = "none";
			     document.getElementById("student_rent").style.display = "none";
				document.getElementById("Receival_listing").style.display = "block";
				document.getElementById("Enter_Receival").style.display = "none";
				document.getElementById("Edit_Receival").style.display = "none";
			document.getElementById("return").style.display = "none";
			document.getElementById("Edit_Return").style.display = "none";   
				
				//Load_Default_Usage_table();
				//loadAds();
				break;
				
			case 1:
					document.getElementById("Enter_Return").style.display = "none";
			document.getElementById("student_rent").style.display = "none";
				document.getElementById("Enter_Receival").style.display = "block";
				document.getElementById("Receival_listing").style.display = "none";
				document.getElementById("Edit_Receival").style.display = "none";
	           document.getElementById("return").style.display = "none";
	           document.getElementById("Edit_Return").style.display = "none";   
				
				
				break;
				
				
			case 5:
			document.getElementById("student_rent").style.display = "none";
				document.getElementById("Enter_Return").style.display = "block";
				document.getElementById("Enter_Receival").style.display = "none";
				document.getElementById("Receival_listing").style.display = "none";
				document.getElementById("Edit_Receival").style.display = "none";
				document.getElementById("return").style.display = "none";
				document.getElementById("Edit_Return").style.display = "none";   
				
				
				break;	
				
				
				
					
			case 4:
			document.getElementById("Enter_Return").style.display = "none";
			document.getElementById("student_rent").style.display = "block";
				document.getElementById("Enter_Receival").style.display = "none";
				document.getElementById("Receival_listing").style.display = "none";
				document.getElementById("Edit_Receival").style.display = "none";
			document.getElementById("return").style.display = "none";
			document.getElementById("Edit_Return").style.display = "none";   
				
				
				break;	
				
				
			case 2:
			document.getElementById("Enter_Return").style.display = "none";
			 document.getElementById("student_rent").style.display = "none";	
			document.getElementById("Edit_Receival").style.display = "block";
				document.getElementById("Edit_Return").style.display = "none";   
				document.getElementById("Enter_Receival").style.display = "none";
				document.getElementById("Receival_listing").style.display = "none";
			document.getElementById("return").style.display = "none";
				
				break;
				
				
					case 3:
						document.getElementById("return").style.display = "none";
					document.getElementById("Edit_Return").style.display = "block";
					document.getElementById("Enter_Return").style.display = "none";
					document.getElementById("Enter_Receival").style.display = "none";
				    document.getElementById("Edit_Receival").style.display = "none";
				
				    document.getElementById("Receival_listing").style.display = "none";
				    document.getElementById("student_rent").style.display = "none";
				break;
				
				
			case 6:
			
			        document.getElementById("return").style.display = "block";
					document.getElementById("Enter_Return").style.display = "none";
					document.getElementById("Enter_Receival").style.display = "none";
				document.getElementById("Edit_Receival").style.display = "none";
				 document.getElementById("Receival_listing").style.display = "none";
				document.getElementById("student_rent").style.display = "none";
				document.getElementById("Edit_Return").style.display = "none";   
				break;	
				
				
				
				
		}
	}
	
	
	/** 
	*	@Discription:	add a new row for the line item in the purchasing
	*	
	*	@param void
	*
	*	@return void
	*/
	
	
	
	
	
	
	
	
	
	function add_fields()
	{
		    var id=document.getElementById('barcode').value
			var location="Barcode";
	//	alert(id);
	
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
					var result=xhttp.responseText;
			
					if (result.match(/"Not Found"*/)) {
						alert(xhttp.responseText);
						document.getElementById("fields").innerHTML = "";     
						exit();
						
                       }
						
				  
				  
				  
					var receival_object = JSON.parse(xhttp.responseText);
					
				//	document.getElementById('stu_id').value =id;
				
                   var name =receival_object.stu_name;
			       var barcode = receival_object.barcode;
					var pic= receival_object.image;
					var dob= receival_object.dob;
					var stu_id= receival_object.stu_id;
					
						function Add_lunch()
	{
		inline_item_index1=inline_item_index1+1;
	
		   
		            var id1=document.getElementById('barcode').value
	                var name1 =receival_object.stu_name;
			        var barcode1 = receival_object.barcode;
					var pic1= receival_object.image;
					var dob1= receival_object.dob;
					var stu_id1= receival_object.stu_id;
				// alert(barcode);	
					var qty=1;
		

		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				
				{
					
					var result=xhttp.responseText;
			alert(xhttp.responseText);
					
					if (result.match(/Already Taken Lunch*/)) {
						
								// alert(xhttp.responseText);
                      
                      //document.getElementById('field_row_'+inline_item_index1+'_img').style.border = "10px solid black";
                      document.getElementById('field_row_'+inline_item_index+'_img').src = 'assets/images/nolunch.png';
					
					setTimeout(light, 3000)
			
			
			function light() {
				
				document.getElementById("fields").innerHTML = "";
 
}
						
                       }
						
					if (result.match(/Lunch Approved*/)) {
						
								// alert(xhttp.responseText);
                      
                      //document.getElementById('field_row_'+inline_item_index1+'_img').style.border = "10px solid black";
                      document.getElementById('field_row_'+inline_item_index+'_img').src = 'assets/images/correct.jpg';
					
					setTimeout(light, 3000)
			
			
			function light() {
				
				document.getElementById("fields").innerHTML = "";
 
}
						
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
		xhttp.send("Query=add_lunch&id="+id1+"&barcode="+barcode1+"&name="+name1+"&pic="+pic1+"&stu_id="+stu_id1);
		
		//alert("Stop");
	}
	
					
					
				
					 
                       	localStorage.setItem('bar',id);
					//alert(barcode);
					document.getElementById('barcode').value = "";
				
					document.getElementById('field_row_'+inline_item_index+'_barcode').value = id;
					document.getElementById('field_row_'+inline_item_index+'_name').value = name;
					document.getElementById('field_row_'+inline_item_index+'_dob').value = dob;
				
						document.getElementById('field_row_'+inline_item_index+'_img').src = pic;
					//document.getElementById('dob').value = receival_object.dob;
					//document.getElementById('grade').value = receival_object.grade;
					//switch_page(1);
		          // $("#field_row_'+inline_item_index+'_img").attr("src",pic);
		          Add_lunch();
			
				}
				else
				{
					alert("An error occured while trying to get the data you requested: "+xhttp.responseText);
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Basic_barcode_check&id="+id+"&location="+location, true);
		xhttp.send();
		var bar=localStorage.getItem('bar');
				if(id==id)
		{
			//alert(bar);
			inline_item_index=inline_item_index+1;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="field_row_"+inline_item_index;
			new_line_item.className ='row';
		new_line_item.innerHTML = ''
		                      
		                       
		                          
		                   // this is the 1st option select 
		                   	  +'<hr style="height: 1px; width: 100%; background-color: #999999;"/>'
		                   	  +'<br/>'
		                   	
		                   	  	
		                   	  		 +'<div  class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Image</span>'
								 +'			</div>'
								+'	<img id="field_row_'+inline_item_index+'_img" width="100%">'
									
								 +'		</div>'
								 +'	</div>' 
		               
		           	 
		         
		                   	  
		                   	  
		                   	  
					
								 
								 	 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Barcode</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="field_row_'+inline_item_index+'_barcode" name="barcode" type="text"  placeholder="Barcode" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
								 
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Name</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="field_row_'+inline_item_index+'_name" name="name" type="text"  placeholder="Name" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
		                   	  
								
								 
												 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">D.O.B</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="field_row_'+inline_item_index+'_dob" name="dob" type="text"  placeholder="D.O.B" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
								 
								 
							
								 
								 
								  
							
								 
			+'	<br>'
						 +'	<!--<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();focus1();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Remove</span></button>'
								   +'	<br/>';
								   +'	<br/>';
								 +'	</div>-->';
								 
								
					
								  
							
								 +''
	
							
		

			
		document.getElementById("fields").appendChild(new_line_item);
		document.getElementById('barcode').value = "";
		
	
		
		
		}
		
		  $('#barcode').focus();
		  
		  
		  
		  
		  
		
		//document.getElementById('barcode').value = "";
			
		 //Giving dynamic ID to the row, will be required for the uploading off information
		
		//alert("Stop");
	}
	


	
		
	function focus1(){
	//	alert('me');
		 $('#barcode').focus();
	}
	
	
	
	function add_fields1()
	{
		    var id=document.getElementById('barcoder').value
			var location="Barcode";
		//alert(id);
		//Variables
		
		
		//document.getElementById('barcode').value =
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
					
				//	document.getElementById('stu_id').value =id;
				
                   var name =receival_object.name;
					var isbn = receival_object.isbn;
					var barcode = receival_object.barcode;
					var auth= receival_object.auth;
					var cond= receival_object.cond;

                    localStorage.setItem('bar1',id);
					//alert(barcode);
					document.getElementById('barcode').value = "";
					document.getElementById('field_row_'+inline_item_index+'_isbnr').value = isbn;
					document.getElementById('field_row_'+inline_item_index+'_barcoder').value = id;
					document.getElementById('field_row_'+inline_item_index+'_namer').value = name;
					document.getElementById('field_row_'+inline_item_index+'_authr').value = auth;
					document.getElementById('field_row_'+inline_item_index+'_condr').value = cond;
					
					//document.getElementById('dob').value = receival_object.dob;
					//document.getElementById('grade').value = receival_object.grade;
					//switch_page(1);
		
			
				}
				else
				{
					alert("An error occured while trying to get the data you requested: "+xhttp.responseText);
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Basic_barcode&id="+id+"&location="+location, true);
		xhttp.send();
		var bar=localStorage.getItem('bar1');
				if(id==id)
		{
			//alert(bar);
			inline_item_index=inline_item_index+1;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="field_row_"+inline_item_index;
			new_line_item.className ='row';
		new_line_item.innerHTML = ''
		                      
		                       
		                          
		                   // this is the 1st option select 
		                   	  +'<hr style="height: 1px; width: 100%; background-color: #999999;"/>'
		                   	  +'<br/>'
		                   	  
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">ISBN</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="field_row_'+inline_item_index+'_isbnr" name="papersheet" type="text"  placeholder="ISBN" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
								 
								 	 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Barcode</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="field_row_'+inline_item_index+'_barcoder" name="papersheet" type="text"  placeholder="Barcode" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
								 
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Title</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="field_row_'+inline_item_index+'_namer" name="papersheet" type="text"  placeholder="Title" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
		                   	  
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">' 
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Subject</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="field_row_'+inline_item_index+'_authr" name="papersheet" type="text"  placeholder="Subject" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
												 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Condition</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="field_row_'+inline_item_index+'_condr" name="papersheet" type="text"  placeholder="Condition" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
								 
								 					 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Return Condition</span>'
								 +'			</div>'
								
								+'			<select class="grouped_select required form-control Stocks" onChange="fbarcode();" name="return" id="field_row_'+inline_item_index+'_returncond">'
								 +'					<option value="" disabled selected>Select</option>'
								  +'					<option value="A">A</option>'
								   +'					<option value="B">B</option>'
								    +'					<option value="C">C</option>'
								     +'					<option value="D">D</option>'
								 +'			</select>'
								 +'		</div>'
								 +'	</div>'
								 
								 
								 
								  
							
								 
			+'	<br>'
						 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Remove</span></button>'
								   +'	<br/>';
								   +'	<br/>';
								 +'	</div>';
								 
								
								   
								  
							
								 +''
	
							
	
	
	
	
			
		document.getElementById("fieldsr").appendChild(new_line_item);
		document.getElementById('barcoder').value = "";
		}
		
		document.getElementById('barcoder').value = "";
			
		 //Giving dynamic ID to the row, will be required for the uploading off information
		
		//alert("Stop");
	}
	
		
		function fbarcode(){
			 document.getElementById("barcoder").focus();
		//alert('working');
	}
	
	
	
	/** 
	*	@Discription:	Populate teh stock field of the inline item in the row specificed by the inline_item_id
	*	
	*	@param (String) stock_type - The type of stock to be query to get the available stock
	*	@param (String) inline_item_id - ID attribute of the iline item
	*
	*	@return (void)
	*/
	
	
	
	function edit_new_add_fields()
	{
		var id=document.getElementById('ebarcode').value
			var location="Barcode";
			
			
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
					
				//	document.getElementById('stu_id').value =id;
				
                   var name =receival_object.name;
					var isbn = receival_object.isbn;
					var barcode = receival_object.barcode;
					var auth= receival_object.auth;
					var cond= receival_object.cond;
					
					  	
                       	localStorage.setItem('bar',id);
					//alert(barcode);
					document.getElementById('barcode').value = "";
					document.getElementById('newfield_row_'+edit_new_inline_item_index+'isbn').value = isbn;
					document.getElementById('newfield_row_'+edit_new_inline_item_index+'barcode').value = id;
					document.getElementById('newfield_row_'+edit_new_inline_item_index+'name').value = name;
					document.getElementById('newfield_row_'+edit_new_inline_item_index+'auth').value = auth;
					document.getElementById('newfield_row_'+edit_new_inline_item_index+'cond').value = cond;
					//document.getElementById('dob').value = receival_object.dob;
					//document.getElementById('grade').value = receival_object.grade;
					//switch_page(1);
		
			
				}
				else
				{
					alert("An error occured while trying to get the data you requested: "+xhttp.responseText);
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Basic_barcode&id="+id+"&location="+location, true);
		xhttp.send();	
			
	var bar=localStorage.getItem('bar');
				if(id==id)
		{		
			
			
			
			
		edit_new_inline_item_index=edit_new_inline_item_index+1;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="newfield_row_"+edit_new_inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
								   +'<hr style="height: 1px; width: 100%; background-color: #999999;"/>'
		                   	  +'<br/>'
		               
		                   	  
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">ISBN</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="newfield_row_'+edit_new_inline_item_index+'isbn" name="isbn" type="text"  placeholder="ISBN" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
								 
								 	 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Barcode</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="newfield_row_'+edit_new_inline_item_index+'barcode" name="barcode" type="text"  placeholder="Barcode" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
								 
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Title</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="newfield_row_'+edit_new_inline_item_index+'name" name="name" type="text"  placeholder="Title" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
		                   	  
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Author</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="newfield_row_'+edit_new_inline_item_index+'auth" name="auth" type="text"  placeholder="Subject" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
												 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Condition</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="newfield_row_'+edit_new_inline_item_index+'cond" name="papersheet" type="text"  placeholder="Condition" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
					
							
							
								 +'	</div>'
								 +'	</div>'
								 
			
					
								 
								 	 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Clear</span></button>'
								 +'	</div>';
							 
							 
								  +'	</br>';
								   +'	</br>';
								   
								  
							
								 +''
	
							
		
			
		document.getElementById("new_fields_Edit").appendChild(new_line_item);
		document.getElementById('ebarcode').value = "";
		//alert("Stop");
	}
document.getElementById('ebarcode').value = "";
	}
	

	
	function edit_new_add_fields1()
	{
		var id=document.getElementById('ebarcode1').value
			var location="Barcode";
			
			
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
					
				//	document.getElementById('stu_id').value =id;
				
                   var name =receival_object.name;
					var isbn = receival_object.isbn;
					var barcode = receival_object.barcode;
					var auth= receival_object.auth;
					var cond= receival_object.cond;
					
					  	
                       	localStorage.setItem('bar',id);
					//alert(barcode);
					document.getElementById('ebarcode1').value = "";
					document.getElementById('newfield_row_'+edit_new_inline_item_index+'isbn1').value = isbn;
					document.getElementById('newfield_row_'+edit_new_inline_item_index+'barcode1').value = id;
					document.getElementById('newfield_row_'+edit_new_inline_item_index+'name1').value = name;
					document.getElementById('newfield_row_'+edit_new_inline_item_index+'auth1').value = auth;
					document.getElementById('newfield_row_'+edit_new_inline_item_index+'cond1').value = cond;
					//document.getElementById('dob').value = receival_object.dob;
					//document.getElementById('grade').value = receival_object.grade;
					//switch_page(1);
		
			
				}
				else
				{
					alert("An error occured while trying to get the data you requested: "+xhttp.responseText);
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Basic_barcode&id="+id+"&location="+location, true);
		xhttp.send();	
			
	var bar=localStorage.getItem('bar');
				if(id==id)
		{		
			
			
			
			
		edit_new_inline_item_index=edit_new_inline_item_index+1;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="newfield_row_"+edit_new_inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
								   +'<hr style="height: 1px; width: 100%; background-color: #999999;"/>'
		                   	  +'<br/>'
		               
		                   	  
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">ISBN</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="newfield_row_'+edit_new_inline_item_index+'isbn1" name="isbn" type="text"  placeholder="ISBN" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
								 
								 	 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Barcode</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="newfield_row_'+edit_new_inline_item_index+'barcode1" name="barcode" type="text"  placeholder="Barcode" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
								 
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Title</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="newfield_row_'+edit_new_inline_item_index+'name1" name="name" type="text"  placeholder="Title" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
		                   	  
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Author</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="newfield_row_'+edit_new_inline_item_index+'auth1" name="auth" type="text"  placeholder="Subject" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
												 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Condition</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="newfield_row_'+edit_new_inline_item_index+'cond1" name="papersheet" type="text"  placeholder="Condition" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
					
							
							
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Condition</span>'
								 +'			</div>'
							
								
								+'			<select class="grouped_select required form-control Stocks" onChange="" name="return" id="newfield_row_'+edit_new_inline_item_index+'returncond">'
								 +'					<option value="" disabled selected>Select</option>'
								  +'					<option value="A">A</option>'
								   +'					<option value="B">B</option>'
								    +'					<option value="C">C</option>'
								     +'					<option value="D">D</option>'
								 +'			</select>'
							
							
							 +'		</div>'
								 +'	</div>'
							
							
							
							
							
								 +'	</div>'
								 +'	</div>'
								 
								 
								 
								 
								 
			
					
								 
								 	 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Clear</span></button>'
								 +'	</div>';
							 
							 
								  +'	</br>';
								   +'	</br>';
								   
								  
							
								 +''
	
							
		
			
		document.getElementById("new_fields_Edit3").appendChild(new_line_item);
		document.getElementById('ebarcode1').value = "";
		//alert("Stop");
	}
document.getElementById('ebarcode1').value = "";
	}
	
	
	
	
	
	
	
	function get_stock_field(stock_type, inline_item_id)
	{
		//alert(stock_type);
		///alert(inline_item_id);
		//Variables
		var Options;
		var xhttp = new XMLHttpRequest();
		inline_item_id+="_stock";
		//alert(inline_item_id);
	
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					//alert(xhttp.responseText);
					Options = xhttp.responseText;
					document.getElementById(inline_item_id).innerHTML = Options;
				}
				else
				{
					alert("An error occured while trying to get the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Stock_in_Type&Type="+stock_type, true);
		xhttp.send();
		
		//alert(Stock_field);
		//alert("stop");
	} 
	
	function get_stock_fields(stock_type, inline_item_id)
	{
		//alert(stock_type);
		///alert(inline_item_id);
		//Variables
		var location=document.getElementById('location').value;
		//alert(location);
		var Options;
		var xhttp = new XMLHttpRequest();
		inline_item_id+="_stock";
		//alert(inline_item_id);
	
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					//alert(xhttp.responseText);
					Options = xhttp.responseText;
					document.getElementById(inline_item_id).innerHTML = Options;
				}
				else
				{
					alert("An error occured while trying to get the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Stock_in_Types&Type="+stock_type+"&location="+location, true);
		xhttp.send();
		
		//alert(Stock_field);
		//alert("stop");
	}
	
		function Create_Receival()
	{
	//	alert('yes'); 
		
		//kill function if failure to validate
	
		//Variables
		
	  
		//alert(job_id);
		var stu_id = document.getElementById("stu_id").value;
		var Recdate = document.getElementById("Recdate").value;
		var fname = document.getElementById("fname").value;

		
	//	localStorage.setItem('location',location);
		
	//var id="field_row_'+inline_item_index+'_stock";
	


		var Inline_items = []; //Array to hold the list of inline items that will be purchase -Gavin Palmer || March 2016
		var Inline_items_Sringyfied = ""; //array of objects stringyfied to be passed on to the server  -Gavin Palmer || March 2016

		
		//Take all the values of the inline items rows and store the rows individually in objects  -Gavin Palmer || March 2016
		//Firstly find each inline item row by id of the row
		$('div[id^="field_row_"]').each(function()
		{
		var name = $("#"+this.id+"_name").val();	
		var isbn = $("#"+this.id+"_isbn").val();
		var barcode = $("#"+this.id+"_barcode").val();
		var auth = $("#"+this.id+"_auth").val();	
		var cond = $("#"+this.id+"_cond").val();	
			//Secnding store the fields of the rows in variables to be added to the object
	
			var quantity = 1;
      		
			//Add the value to the object
			var Inline_item = {}; //Empty Inline Item object
			//var Inline_item = {}; 
			Inline_item["name"] = name;

			Inline_item["isbn"] = isbn;
			Inline_item["barcode"] = barcode;
			Inline_item["auth"] = auth;
			Inline_item["quantity"] = quantity;
			Inline_item["cond"] = cond;
			
		
			
			//Thirdly, add the object to the already existing array of objects
			Inline_items.push(Inline_item);
		});
		
		//Stringyfy array of inline items to be passed to the servers as one variable
		var Inline_items_Sringyfied = JSON.stringify(Inline_items);
		
		
		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					alert(xhttp.responseText);
					var result=xhttp.responseText;
			
					$('#Message').delay(5000).fadeOut(400)
					if (result.match(/You have exceeded stock amount.*/)) {
                        //alert('match');
                        remove();
                        //switch_page(1);
                       }
                        if (result.match(/Process Completed.*/)) {
                    		
					/*document.getElementById("Invoice_Number").value="";
					document.getElementById("Recdate").value="";
					document.getElementById("location").value="";
		
					document.getElementById("fields").innerHTML = "";*/
					document.getElementById("Message").innerHTML = xhttp.responseText;
                      // 	var sid=localStorage.getItem('sid');
                       	
                     //  	Rtest(sid,location);
                        reload();
                       	
                      }
                      else{} 	
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
	
		xhttp.send("Query=Add_rental_teacher&sid="+stu_id+"&Recdate="+Recdate+"&fname="+fname+"&Inline_items="+Inline_items_Sringyfied);
		//alert(Inline_items_Sringyfied );
		//alert("End"); 
	}
	
	
	
	function Create_Return()
	{
	//	alert('yes'); 
		
		//kill function if failure to validate
	
		//Variables
		
	  
		//alert(job_id);
		var stu_id = document.getElementById("stu_idr").value;
		var Recdate = document.getElementById("Recdater").value;
		var fname = document.getElementById("fnamer").value;
	
		
	//	localStorage.setItem('location',location);
		
	//var id="field_row_'+inline_item_index+'_stock";
	


		var Inline_items = []; //Array to hold the list of inline items that will be purchase -Gavin Palmer || March 2016
		var Inline_items_Sringyfied = ""; //array of objects stringyfied to be passed on to the server  -Gavin Palmer || March 2016

		
		//Take all the values of the inline items rows and store the rows individually in objects  -Gavin Palmer || March 2016
		//Firstly find each inline item row by id of the row
		$('div[id^="field_row_"]').each(function()
		{
		var name = $("#"+this.id+"_namer").val();	
		var isbn = $("#"+this.id+"_isbnr").val();
		var barcode = $("#"+this.id+"_barcoder").val();
		var auth = $("#"+this.id+"_authr").val();	
		var cond = $("#"+this.id+"_cond").val();
		var returncond = $("#"+this.id+"_returncond").val();		
			//Secnding store the fields of the rows in variables to be added to the object
	
			var quantity = 1;
      		
			//Add the value to the object
			var Inline_item = {}; //Empty Inline Item object
			//var Inline_item = {}; 
			Inline_item["name"] = name;

			Inline_item["isbn"] = isbn;
			Inline_item["barcode"] = barcode;
			Inline_item["auth"] = auth;
			Inline_item["quantity"] = quantity;
			Inline_item["cond"] = cond;
			Inline_item["returncond"] = returncond;
		
			
			//Thirdly, add the object to the already existing array of objects
			Inline_items.push(Inline_item);
		});
		
		//Stringyfy array of inline items to be passed to the servers as one variable
		var Inline_items_Sringyfied = JSON.stringify(Inline_items);
		
		
		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					alert(xhttp.responseText);
					var result=xhttp.responseText;
			
					$('#Message').delay(5000).fadeOut(400)
					if (result.match(/You have exceeded stock amount.*/)) {
                        //alert('match');
                        //switch_page(1);
                       }
                        if (result.match(/Process Completed.*/)) {
                    		
					/*document.getElementById("Invoice_Number").value="";
					document.getElementById("Recdate").value="";
					document.getElementById("location").value="";
		
					document.getElementById("fields").innerHTML = "";*/
					document.getElementById("Message").innerHTML = xhttp.responseText;
                      // 	var sid=localStorage.getItem('sid');
                       	
                     //  	Rtest(sid,location);
                        reload();
                       	 
                      }
                      else{} 	
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
	
		xhttp.send("Query=Add_returnt&sid="+stu_id+"&Recdate="+Recdate+"&fname="+fname+"&Inline_items="+Inline_items_Sringyfied);
		//alert(Inline_items_Sringyfied );
		//alert("End"); 
	}
	
	
	
	
	

	/** 
	*	@Discription:	Remove the receival from the receival listing by id number
	*	
	*	@param (int) id - The id number of the receival
	*
	*	@return (void)
	*/
	function Remove_Usage(row,id)
	{
		//alert(id);
		
				
	var xhttp1 = new XMLHttpRequest();

	
		xhttp1.onreadystatechange = function()
		{
			if(xhttp1.readyState == 4)
			{
				if(xhttp1.status == 200)
				{
					if(xhttp1.responseText==""){
						
					}
					else{
						//alert(xhttp1.responseText);
						var location=xhttp1.responseText;
						
						localStorage.setItem('location',location);
						
						}
				
					
				}
				else
				{
					//alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp1.open("POST", "reorder.php", true);
		xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp1.send("&location="+id);
	

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
				
					document.getElementById("Receival_listing_Message").innerHTML = xhttp.responseText;
					$('#Receival_listing_Message').delay(5000).fadeOut(400);
					$('#Listing_row_'+row).delay(1000).fadeOut(400);
					document.getElementById("Message1").innerHTML = xhttp.responseText;
					$('#Message1').delay(5000).fadeOut(400)
						var loc=localStorage.getItem('location');
					Rtest(id,loc);
					
					//reload();
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Remove_Usage&id="+id, true);
		xhttp.send();
		//alert("stop");
	}
	
	  	function Del_Usage(id)
	{
		//alert(id);
		


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
				
					document.getElementById("Receival_listing_Message").innerHTML = xhttp.responseText;
					$('#Receival_listing_Message').delay(5000).fadeOut(400);
					$('#Listing_row_'+row).delay(1000).fadeOut(400);
					document.getElementById("Message1").innerHTML = xhttp.responseText;
					$('#Message1').delay(5000).fadeOut(400)
						//var loc=localStorage.getItem('location');
					//Rtest(id,loc);
					
					//reload();
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Del_Usaget&id="+id, true);
		xhttp.send();
		//alert("stop");
	}
	
	  
	  
	  
	function get_fields()
	{
		//alert("Satrt");
		inline_item_index=inline_item_index+1;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="field_row_"+inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
								 +'<div class="col-md-4 custyle">'
								 
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								 +'			<select class="form-control equipment_type" id="field_row_'+inline_item_index+'_Type" name="Type" onChange="get_stock_field(this.value, \'field_row_'+inline_item_index+'\')get_stock_fields(this.value, \'field_row_'+inline_item_index+'\')">'
								 +'				<option  value="" disabled selected>Type</option>'
								 +'				'+type_options				
								 +'			</select>'
								 +'		</div>'
								 +'	</div>'
								 +'	<div class="col-md-4 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-shopping-cart"></span>'
								 +'			</div>'
								 +'		<div class="grouped_select required receival_rec_lineitems_stock_id">'
								 +'			<select class="grouped_select required form-control Stocks" name="Stocks" id="field_row_'+inline_item_index+'_stock">'
								 +'					<option value="" disabled selected>Stock1</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								 +'	<div class="col-md-2 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-scale"></span>'
								 +'			</div>'
								 +'			<input class="form-control" id="field_row_'+inline_item_index+'_quantity" name="Quantity" type="number" placeholder="Quantity"/>'
								 +'		</div>'
								 +'	</div>'
								 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Remove</span></button>'
								 +'	</div>';
								 +' <br/>'
								 +''
			
		document.getElementById("fields").appendChild(new_line_item);
		//alert("Stop");
	}
	
	
	/** -Gavin Palmer || March 2016
	*	@Discription:	bring up edit usage page
	*	
	*	@param (void)
	*
	*	@return (void)
	*/
	function Show_Edit_Usage(id)//This loads the  usage edit form 
	{
//	alert(id);
	
		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					
					var receival_object = JSON.parse(xhttp.responseText);

	
					document.getElementById('rental').value =id;
            
					document.getElementById('name').value = receival_object.name;
					//document.getElementById('grade').value =receival_object.grade;
					document.getElementById('date').value = receival_object.date;
					
				
		var xhttp_line_items = new XMLHttpRequest();
		
		xhttp_line_items.onreadystatechange = function()
		{
			if(xhttp_line_items.readyState == 4)
			{
				if(xhttp_line_items.status == 200)
				{
					
					document.getElementById('fields_Edit').innerHTML = ""; //Clear the section of the page before writing to it
					var line_item_objects = JSON.parse(xhttp_line_items.responseText);
					
					for (a = 0; a < line_item_objects.length; a++)
					{
						//alert(a);
						//alert(line_item_objects[a].barcode);
						//alert(line_item_objects[a].isbn);
						Edit_add_field(a,line_item_objects[a].isbn,line_item_objects[a].barcode,line_item_objects[a].name,line_item_objects[a].cond,line_item_objects[a].auth,line_item_objects[a].rid); 
					
					}
				}
				else
				{
					alert("An error occured while trying to get the data you requested: "+xhttp_line_items.responseText);
				}
			}
		};
		
		xhttp_line_items.open("GET", "php/Query_Manager.php?Query=Get_rental_line_items_JSONt&id="+id, true);
		xhttp_line_items.send();
		
					
				}
				else
				{
					alert("An error occured while trying to get the data you requested: "+xhttp.responseText);
				}
			}
		};
    xhttp.open("GET", "php/Query_Manager.php?Query=Basic_rental_teacher_info&id="+id, true);
		xhttp.send();
		switch_page(2);
			
	    //var job=localStorage.getItem('job');
		//Get and display basic receival information -Gavin Palmer || March 2016
		//alert(job1);
		
		
		
		//alert('Stop');
	}
	
	
	function Show_Edit_Usage1(id)//This loads the  usage edit form 
	{
//	alert(id);
	
		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					
					var receival_object = JSON.parse(xhttp.responseText);

	
					document.getElementById('return1').value =id;
            
					document.getElementById('name1').value = receival_object.name;
				
					document.getElementById('date1').value = receival_object.date;
					
				
		var xhttp_line_items = new XMLHttpRequest();
		
		xhttp_line_items.onreadystatechange = function()
		{
			if(xhttp_line_items.readyState == 4)
			{
				if(xhttp_line_items.status == 200)
				{
				
					document.getElementById('fields_Edit3').innerHTML = ""; //Clear the section of the page before writing to it
					var line_item_objects = JSON.parse(xhttp_line_items.responseText);
					
					for (a = 0; a < line_item_objects.length; a++)
					{
						//alert(a);
						//alert(line_item_objects[a].barcode);
						//alert(line_item_objects[a].isbn);
						Edit_add_field3(a,line_item_objects[a].isbn,line_item_objects[a].barcode,line_item_objects[a].name,line_item_objects[a].cond,line_item_objects[a].auth,line_item_objects[a].rid); 
					
					}
				}
				else
				{
					alert("An error occured while trying to get the data you requested: "+xhttp_line_items.responseText);
				}
			}
		};
		
		xhttp_line_items.open("GET", "php/Query_Manager.php?Query=Get_return_line_items_JSONt&id="+id, true);
		xhttp_line_items.send();
		
					
				}
				else
				{
					alert("An error occured while trying to get the data you requested: "+xhttp.responseText);
				}
			}
		};
    xhttp.open("GET", "php/Query_Manager.php?Query=Basic_returnt_info&id="+id, true);
		xhttp.send();
		switch_page(3);
			
	    //var job=localStorage.getItem('job');
		//Get and display basic receival information -Gavin Palmer || March 2016
		//alert(job1);
		
		
		
		//alert('Stop');
	}
	
	
	
	
	
	
	
	
	/** 
	*	@Discription:	add new field for every attemp collected for the receival
	*	
	*	@param void
	*
	*	@return void
	*/
	
	function Edit_add_field(row_num,id,ib,title,cond,auth,rid)
	{
//	alert('yes');
		
		edit_inline_item_index=row_num;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="edit_field_row_"+edit_inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
		                      
		                       
		                          
		                   // this is the 1st option select
		                     +'	</br>'
		                     +'<hr style="height: 1px; width: 100%; background-color: #999999;"/>'
		                   	  
		                   	  	     +'<div id="displaypaper" style="display:none">'
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">ISBN</span>'
								 +'			</div>'
							
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_rid" name="id" type="text" value="'+rid+'" placeholder="Rental ID"/>'
									
								  +'		</div>'
								  +'		</div>'
								 +'	</div>'
		                   	  
		                   	  
		                   	  
		                   	  
		                   	  
		                   	  
		                   	     +'<div id="displaypaper" style="display:block">'
		                   	     
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">ISBN</span>'
								 +'			</div>'
							
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_isbn" name="id" type="text" value="'+id+'" placeholder="id"/>'
									
								  +'		</div>'
								  +'		</div>'
								 +'	</div>'
								 
								   
		                   	     +'<div id="displaypaper" style="display:block">'
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Barcode</span>'
								 +'			</div>'
							
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_bar" name="id" type="text" value="'+ib+'" placeholder="Barcode"/>'
							
								  +'		</div>'
								  +'		</div>'
								 +'	</div>'
								 
								 
								   +'<div id="displaypaper" style="display:block">'
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Title</span>'
								 +'			</div>'
							
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_name" name="id" type="text" value="'+title+'" placeholder="Name"/>'
									
								  +'		</div>'
								  +'		</div>'
								 +'	</div>'
								 
								    +'<div id="displaypaper" style="display:block">'
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Subject</span>'
								 +'			</div>'
							
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_auth" name="id" type="text" value="'+auth+'" placeholder="Subject"/>'
									
								  +'		</div>'
								  +'		</div>'
								 +'	</div>'
								 
								 
								 		    +'<div id="displaypaper" style="display:block">'
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Condition</span>'
								 +'			</div>'
							
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_cond" name="id" type="text" value="'+cond+'" placeholder="Condition"/>'
									
								  +'		</div>'
								  +'		</div>'
								 +'	</div>'
								 
								 
								 
								 
								 
								 
								 
								 
								   
								   +'<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();Del_Usage('+rid+');"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Del</span></button>'
								 +'	</div>'
							
								 +''
			
		document.getElementById("fields_Edit").appendChild(new_line_item);
		
		
		
	
		
	
			
		
		
		
	}
	
	
	function Edit_add_field3(row_num,id,ib,title,cond,auth,rid)
	{
//	alert('yes');
		
		edit_inline_item_index=row_num;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="edit_field_row_"+edit_inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
		                      
		                       
		                          
		                   // this is the 1st option select
		                     +'	</br>'
		                     +'<hr style="height: 1px; width: 100%; background-color: #999999;"/>'
		                   	  
		                   	  	     +'<div id="displaypaper" style="display:none">'
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">ISBN</span>'
								 +'			</div>'
							
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_rid" name="id" type="text" value="'+rid+'" placeholder="Rental ID"/>'
									
								  +'		</div>'
								  +'		</div>'
								 +'	</div>'
		                   	  
		                   	  
		                   	  
		                   	  
		                   	  
		                   	  
		                   	     +'<div id="displaypaper" style="display:block">'
		                   	     
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">ISBN</span>'
								 +'			</div>'
							
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_isbn1" name="id" type="text" value="'+id+'" placeholder="id"/>'
									
								  +'		</div>'
								  +'		</div>'
								 +'	</div>'
								 
								   
		                   	     +'<div id="displaypaper" style="display:block">'
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Barcode</span>'
								 +'			</div>'
							
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_bar1" name="id" type="text" value="'+ib+'" placeholder="Barcode"/>'
							
								  +'		</div>'
								  +'		</div>'
								 +'	</div>'
								 
								 
								   +'<div id="displaypaper" style="display:block">'
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Title</span>'
								 +'			</div>'
							
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_name1" name="id" type="text" value="'+title+'" placeholder="Name"/>'
									
								  +'		</div>'
								  +'		</div>'
								 +'	</div>'
								 
								    +'<div id="displaypaper" style="display:block">'
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Subject</span>'
								 +'			</div>'
							
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_auth1" name="id" type="text" value="'+auth+'" placeholder="Subject"/>'
									
								  +'		</div>'
								  +'		</div>'
								 +'	</div>'
								 
								 
								 		    +'<div id="displaypaper" style="display:block">'
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Condition</span>'
								 +'			</div>'
							
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_cond1" name="id" type="text" value="'+cond+'" placeholder="Condition"/>'
									
								  +'		</div>'
								  +'		</div>'
								 +'	</div>'
								 
								 
								 
								 
								 
								 
								 
								 
								   
								   +'<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();Del_Usage('+rid+');"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Del</span></button>'
								 +'	</div>'
							
								 +''
			
		document.getElementById("fields_Edit3").appendChild(new_line_item);
		
		
		
	
		
	
			
		
		
		
	}
	
	
	
	
	
	function Edit_add_field1(row_num)
	{
	
			
		//alert("start");
		edit_inline_item_index=row_num;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="edit_field_row_"+edit_inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
		                      
		                       
		                          
		                   // this is the 1st option select
		                    +'<hr style="height: 1px; width: 100%; background-color: #999999;"/>'
		                   	  +'<br/>'
		               
		                   	  
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">ISBN</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="edit_field_row_'+edit_inline_item_index+'isbn" name="isbn" type="text" value="'+isbn+'"  placeholder="ISBN" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
								 
								 	 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Barcode</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="edit_field_row_'+edit_inline_item_index+'barcode" name="barcode" value="'+barcode+'" type="text"  placeholder="Barcode" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
								 
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Title</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="edit_field_row_'+edit_inline_item_index+'name" name="name" type="text" value="'+name+'"  placeholder="Title" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
		                   	  
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Subject</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="edit_field_row_'+edit_inline_item_index+'auth" name="auth" type="text" value="'+auth+'" placeholder="Author" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
												 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="">Condition</span>'
								 +'			</div>'
								
								+'			<input class="form-control" id="edit_field_row_'+edit_inline_item_index+'cond" name="papersheet" type="text" value="'+cond+'" placeholder="Condition" readonly/>'
								 +'		</div>'
								 +'	</div>'
								 
							
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
								
								   
								   +'<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();Del_Usage('+id+');"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Del</span></button>'
								 +'	</div>'
							
							
								 +''
			
		document.getElementById("fields_Edit").appendChild(new_line_item);
		
		
		
	
		
	
			
		
		
		
	}
	
	
	/** 
	*	@Discription:	add a new row for the line item in the usage that is being added
	*	
	*	@param void
	*
	*	@return void
	*/

	
	/** 
	*	******************@Discription:	Remove the receival  line item from the receival listing by id number
	*	
	*	@param (int) id - The id number of the receival line item
	*
	*	@return (void)
	*/
	function Remove_Receival_line_item(row, id)
	{
		alert("start");
		//Variables
		var xhttp = new XMLHttpRequest();
		
		//Confirm before action is taken
		var action = confirm("Are you sure this line item from the record?");
		
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
					document.getElementById("Receival_listing_Message").innerHTML = "Receival deleted";
					$('#Receival_listing_Message').delay(5000).fadeOut(400);
					$('#edit_field_row_'+row).delay(500).fadeOut(400);
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Remove_Usage_line_item&id="+id, true);
		xhttp.send();
		//alert("stop");
	}


	/** 
	*	@Discription:	Collect and send of sets of information required to update the receival information
	*	
	*	@param (void)
	*
	*	@return (void)
	*/
	
	function stock(sid){
	var sid=sid;
	alert(sid);
	localStorage.setItem('sid',sid);
}
function loc(){
	var location =document.getElementById("location").value;

	//alert(location);
	
	if (location=="Warehouse1")
	{
		
		
		//document.getElementById("location").value=location;
		//document.getElementById("Invoice_Number").placeholder="Job #";
		//document.getElementById("jname1").style.display="block";
		
	}
	
	
	
	if (location=="Warehouse2")
	{
		//document.getElementById("Invoice_Number").placeholder="Item Id";
		// document.getElementById("jname1").style.display="none";
		//switch_page(3);
		
	}
	
		if (location=="Warehouse2")
	{
		
		
	//	document.getElementById("location").value=location;
		
	}
	
}






	function Rtest1(id) //This is the function to remove the receivals for the Receival Tabel
	{
	//alert(id);

			var xhttp1 = new XMLHttpRequest();
	
		xhttp1.onreadystatechange = function()
		{
			if(xhttp1.readyState == 4)
			{
				if(xhttp1.status == 200)
				{
					//alert(xhttp1.responseText);
					if(xhttp1.responseText==""){
						
					}
					else{
						alert(xhttp1.responseText);
							document.getElementById("Receival_listing_Message").innerHTML =xhttp1.responseText;
					$('#Receival_listing_Message').delay(5000).fadeOut(400);
						
						}
				
				}
				else
				{
					//alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp1.open("POST", "reorder.php", true);
		xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp1.send("&id="+id);
	}


	
		function Rtest(sid,location) //This is the function to remove the receivals for the Receival Tabel
	{
	
//alert('start');
			var xhttp1 = new XMLHttpRequest();
	
		xhttp1.onreadystatechange = function()
		{
			if(xhttp1.readyState == 4)
			{
				if(xhttp1.status == 200)
				{
					if(xhttp1.responseText==""){
						
					}
					else{
						alert(xhttp1.responseText);
						}
					
					document.getElementById("Receival_listing_Message").innerHTML =xhttp1.responseText;
					$('#Receival_listing_Message').delay(5000).fadeOut(400);
					$('#Listing_row_'+row).delay(1000).fadeOut(400);
					//reorder();
				//	reload();
				}
				else
				{
					//alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp1.open("POST", "reorder.php", true);
		xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp1.send("&sid="+sid+"&loc="+location);
	}

function Rtest2(id) //This is the function to remove the receivals for the Receival Tabel
	{

			var xhttp1 = new XMLHttpRequest();
	
		xhttp1.onreadystatechange = function()
		{
			if(xhttp1.readyState == 4)
			{
				if(xhttp1.status == 200)
				{
					if(xhttp1.responseText==""){
						
					}
					else{
						alert(xhttp1.responseText);
						}
				
					reload();
				}
				else
				{
					//alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp1.open("POST", "reorder.php", true);
		xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp1.send("&location="+id);
	}
	function Show_Receival(id)
	{
		var location="Teachers";
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
				 //alert(xhttp.responseText);
					var receival_object = JSON.parse(xhttp.responseText);
					
					document.getElementById('stu_id').value =id;
				
                   var f =receival_object.fname;
					
					var l= receival_object.lname;
					var fullname=f+" "+l;
					document.getElementById('fname').value = fullname;
				
					switch_page(1);
					
				
			
				}
				else
				{
					alert("An error occured while trying to get the data you requested: "+xhttp.responseText);
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Basic_teacher&id="+id+"&location="+location, true);
		xhttp.send();
		
		
		
		//alert('Stop');
	}
	
	
	
	function Show_Return(id)
	{
		var location="Teachers";
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
					
					document.getElementById('stu_idr').value =id;
				
                   var f =receival_object.fname;
			
					var l= receival_object.lname;
					var fullname=f+" "+l;
					document.getElementById('fnamer').value = fullname;
					//document.getElementById('dobr').value = receival_object.dob;
				//	g=document.getElementById('grade1r').value = receival_object.grade;
					//alert(g);
					switch_page(5);
					
				
			
				}
				else
				{
					alert("An error occured while trying to get the data you requested: "+xhttp.responseText);
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Basic_teacher&id="+id+"&location="+location, true);
		xhttp.send();
		
		
		
		//alert('Stop');
	}
	
	
	
	
	
	function Update_Usage()
	{
		//kill function if failure to validate
		
		//alert("Start");
		//Variables
		
		
	              var id = document.getElementById('rental').value;
            
				var name=document.getElementById('name').value;
				var grade=document.getElementById('grade').value;
				var date=document.getElementById('date').value; 
		
		
		
		
		var Inline_items = []; //Array to hold the list of inline items that will be purchase -Gavin Palmer || March 2016
		var Inline_items_Sringyfied = ""; //array of objects stringyfied to be passed on to the server  -Gavin Palmer || March 2016
		var new_Inline_items = []; //Array to hold the list of newly added inline items that will be purchase -Gavin Palmer || March 2016
		var new_Inline_items_Sringyfied = ""; //array of of newly added inline items  objects stringyfied to be passed on to the server  -Gavin Palmer || March 2016
		//alert("after the variables");
		//Take all the values of the inline items rows and store the rows individually in objects  -Gavin Palmer || March 2016
		//Firstly find each inline item row by id of the row
		$('div[id^="edit_field_row_"]').each(function()
		{
			//Secnding store the fields of the rows in variables to be added to the object
			
			var isbn = $("#"+this.id+"_isbn").val();
			
			var barcode = $("#"+this.id+"_barcode").val();
			var name = $("#"+this.id+"_name").val();

			var auth = $("#"+this.id+"_auth").val();
			var cond = $("#"+this.id+"_cond").val();
			
			
	//alert(isbn);
			
	
			//Add the value to the object
			var Inline_item = {}; //Empty Inline Item object
			Inline_item["isbn"] = isbn;
			//Inline_item["Item"] = Item;
			Inline_item["barcode"] = barcode;
			Inline_item["name"] = name;
			
			Inline_item["auth"] = auth;
			Inline_item["cond"] = cond;
			
			
			
			
			//Thirdly, add the object to the already existing array of objects
			Inline_items.push(Inline_item);
			
		});
		
		//Stringyfy array of inline items to be passed to the servers as one variable
		var Inline_items_Sringyfied = JSON.stringify(Inline_items);
		
		
			$('div[id^="newfield_row_"]').each(function()
		{
			//Secnding store the fields of the rows in variables to be added to the object
			
			//var rid = $("#"+this.id+"rid").val();
			var isbn = $("#"+this.id+"isbn").val();
			var barcode = $("#"+this.id+"barcode").val();
			var name = $("#"+this.id+"name").val();
			var cond = $("#"+this.id+"cond").val();
			var auth = $("#"+this.id+"auth").val();
			var qty=1;
			
			//alert(name);
			//Add the value to the object
			var Inline_item = {}; //Empty Inline Item object
			//Inline_item["rid"] = erid;
			Inline_item["isbn"] = isbn;
			Inline_item["barcode"] = barcode;
			Inline_item["name"] = name;
			Inline_item["cond"] = cond;
			Inline_item["auth"] = auth;
			Inline_item["qty"] = qty;
			
			//Thirdly, add the object to the already existing array of objects
			new_Inline_items.push(Inline_item);
		});
		
		//Stringyfy array of new inline items to be passed to the servers as one variable
		var new_Inline_items_Sringyfied = JSON.stringify(new_Inline_items);


		
		

		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					alert(xhttp.responseText);
					var result=xhttp.responseText;
				//	document.getElementById("Invoice_Number_Edit").value="";
					//document.getElementById("ID_Number_Edit").value="";
					//document.getElementById("Recdate_Edit").value="";
					//document.getElementById("fields_Edit").innerHTML = "";
					//document.getElementById("new_fields_Edit").innerHTML = "";
					document.getElementById("Message1").innerHTML = xhttp.responseText;
					$('#Message1').delay(5000).fadeOut(400)
					//alert("Successfuly updated");
				if(result.match(/Book Added*/)) {
                        reload();
                      
                       }
                       else{
                       
                       		
                       	
                       	//var sid=localStorage.getItem('sid');
				   //alert(sid);
				//   Rtest1(ID);
                       	
                       	
                     
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
		xhttp.send("Query=Update_rental&id="+id+"&name="+name+"&grade="+grade+"&date="+date+"&Inline_items="+Inline_items_Sringyfied+"&new_Inline_items="+new_Inline_items_Sringyfied);
		
		//alert("Stop");
	}
	
	
		function Update_Usage1()
	{

		
		alert("Start");
	         var id = document.getElementById('return1').value;
            
				var name=document.getElementById('name1').value;
	
				var date=document.getElementById('date1').value; 
		
		
		
		
		var Inline_items = []; //Array to hold the list of inline items that will be purchase -Gavin Palmer || March 2016
		var Inline_items_Sringyfied = ""; //array of objects stringyfied to be passed on to the server  -Gavin Palmer || March 2016
		var new_Inline_items = []; //Array to hold the list of newly added inline items that will be purchase -Gavin Palmer || March 2016
		var new_Inline_items_Sringyfied = ""; //array of of newly added inline items  objects stringyfied to be passed on to the server  -Gavin Palmer || March 2016
		//alert("after the variables");
		//Take all the values of the inline items rows and store the rows individually in objects  -Gavin Palmer || March 2016
		//Firstly find each inline item row by id of the row
		$('div[id^="edit_field_row_"]').each(function()
		{
			//Secnding store the fields of the rows in variables to be added to the object
			
			var isbn = $("#"+this.id+"_isbn1").val();
			
			var barcode = $("#"+this.id+"_bar1").val();
			var name = $("#"+this.id+"_name1").val();

			var auth = $("#"+this.id+"_auth1").val();
			var cond = $("#"+this.id+"_cond1").val();
			
			
	//alert(isbn);
			
	
			//Add the value to the object
			var Inline_item = {}; //Empty Inline Item object
			Inline_item["isbn"] = isbn;
			//Inline_item["Item"] = Item;
			Inline_item["barcode"] = barcode;
			Inline_item["name"] = name;
			
			Inline_item["auth"] = auth;
			Inline_item["cond"] = cond;
			
			
			
			
			//Thirdly, add the object to the already existing array of objects
			Inline_items.push(Inline_item);
			
		});
		
		//Stringyfy array of inline items to be passed to the servers as one variable
		var Inline_items_Sringyfied = JSON.stringify(Inline_items);
		
		
			$('div[id^="newfield_row_"]').each(function()
		{
			//Secnding store the fields of the rows in variables to be added to the object
			
			//var rid = $("#"+this.id+"rid").val();
			var isbn = $("#"+this.id+"isbn1").val();
			var barcode = $("#"+this.id+"barcode1").val();
			var name = $("#"+this.id+"name1").val();
			var cond = $("#"+this.id+"cond1").val();
			var returncond = $("#"+this.id+"returncond").val();
			var auth = $("#"+this.id+"auth1").val();
			
			var qty=1;
			
			//alert(name);
			//Add the value to the object
			var Inline_item = {}; //Empty Inline Item object
			//Inline_item["rid"] = erid;
			Inline_item["isbn"] = isbn;
			Inline_item["barcode"] = barcode;
			Inline_item["name"] = name;
			Inline_item["cond"] = cond;
			Inline_item["auth"] = auth;
			Inline_item["qty"] = qty;
			Inline_item["returncond"] = returncond;
			
			//Thirdly, add the object to the already existing array of objects
			new_Inline_items.push(Inline_item);
		});
		
		//Stringyfy array of new inline items to be passed to the servers as one variable
		var new_Inline_items_Sringyfied = JSON.stringify(new_Inline_items);


		
		

		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					alert(xhttp.responseText);
					var result=xhttp.responseText;
				//	document.getElementById("Invoice_Number_Edit").value="";
					//document.getElementById("ID_Number_Edit").value="";
					//document.getElementById("Recdate_Edit").value="";
					//document.getElementById("fields_Edit").innerHTML = "";
					//document.getElementById("new_fields_Edit").innerHTML = "";
					document.getElementById("Message1").innerHTML = xhttp.responseText;
					$('#Message1').delay(5000).fadeOut(400)
					//alert("Successfuly updated");
				if(result.match(/Book Return*/)) {
                        reload();
                      
                       }
                       else{
                       
                       		
                       	
                       	//var sid=localStorage.getItem('sid');
				   //alert(sid);
				//   Rtest1(ID);
                       	
                       	
                     
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
		xhttp.send("Query=Update_returnt&id="+id+"&name="+name+"&date="+date+"&Inline_items="+Inline_items_Sringyfied+"&new_Inline_items="+new_Inline_items_Sringyfied);
		
		//alert("Stop");
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	/** 
	*	@Discription:	Enable/Disable the equipment selection
	*	
	*	@param (void)
	*
	*	@return (void)
	*/
	function Allow_Equipment(state)
	{
		$("#Equipment").prop("disabled", state);
		document.getElementById("Equipment").value="";
	}
	
	
	/**
	*	@Discription:	
	*	
	*	@param (String) 
	*	@param (String) 
	*
	*	@return (void)
	*/


	
	//this function loads the input 
	function showqty(stock_id, inline_item_id)
	{
	  
	
  
		if(stock_id == stock_id)
		{
		 //id="qtysheet2_input_field_row_'+inline_item_index+'" style="display:block"
		var cl2=inline_item_id;


	     
		cl2="qtysheet2_input_"+cl2;
	
		
			   document.getElementById(cl2).style.display="block";
			
			
              inline_item_id="envqty_input_"+inline_item_id; 

			//alert(inline_item_id);
			document.getElementById(inline_item_id).style.visibility="visible";
	
		}
		
	
		
		
		
				if(stock_id == "PrintedForm")
		{
			//alert(stock_id);
			
			inline_item_id="sheet1_input_"+inline_item_id; 
       
		
			//document.getElementById(inline_item_id).style.visibility="visible";
			
	
			
			
		}
	
		
					
		else
		{
			
					
		}
		
		//alert("stop");
	}

function get_stock_fields1(stock_type, edit_new_inline_item_index)
	{
		//alert(stock_type);
		//alert(edit_new_inline_item_index);
		//Variables
		var location=document.getElementById('location_edit').value;
		if(location=="Printery"){
			location="Warehouse1";
		}
			if(location=="Office"){
			location="Warehouse2";
		}
			if(location=="Events"){
			location="Warehouse3";
		}
		//alert(location);
		var Options;
		var xhttp = new XMLHttpRequest();
		edit_new_inline_item_index+="_stock";
		//alert(inline_item_id);
	
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					//alert(xhttp.responseText);
					Options = xhttp.responseText;
					document.getElementById(edit_new_inline_item_index).innerHTML = Options;
				}
				else
				{
					alert("An error occured while trying to get the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Stock_in_Types&Type="+stock_type+"&location="+location, true);
		xhttp.send();
		
		//alert(Stock_field);
		//alert("stop");
	}
	
	

	//This  function loads the envelope input 

	


  function reload(){
    setTimeout(function(){location.reload()}, 3000);
    var timer = null;
  }


	
	
	//_______________________________[Loaded functions to b executed when the page is ready]______s________________________________________________
	$(document).ready(function()
	{
		//reorder();
	//alert('working');
		
		
		
		
$("#edit").click(function() {
		

 //reload();
 
	});
	
	$("#use").click(function() {
		

//reload();
 
	});


		
		//Load default reveival listing table
		
		
		$('#search_field').keyup(function()
		{
			Search_Usage_table();
		});
		
		//Apply style to check box
		//$("[name='Equipment_checkbox']").bootstrapSwitch();
		//Add validator to form -Gavin Palmer || March 2016
		$('#Create_ID').validator();
		$('#Create_ID1').validator();
		$('#Edit_Create_ID').validator();
		$('#Edit_Create_ID1').validator();
		
		//Prevent submition of form and check if the required fields are filled in-Gavin Palmer || March 2016
		$('#Create_ID').validator().on('submit', function (e)
		{
			var no_error=true;
			
			e.preventDefault();
			
			if(e.isDefaultPrevented())
		  	{
				
				if($("#Recdate").val() == null || $("#Recdate").val() === "")
				{
					no_error=false;
				}
				
				/*if($("#Equipment").val() == null || $("#Equipment").val() === "")
				{
					no_error=false;
				}*/
				
				//Create_Receival(no_error);
				//$('#_submit').prop('disabled', true);
		  	}
		 	 else
		  	{
				// everything looks good!
				//alert("everything is good");
		  	}
		})
		
		
			$('#Create_ID1').validator().on('submit', function (e)
		{
			var no_error=true;
			
			e.preventDefault();
			
			if(e.isDefaultPrevented())
		  	{
				
				if($("#Recdater").val() == null || $("#Recdater").val() === "")
				{
					no_error=false;
				}
				
				/*if($("#Equipment").val() == null || $("#Equipment").val() === "")
				{
					no_error=false;
				}*/
				
				//Create_Receival(no_error);
				//$('#_submit').prop('disabled', true);
		  	}
		 	 else
		  	{
				// everything looks good!
				//alert("everything is good");
		  	}
		})
		
		
		
		
		
		$('#Edit_Create_ID').validator().on('submit', function (e)
		{
			var no_error=true;
			
			e.preventDefault();
			
			if(e.isDefaultPrevented())
		  	{
				
				
				
				/*if($("#Equipment_Edit").val() == null || $("#Equipment_Edit").val() === "")
				{
					no_error=false;
				}*/
				
				//Update_Usage(no_error);
				//$('#_submit').prop('disabled', true);
		  	}
		 	 else
		  	{
				// everything looks good!
				//alert("everything is good");
		  	}
		})
		
		
		
		$('#Edit_Create_ID1').validator().on('submit', function (e)
		{
			var no_error=true;
			
			e.preventDefault();
			
			if(e.isDefaultPrevented())
		  	{
				
				
				
				/*if($("#Equipment_Edit").val() == null || $("#Equipment_Edit").val() === "")
				{
					no_error=false;
				}*/
				
				//Update_Usage(no_error);
				//$('#_submit').prop('disabled', true);
		  	}
		 	 else
		  	{
				// everything looks good!
				//alert("everything is good");
		  	}
		})
		
		
		
	});
	
</script>
<style type="text/css">
<!--/*@import url('http://getbootstrap.com/dist/css/bootstrap.css');*/
-->
</style>

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
                                   
                                    <h4 class="page-title">Lunch Room</h4>
                                </div>
                            </div>
                        </div>
     <div class="card-box" >
	
      
 	<!--banner-->	
		    <div class="banner" id="usg1" style="display:block">
		    	
		    	<!--<h5>
				<a href="#" onClick="switch_page(0);" style="color: #22A7F0;">Rental History</a> &nbsp;&nbsp; &nbsp;&nbsp;
			<a href="#" onClick="switch_page(6);" style="color: #22A7F0;">Return History</a> &nbsp;&nbsp; &nbsp;&nbsp;
			
				
			
					
											
				<a href="#" onClick="switch_page(4);" style="color: #22A7F0;">Teachers Listing</a>	
			
			
				</h5>-->
		    </div>
		<!--//banner-->
 	 <!--This is the Usage inventory-->
 	 
 	 
 	 
 	 
 	 
 	
             
                        
               
		<!-- -->

<!--*************** Create Usages Page ****************************************************************************************************************************************************************data -->
	
	
	
	
	
	
	

		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<div id="Enter_Receival" class="blank" style="display: block; overflow-y: auto;">
		<form id="Create_ID" data-toggle="validator" role="form" class="" autocomplete="off" onsubmit="return false">
			<div class="form-group">
				<div class="row col-md-12 custyle">
					
						
					
								
								
					
								</br>	
						
							
									
									
									<div class="input-group">
										<div class="input-group-addon">
											<span class=""></span> SCAN BARCODE
										</div>
										<input class="form-control" id="barcode" name="barcode" type="text" placeholder="Barcode"/>
									</div>
									<div class="help-block with-errors"></div>		
								
									
						
												
				</div>
					
			
					
				<div id="Message" style="padding: 10px; text-align: center">
				</div>
					
				<div id="fields">   <!--This is the page input usage item starts here ****************************************-->
				 
				</div>
				<br/>
			<button type="submit" class="btn btn-primary" style="border-radius: 10px;" onClick="add_fields();"> <span class="glyphicon glyphicon-plus">&nbsp;Scan Barcode</span></button><!--This add new row in -->	
			
			<br/>

		<!--	<center>
					<button type="button" id="use" class="btn btn-success" style="width: 80%; border-radius: 10px;" onClick="Create_Receival();">Process Rental&nbsp;<span class="glyphicon glyphicon-plus-sign"></span></button>
		</center>	-->
				
				
		</form>
		
		
		<form id="rental_ID" data-toggle="validator" role="form" class="" autocomplete="off">
			<div class="form-group">
				
				 
			</div>  
			
	</form>
	</div>
		
		
	
	
	<!--//faq-->
		<!---->
	        	
	</div>
	
	
	
	
	
	
	
	
	
	
	
	</div>	
		</div>
		<div class="clearfix"> </div>
       </div>
     
<!---->     <div class="side-bar right-bar">
                <div class="nicescroll">
                    
            </div>
            <!-- /Right-bar -->

        </div>
<!--scrolling js-->

            </div>
            
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
       
        <!-- END wrapper -->


    
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
            	
            	
            var oTable = null;
		 oTable = $('#datatable-fixed-header').dataTable( {
                 "sPaginationType": "full_numbers",
                 "aaSorting": [[ 0, "asc" ]],
                 "iDisplayLength": 10,
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
            	
            	
            	 oTable = $('#datatable-fixed-header2').dataTable( {
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
            	
            	
            	
             	
            	 oTable = $('#datatable-fixed-header3').dataTable( {
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
            	  $('#barcode').focus();
            	
            	
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "../plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
               // var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
             
               
            } );
            TableManageButtons.init();

        </script>
        
        <!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->

    
    </body>
</html>
