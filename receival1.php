<?php
include 'reorder.php';
//include('page.php');
session_start();
include 'lnav.php';
error_reporting(E_ALL & ~E_NOTICE);

$dir="";
require_once($dir."classes/Session_Manager.php");

$Session_Manager = new Session_Manager();


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
                    <title>Books Receivals</title>

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
         
         
		 
		 $( "#Recdate_Edit" ).datepicker({
            dateFormat:"yy-mm-dd"
         });
     });
});



</script>
  
<!-- Mainly scripts -->
<script src="js/jquery.metisMenu.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<link href="css/custom.css" rel="stylesheet">
<script src="js/custom.js"></script>
<script src="js/screenfull.js"></script>
<script>

	//Global JS variables
	var inline_item_index=0;
	var edit_new_inline_item_index=0;
	
	//Dynamically get all the types -Imani Sterling || March 2016
	var type_options = "<?php
							//database connection variables
					$db_servername = "localhost";
		            $db_username = "dert1_pembrokehh";
		            $db_password = "pembrokehhs";
		            $db_name =  "dert1_pembrokehhs";
						
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
	
	
	function switch_page(index)
	{
		switch (index)
		{
			case 0:
				document.getElementById("Receival_listing").style.display = "block";
				document.getElementById("Enter_Receival").style.display = "none";
				document.getElementById("Edit_Receival").style.display = "none";
				Load_Default_Receival_table();
				break;
				
			case 1:
				document.getElementById("Enter_Receival").style.display = "block";
				document.getElementById("Receival_listing").style.display = "none";
				document.getElementById("Edit_Receival").style.display = "none";
				break;
				
			case 2:
				document.getElementById("Edit_Receival").style.display = "block";
				document.getElementById("Enter_Receival").style.display = "none";
				document.getElementById("Receival_listing").style.display = "none";
				break;
				
		}
	}
	
	

	function add_fields()
	{
		//alert("Satrt");
		inline_item_index=inline_item_index+1;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="field_row_"+inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
		                      
		                       
		                          
		                   // this is the 1st option select 
		                   	  +'<hr style="height: 1px; width: 100%; background-color: #999999;"/>'
		                   	  +'<br/>'
		               
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								
								 +'	<select class="form-control equipment_type" id="field_row_'+inline_item_index+'_Type" name="Type" onChange="get_stock_fields(this.value, \'field_row_'+inline_item_index+'\'); showqty(this.value, \'field_row_'+inline_item_index+'\');showqty1(this.value, \'field_row_'+inline_item_index+'\'); showqty2(this.value, \'field_row_'+inline_item_index+'\'); showqty3(this.value, \'field_row_'+inline_item_index+'\'); showqty4(this.value, \'field_row_'+inline_item_index+'\');showqty5(this.value, \'field_row_'+inline_item_index+'\');">'
								
								 +'				<option  value=""  disabled selected  >Type</option>'
								 +'				'+type_options				
								 +'			</select>'  
								 +'		</div>'
								 +'	</div>'
							
								// this is the 1st option select
							
								    
								 +'	<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-shopping-cart"></span>'
								 +'			</div>'
								 +'		<div class="grouped_select required receival_rec_lineitems_stock_id">'
								 +'			<select class="grouped_select required form-control Stocks" name="Stocks" id="field_row_'+inline_item_index+'_stock" required>'
								 +'					<option value="" disabled selected>Stock</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								 
								 			//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	
								 		 +'<div class="col-md-2 custyle" id="qtysheet2_input_field_row_'+inline_item_index+'" style="display:none">'
								 +'		<div class="input-group">'
								
								 
								   +'			<input class="form-control" id="field_row_'+inline_item_index+'_papersheet" name="papersheet" type="number" placeholder="Quantity"/ required>'
								   +'			<input class="form-control" id="field_row_'+inline_item_index+'_unitcost" name="unitcost" type="number" placeholder="Unit Cost"/ required>'
								     +'		<!--	<label for="sel1"></label><select class="form-control" id="sel1" required><option value="" disabled selected>Location:</option><option>Warehouse1</option><option>Warehouse2</option><option>Warehouse3</option></select>-->'
								  +'		</div>'
								
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
								 
			
						 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Remove</span></button>'
								 +'	</div>';
								 
								  +'	</br>';
								   +'	</br>';
								   
								  
							
								 +''
	
							
		document.getElementById("fields").appendChild(new_line_item);
		size=document.getElementById("field_row_'+inline_item_index+'_stock").value;
	
		//alert("Stop");
	}
	

	function get_stock_field(stock_type, inline_item_id)
	{
		//alert(stock_type);
		//alert(inline_item_id);
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
	
	
	
	
	
	
		function Create_Receival()
	{
		///alert('working');
		//Variables
		var location="Warehouse1";
		var Invoice_Number = document.getElementById("Invoice_Number").value;
		var Recdate = document.getElementById("Recdate").value;
		var manudate = document.getElementById("manudate").value;
		var name = document.getElementById("name").value;
		var subject = document.getElementById("subject").value;
		var pub = document.getElementById("pub").value;
		var auth = document.getElementById("auth").value;
	//	var qty = document.getElementById("qty").value;
		

		
		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					var result=xhttp.responseText;
					alert(result);
					document.getElementById("Message").innerHTML = xhttp.responseText;
					$('#Message').delay(5000).fadeOut(400)
					
					if (result.match(/Receival Created.*/)) {
                        	/*document.getElementById("Invoice_Number").value="";
					document.getElementById("Recdate").value="";
					document.getElementById("location").value="";
		document.getElementById("fname").onfocus
					document.getElementById("fields").innerHTML = "";*/
					reload();
					
					
                       }
                     
                       			else if (result.match(/ISBN already present.*/)) {
             	 document.getElementById("Invoice_Number").value="";
		 document.getElementById("Recdate").value="";
		document.getElementById("manudate").value="";
		 document.getElementById("name").value="";
		 document.getElementById("subject").value="";
		document.getElementById("pub").value="";
		document.getElementById("auth").value="";
					//reload();
					
					
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
		//xhttp.send("Query=Add_Usage&Invoice_Number="+Invoice_Number+"&Usagedate="+Usagedate+"&Inline_items="+Inline_items_Sringyfied);
		xhttp.send("Query=Add_Recieval&Invoice_Number="+Invoice_Number+"&Recdate="+Recdate+"&manudate="+manudate+"&name="+name+"&subject="+subject+"&pub="+pub+"&auth="+auth+"&location="+location);
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
	function Remove_Receival(row,id) //This is the function to remove the receivals for the Receival Tabel
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
					//alert(xhttp.responseText);
					document.getElementById("Receival_listing_Message").innerHTML =xhttp.responseText;
					$('#Receival_listing_Message').delay(5000).fadeOut(400);
					$('#Listing_row_'+row).delay(1000).fadeOut(400);
					

					//Rtest(sid);
					
					
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Remove_Receival&rid="+id, true);
		xhttp.send();
		//alert("stop");
		
	}
		function Rtest(id) //This is the function to remove the receivals for the Receival Tabel
	{
	
		//alert("start");
	//var sid=326;
		//alert("stop");
		// this function is for the reorder level
			var xhttp1 = new XMLHttpRequest();
		
	
	
		xhttp1.onreadystatechange = function()
		{
			if(xhttp1.readyState == 4)
			{
				if(xhttp1.status == 200)
				{
					if(xhttp1.responseText==""){}
					else{alert(xhttp1.responseText);}
					
					document.getElementById("Receival_listing_Message").innerHTML =xhttp1.responseText;
					$('#Receival_listing_Message').delay(5000).fadeOut(400);
					$('#Listing_row_'+row).delay(1000).fadeOut(400);
					
					reload();
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp1.open("POST", "reorder.php", true);
		xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp1.send("&sid="+id);
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
								 +'			<select class="form-control equipment_type" id="field_row_'+inline_item_index+'_Type" name="Type" onChange="get_stock_fields(this.value, \'field_row_'+inline_item_index+'\');">'
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
								 +'					<option value="" disabled selected>Stock</option>'
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
								 +''
			
		document.getElementById("fields").appendChild(new_line_item);
		//alert("Stop");
	}
	
	
	/** -Imani Sterling || March 2016
	*	@Discription:	add new field for every attemp collected for the receival
	*	
	*	@param void
	*
	*	@return void
	*/

	
	/** -Imani Sterling || March 2016
	*	@Discription:	bring up edit receival page
	*	
	*	@param (void)
	*
	*	@return (void)
	*/
	
	
		function Del_Receival(id)
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
					//alert(xhttp.responseText);
					document.getElementById("Receival_listing_Message").innerHTML = "Receival deleted";
					$('#Receival_listing_Message').delay(5000).fadeOut(400);
					$('#Listing_row_'+id).delay(1000).fadeOut(400);
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Del_Receival&id="+id, true);
		xhttp.send();
		//alert("stop");
	}
	
	function Show_Edit_Receival(id)
	{
		//alert(id);
		//Variables
		
		
		//Switch views to show the receival page -Imani Sterling || March 2016
	
		
		//Get and display basic receival information -Imani Sterling || March 2016
		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
					
				if(xhttp.status == 200)
				
				{
					
					
					
					switch_page(2);
					
				
					//alert('Start');
					//alert(id);
				   // alert(xhttp.responseText);
					var receival_object = JSON.parse(xhttp.responseText);
				
 if (receival_object.location=="Warehouse1"){
 	receival_object.location="Printery";
 }
 if (receival_object.location=="Warehouse2"){
 	receival_object.location="Office";
 }
 if (receival_object.location=="Warehouse3"){
 	receival_object.location="Events";
 }
					
					document.getElementById('Invoice_Number_Edit').value = receival_object.Invoice_Number;
					document.getElementById('ID_Number_Edit').value = id;
					document.getElementById('Recdate_Edit').value = receival_object.Recdate;
				
					document.getElementById('location_edit').value = receival_object.location;
						
				
				}
				else
				{
					alert("An error occured while trying to get the data you requested: "+xhttp.responseText);
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Basic_Receival_info&id="+id, true);
		xhttp.send();
		
		//Get and display basic receival information -Imani Sterling || March 2016
		var xhttp_line_items = new XMLHttpRequest();
		
		xhttp_line_items.onreadystatechange = function()
		{
			if(xhttp_line_items.readyState == 4)
			{
				if(xhttp_line_items.status == 200)
				{ //alert('herer')
					//alert(xhttp_line_items.responseText);
					document.getElementById('fields_Edit').innerHTML = ""; //Clear the section of the page before writing to it
					var line_item_objects = JSON.parse(xhttp_line_items.responseText);
					
					for (a = 0; a < line_item_objects.length; a++)
					{
						Edit_add_field(a, line_item_objects[a].id,line_item_objects[a].rid,line_item_objects[a].stock_id,line_item_objects[a].name, line_item_objects[a].equip, line_item_objects[a].qty,line_item_objects[a].unitcost); 
						//alert(line_item_objects[a].id);
					}
					
					//Rtest(sid);
					

				}
				else
				{
					alert("An error occured while trying to get the data you requested: "+xhttp.responseText);
				}
			}
		};
		xhttp_line_items.open("GET", "php/Query_Manager.php?Query=Get_Receival_line_items_JSON&id="+id, true);
		xhttp_line_items.send();
		
		
		//alert('Stop');
	}
	
		function Edit_add_field(row_num, id,rid,stock_id,name,equip,qty,unitcost)
	{
		

		edit_inline_item_index=row_num;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="edit_field_row_"+edit_inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
		                   	   +'	</br>'
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								
								 +'	<select class="form-control equipment_type" id="edit_field_row_'+edit_inline_item_index+'_Type" name="Type">'
								
								 +'				<option value="'+equip+'" selected>'+equip+'</option>'
											
								 +'			</select>'  
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_usageid" name="id" type="hidden" value="'+rid+'" placeholder="id"/>'
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_stockid" name="stockid" type="hidden" value="'+stock_id+'" placeholder="stock id"/>'
								 +'		</div>'
								 +'	</div>'
							
								// this is the 1st option select
								
								 
								    
								 +'	<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-shopping-cart"></span>'
								 +'			</div>'
								 +'		<div class="grouped_select required receival_rec_lineitems_stock_id">'
								 +'			<select class="grouped_select required form-control Stocks" name="Stocks" id="edit_field_row_'+edit_inline_item_index+'_stock">'
									 +'					<option value="'+stock_id+'" selected>'+name+'</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'

								 		 +'<div class="col-md-2 custyle">'
								 +'		<div class="input-group" id="qtysheet2_input_field_row_'+edit_inline_item_index+'" style="visibility: visible">'
								
																  	+'<div class="input-group">'
										+'<div class="input-group-addon">Qty'
											+'<span class=""></span>' 
										+'</div>'
										 +'			<input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_paperqty" name="qty" type="number" value="'+qty+'"placeholder="Quantity"/>'
								
										+'</div>'
										
													  	+'<div class="input-group">'
										+'<div class="input-group-addon">Unit $'
											+'<span class=""></span>' 
										+'</div>'
											 +'			<input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_unitcost" name="unitcost" type="number" value="'+unitcost+'"placeholder="Unit Cost"/>'
								
										+'</div>'

								
								
								
							
								  +'		</div>'
								  
								
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
	
						 
								 +'<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();Del_Receival('+rid+');"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Del</span></button>'
								 +'	</div>'
								 
								  +'	</br>'
								   +'	</br>'
							
								 +''
			
		document.getElementById("fields_Edit").appendChild(new_line_item);
		
		
		
	}
	
	
	
	function edit_new_add_fields()
	{
		//alert("Satrt");
		edit_new_inline_item_index=edit_new_inline_item_index+1;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="edit_new_field_row_"+edit_new_inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
								   +'<hr style="height: 1px; width: 100%; background-color: #999999;"/>'
		                   	  +'<br/>'
		               
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								
								 +'	<select class="form-control equipment_type" id="edit_new_field_row_'+edit_new_inline_item_index+'_Type" name="Type" onChange="get_stock_fields1(this.value, \'edit_new_field_row_'+edit_new_inline_item_index+'\');">'
								
								 +'				<option  value=""  disabled selected  >Type</option>'
								 +'				'+type_options				
								 +'			</select>'  
								 +'		</div>'
								 +'	</div>'
							
								// this is the 1st option select
							
								    
								 +'	<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-shopping-cart"></span>'
								 +'			</div>'
								 +'		<div class="grouped_select required receival_rec_lineitems_stock_id">'
								 +'			<select class="grouped_select required form-control Stocks" name="Stocks" id="edit_new_field_row_'+edit_new_inline_item_index+'_stock" required>'
								 +'					<option value="" disabled selected>Stock</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								 
								 
			
		
								//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	 
								
								  
						
							 						//This is the input for Envelope usageage spoilage amount this has 2 input	
						
								
 		 			
								//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	
								 		 +'<div class="col-md-2 custyle" id="qtysheet2_input_field_row_'+edit_new_inline_item_index+'" style="display:block">'
								 +'		<div class="input-group">'
								
								 
								   +'			<input class="form-control" id="edit_new_field_row_'+edit_new_inline_item_index+'_papersheet" name="papersheet" type="number" placeholder="Quantity"/ required>'
								   +'			<input class="form-control" id="edit_new_field_row_'+edit_new_inline_item_index+'_unitcost" name="unitcost" type="number" placeholder="Unit Cost"/ required>'
								     +'		<!--	<label for="sel1"></label><select class="form-control" id="sel1" required><option value="" disabled selected>Location:</option><option>Warehouse1</option><option>Warehouse2</option><option>Warehouse3</option></select>-->'
								  +'		</div>'
								
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
								 
			
					
								 
								 	 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Clear</span></button>'
								 +'	</div>';
							 
							 
								  +'	</br>';
								   +'	</br>';
								   
								  
							
								 +''
			
		document.getElementById("new_fields_Edit").appendChild(new_line_item);
		//alert("Stop");
	}
  
  function Remove_Receival_line_item(row,id)
	{
		//alert("start");
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
					//document.getElementById("Receival_listing_Message").innerHTML = "Receival deleted";
					//$('#Receival_listing_Message').delay(5000).fadeOut(400);
					$('#edit_field_row_'+row).delay(500).fadeOut(400);
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Remove_Receival_line_item&id="+id, true);
		xhttp.send();
		//alert("stop");
	}
	
	
	/** -Imani Sterling || March 2016
	*	@Discription:	Collect and send of sets of information required to update the receival information
	*	
	*	@param (void)
	*
	*	@return (void)
	*/
	function Update_Receival()
	{
		var sid=localStorage.getItem('sid');
		    //alert(sid);
		var ID = document.getElementById("ID_Number_Edit").value;
		var Invoice_Number = document.getElementById("Invoice_Number_Edit").value;
		var Recdate = document.getElementById("Recdate_Edit").value;
		var location = document.getElementById("location_edit").value;
		//alert(location);
		var location1 = document.getElementById("location_edit").value;
		if(location=="Printery"){
			location="Warehouse1";
		}
			if(location=="Office"){
			location="Warehouse2";
		}
			if(location=="Events"){
			location="Warehouse3";
		}
		var stock_id = sid;
		
		var Inline_items = []; //Array to hold the list of inline items that will be purchase -Imani Sterling || March 2016
		var Inline_items_Sringyfied = ""; //array of objects stringyfied to be passed on to the server  -Imani Sterling || March 2016
		var new_Inline_items = []; //Array to hold the list of newly added inline items that will be purchase -Imani Sterling || March 2016
		var new_Inline_items_Sringyfied = ""; //array of of newly added inline items  objects stringyfied to be passed on to the server  -Imani Sterling || March 2016
		
			
		//Take all the values of the inline items rows and store the rows individually in objects  -Imani Sterling || March 2016
		//Firstly find each inline item row by id of the row
	
		$('div[id^="edit_field_row_"]').each(function()
		{
			//Secnding store the fields of the rows in variables to be added to the object
			var Item_ID = $("#"+this.id+"_usageid").val();
			var Stock_ID = $("#"+this.id+"_stock").val();
			var Type = $("#"+this.id+"_Type").val();
			
			//this is for the paper
			var Quantity = $("#"+this.id+"_paperqty").val();
			var unitcost = $("#"+this.id+"_unitcost").val();
		    var stockid = $("#"+this.id+"_stockid").val();
	
			//Add the value to the object
			var Inline_item = {}; //Empty Inline Item object
			Inline_item["Item_ID"] = Item_ID;
			Inline_item["Stock_ID"] = Stock_ID;
			
			Inline_item["Quantity"] = Quantity;
			Inline_item["unitcost"] = unitcost;
			Inline_item["stockid"] = stockid;
		
			
			//Thirdly, add the object to the already existing array of objects
			Inline_items.push(Inline_item);
		});
		
		//Stringyfy array of inline items to be passed to the servers as one variable
		var Inline_items_Sringyfied = JSON.stringify(Inline_items);


		$('div[id^="edit_new_field_row_"]').each(function()
		{
			//Secnding store the fields of the rows in variables to be added to the object
			var stock = $("#"+this.id+"_stock").val();
			var type = $("#"+this.id+"_Type").val();
			var qty = $("#"+this.id+"_papersheet").val();
			var unitcost = $("#"+this.id+"_unitcost").val();
			
			
			//Add the value to the object
			var Inline_item = {}; //Empty Inline Item object
			Inline_item["stock"] = stock;
			Inline_item["type"] = type;
			Inline_item["qty"] = qty;
			Inline_item["unitcost"] = unitcost;
			
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
					/*alert(xhttp.responseText);
					
					document.getElementById("Invoice_Number_Edit").value="";
					document.getElementById("ID_Number_Edit").value="";
					document.getElementById("Recdate_Edit").value="";
					document.getElementById("fields_Edit").innerHTML = "";
					document.getElementById("new_fields_Edit").innerHTML = "";*/
					document.getElementById("Message1").innerHTML =xhttp.responseText;
					$('#Message1').delay(5000).fadeOut(400)
					//alert(Type);
					var sid=localStorage.getItem('sid');
				   //alert(sid);
				   //Rtest(sid); 
					//
					//switch_page(0);
					reload();
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
		xhttp.send("Query=Update_Recieval&ID="+ID+"&Invoice_Number="+Invoice_Number+"&stock_id="+stock_id+"&Recdate="+Recdate+"&location="+location+"&Inline_items="+Inline_items_Sringyfied+"&new_Inline_items="+new_Inline_items_Sringyfied);
		
		//alert("Stop");
	}
	
	
	/** -Imani Sterling || March 2016
	*	@Discription:	
	*	
	*	@param (void)
	*
	*	@return (void)
	*/
	function Create_Receival_validator()
	{
		/*alert("start validation");
		check_numeric("Invoice_Number");
		//Invoice_Number*/
		return true;
	}
	
	
	//_______________________________[Loaded functions to b executed when the page is ready]______s________________________________________________
	$(document).ready(function()
	{
		switch_page(1);

	
    //document.getElementById("Invoice_Number").style.backgroundColor = "red";
    

		//Load default reveival listing table
		//Load_Default_Receival_table();
		
		$('#search_field').keyup(function()
		{
			Search_Receival_table();
		});
		
		
		//Add validator to form -Imani Sterling || March 2016
		$('#Create_ID').validator();
		$('#Edit_Create_ID').validator();
		
		//Prevent submition of form and check if the required fields are filled in-Imani Sterling || March 2016
		$('#Create_ID').validator().on('submit', function (e)
		
		{
			
			var no_error=true;
			
			e.preventDefault();
			
			if(e.isDefaultPrevented())
		  	{
				if($("#Invoice_Number").val() == null || $("#Invoice_Number").val() === "" || $("#Invoice_Number").val() == 0)
				{
					no_error=false;
				}
				if($("#Recdate").val() == null || $("#Recdate").val() === "")
				{
					no_error=false;
				}
				
				
				
				Create_Receival(no_error);
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
				if($("#Invoice_Number_Edit").val() == null || $("#Invoice_Number_Edit").val() === "" || $("#Invoice_Number_Edit").val() == 0)
				{
					no_error=false;
				}
				if($("#Recdate_Edit").val() == null || $("#Recdate_Edit").val() === "")
				{
					no_error=false;
				}
				
				Update_Receival(no_error);
				//$('#_submit').prop('disabled', true);
		  	}
		 	 else
		  	{
				// everything looks good!
				//alert("everything is good");
		  	}
		})
		      
      function fetch_stock()  
      {  
           $.ajax({  
                url:"addreceivals.php",  
                method:"POST",  
                success:function(data){  
                     $('#receivaldata').html(data);  
                }  
           });  
      } 
      $(document).on('click', '#fun', function(){ //call function to get stock data from database 
            fetch_stock();  
            
      }); 
		
		
	});

-->
</script> 
 

<script>

function check(){  //this function load content to a div
$('#live_data').load('purchaseorder.html');
}

	//this function loads the input 
	function showqty(stock_id, inline_item_id)
	{
	  
	
  
		if(stock_id == stock_id)
		{
		
		var cl2=inline_item_id;


	     
		cl2="qtysheet2_input_"+cl2;
	
		
			   document.getElementById(cl2).style.display="block";
			
			
              inline_item_id="envqty_input_"+inline_item_id; 

			//alert(inline_item_id);
			document.getElementById(inline_item_id).style.visibility="visible";
	
		}
		

	}

	function showqty(stock_id, inline_item_id)
	{
	  
	
  
		if(stock_id == stock_id)
		{
		
		var cl2=inline_item_id;


	     
		cl2="qtysheet2_input_"+cl2;
	
		
			   document.getElementById(cl2).style.display="block";
			
			
              inline_item_id="envqty_input_"+inline_item_id; 

			//alert(inline_item_id);
			document.getElementById(inline_item_id).style.visibility="visible";
	
		}
		

	}


function reload(){
    setTimeout(function(){location.reload()}, 3000);
    var timer = null;
  }

function stock(sid){
	var sid=sid;
	//alert(sid);
	localStorage.setItem('sid',sid);
}
  </script>

<script type="text/javascript"> 



 $(document).ready(function(){
 	

 
   		
$("#edit").click(function() {
		

 reload();
 
	});

   
 	
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
            <div class="content-page"  >
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

           
                <div class="table-responsive">  
         
                        
                </div>  
                      
                 <div class="card-box" style="overflow-y: auto;overflow-x:hidden;">
           
                <div class="table-responsive">  
         	<div class="receivaldata">
               <h3 align="right"></h3>
                        	
                        			
              
                  <div class="" style="overflow-y: auto ">
 
 	<!--banner-->	
		     <div class="banner" id="usg1" style="display: block">
		    	<h5>
				<a href="#" onClick="switch_page(0);" style="color: #22A7F0;">Book Receivals</a> &nbsp;&nbsp;&nbsp;&nbsp;
			
				<!--span>Receival listing</span-->
				
				
										
	<!--<span class="glyphicon glyphicon-barcode"> </span>-->	
	<a href="#" onClick="switch_page(1);" style="color: #22A7F0;"> Input Book</a>
			
				
				
	
				</h5>
		    </div>

 	<div id="Receival_listing" class="blank" style="overflow-y: none; display: none">
		
	
		
		<!--Adding in page info-->
		








                        <div id="try" class="row">
                        	
                            <div class="col-sm-12">
                                <div class="card-box table-responsive"  style="overflow-x:hidden">

                                    <h4 class="m-t-0 header-title"><b>Receivals</b></h4>
                                 <div id="Receival_listing_Message" style="padding: 10px; text-align: center">
			</div>

                                    <table id="datatable-fixed-header" class="table table table-hover m-0">
                                       
                                       
                                        <thead>
                                            <tr>
                                            	<th style="display: none">#</th>
                                                <th>ISBN</th>
                                                <th>Title</th>
                                                <th>Date</th>
                                                <th>Location</th>
                                               
                                                
                                                                                          
      <?php	if($GLOBALS['role']>0 && $GLOBALS['role']<3)
				{
				  echo "<th>Action</th>";	
                     }
?>
                                               
                                            </tr>
                                        </thead>
<tbody id="" style="" >

  
                                        	
                                       <?php
require 'db.php';



	
	$sql = "SELECT DISTINCT receivals.*,rec_lineitems.location,rec_lineitems.name
	FROM receivals 
	 INNER JOIN rec_lineitems 
	ON rec_lineitems.receival_id=receivals.id";
	
	 
					
					
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
											  
										       
												$inv=$row["invoice_number"];
												$rec=$row["recdate"];
												$name=$row["name"];
												$item=$row["item"];
												$location=$row["location"];
												$qty=$row["qty"];
											
												$cost=$row["cost"];
									$myNumber = $cost;			
									
									
										if($type=="")
									{$type="-";
									}
										if($location=="Warehouse1")
									{
										$location="Book Room";
									}
									if($location=="Warehouse2")
									{
										$location="Office";
									}	
									if($location=="Warehouse3")
									{
										$location="Events";
									}
										if($item=="")
									{$item="-";
									}		
											
									
									if($qty=="")
									{$qty="&nbsp;&nbsp;&nbsp;&nbsp;-";;
									}		
										
													
										
									 $name1=wordwrap($name,20, '<br>');	
									
												
												
												
												
											echo"
												
											<tr id='Listing_row_$id' class='text-black' >
											<td style='display: none'><b>$id</b></td>
											<td><b>$inv</b></td>
											<td><b>$name</b></td>
											<td><b>$rec</b></td>
											
											
										    <td><b>$location</b></td>";
										
										    
																		
		if($GLOBALS['role']>0 && $GLOBALS['role']<3)
				{
				  echo "<td align=''> <a class='btn btn-primary btn-md button_style_addon' href='#' onClick='Show_Edit_Receival($id);stock($id)'; style='border-radius: 5px;'><span class='glyphicon glyphicon-edit'></span> Edit</a> <a href='#' class='btn btn-danger btn-md button_style_addon' style='border-radius: 5px;' onClick='Remove_Receival($id,$id);'><span class='glyphicon glyphicon-remove'></span> Del</a></td></tr>";
				}
				
						
						
					
														
											
												
												
												
												
			}
		}


}
?> 	
                                       	
                                        	
                                        	
                                            
                                            
                              	</tbody>
                                    </table>
                                </div>
                            </div>
                        </div></div>
	
	<div id="Enter_Receival" class="blank" style="display: none; overflow-y: auto;">
		<form id="Create_ID" data-toggle="validator" role="form" class=""  autocomplete="off">
			<div class="form">
				<div class="row col-md-12 custyle">
								
									<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-tags"></span> 
										</div>
										<input class="form-control" id="name" name="name" type="text" placeholder="Name/Title" required/>
									</div>
									<br/>
									
							<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-book"></span> 
										</div>
									
										<select class="form-control" id="subject" name="subject" onChange="" >
											<option   value="" disabled selected>Select Subject</option>
												<?php


													$sql = "SELECT name FROM user_req";
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
																$data_row_item_formatted = '<option value="'.$row["name"].'">'.$row["name"].'</option>';
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
												?>
										</select>
									</div>
									<br/>
									
								
									
									<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-user"></span> 
										</div>
										<input class="form-control" id="auth" name="auth" type="text" placeholder="Author" required/>
									</div>
									<br/>
									
									<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-list-alt"></span> 
										</div>
										<input class="form-control" id="pub" name="pub" type="text" placeholder="Publisher" required/>
									</div>
									
									<div class="help-block with-errors"></div>
									
										<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span> 
										</div>
										<input class="form-control" id="manudate" name="manudate" type="text" placeholder="Manufacture date" required/>
									</div>	
									<br/>
									
									<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span> 
										</div>
										<input class="form-control" id="Recdate" name="Recdate" type="text" placeholder="Received date" required/>
									</div>	
								<!--
									
										<div class="input-group" style="display: none;">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-plus"></span> 
										</div>
										<input class="form-control" id="qty" name="qty" type="number" placeholder="Quantity" required/>
									</div>	-->
									<br/>
									
									<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-barcode"></span> 
										</div>
										<input class="form-control" id="Invoice_Number" name="Invoice_Number" type="text" placeholder="ISBN #"  required/>
									</div>
									
									
								
									<div class="input-group"style="display: none">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span> 
										</div>
									<label for="sel1"></label><select class="form-control" id="location"><option value="" hidden selected>Location:</option><option value='Warehouse1'>Printery</option><option value='Warehouse2'>Office</option><option value='Warehouse3'>Events</option></select>
									<div class="help-block with-errors"></div>
									
				</div>
				<br/>
				<br/>
					</div>	
				
					
				<div id="Message" style="padding: 10px; text-align: center">
				</div>
					<!--<script>document.getElementById('location').value;</script>-->
				<div id="fields">
				
						
						</div>
				</div>
			<br/>
			<button type="button" class="btn btn-primary" style="border-radius: 10px;" onClick="Create_Receival();"> <span class="glyphicon glyphicon-plus">&nbsp;Add Item</span></button>
				<br/><br/>
				<br/>
			
				<center>
					<button type="submit" id="Create_ID_submit" class="btn btn-success" style="width: 80%; border-radius: 10px;" onClick="/*Create_Receival(Create_Receival_validator());*/">Process Book&nbsp;<span class="glyphicon glyphicon-plus-sign"></span></button>
				</center>
			</div><!-- End of form group  -->
		</form>
	</div>
		
		
	<div id="Edit_Receival" class="blank" style="display: none; overflow-y: scroll; font-size: ; font-weight: ; color: #D95459;">
		<div style="padding: 10px; text-align: center; color: #22A7F0;">
			Edit Receivals
		</div>
		<form id="Edit_Create_ID" data-toggle="validator" role="form" class="">
			<div class="form-group">
				<div class="row col-md-12 custyle">
					<div class="input-group">
										<div class="input-group-addon">
											<span class=""></span> Receival #:
										</div>
										
										<input class="form-control" id="ID_Number_Edit" name="ID_Number_Edit" type="" placeholder="ID number" readonly=""/>
									</div>
					<br/>
					
					
									<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-tags"></span>
										</div>
										<input class="form-control" id="Invoice_Number_Edit" name="Invoice_Number" type="text" placeholder="Invoice number"/>
										
									</div>
									<div class="help-block with-errors"></div>
									<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span> 
										</div>
										<input class="form-control" id="Recdate_Edit" name="Recdate" type="text" placeholder="Received date" autocomplete="off"/>
									</div>	
									<div class="help-block with-errors"></div>
									
					<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span> 
										</div>
										<input class="form-control" id="location_edit" name="location" type="text" placeholder="Location" readonly/>
									</div>	
				</div>
					
				<hr style="height: 1px; width: 100%; background-color: #999999;"/>
					
				<div id="Message1" style="padding: 10px; text-align: center">
				</div>
					
				<div id="fields_Edit">

				</div>
				
				<div id="new_fields_Edit">
				
				</div>
				<br/>
				<button type="button" class="btn btn-primary" style="border-radius: 10px;" onClick="edit_new_add_fields();"> <span class="glyphicon glyphicon-plus">&nbsp;Add Item</span></button>
				
				<br/>
				<br/>
				<center>
					<button type="submit" id="edit" class="btn btn-success" style="width: 80%; border-radius: 10px;" onClick="/*Update_Receival();*/">Update Receival&nbsp;<span class="glyphicon glyphicon-plus-sign"></span></button>
				</center>
			</div><!-- End of form group  -->
		</form>
	</div>
	
	<!--//faq-->
		<!---->

		</div>
	
<!---->
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
              
              
              
                        	
	                                	      
	        
	        
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
   <div class="side-bar right-bar">
                <div class="nicescroll">
                    
            </div>
            <!-- /Right-bar -->

        </div>
               

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
                 "iDisplayLength": 50,
                 "oLanguage": {
                 "sLengthMenu": 'Show <select>'+
                            
                             
                                '<option value="10">10</option>'+
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

    

        <script type="text/javascript">
            $(document).ready(function() {
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
