<?php
require 'db.php';

	$sql ="SELECT * FROM fields ";
	$result = $mysqli->query($sql);
	$dir="";
require_once($dir."classes/Session_Manager.php");

$Session_Manager = new Session_Manager();
	
?>
<!DOCTYPE html>
<html>
    <head>
    	
    	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
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
                    
                    
                    
<script src="css/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
<script src="css/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
                    
                    
                    
                    
                    
</script>
<script src="js/validator.js"></script>

<style type="text/css">
#Create_ID .has-error .control-label,
#Create_ID .has-error .help-block,
#Create_ID .has-error .form-control-feedback {
    color: #f39c12;
}

#Create_ID .has-success .control-label,
#Create_ID .has-success .help-block,
#Create_ID .has-success .form-control-feedback {
    color: #18bc9c;
}
</style>


<script src="js/scripts(Tredlabs).js"></script>
<!---->

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
	
	//Dynamically get all the types -Gavin Palmer || March 2016
	var type_options = "<?php
							//database connection variables
							$db_servername = "localhost";
							$db_username = "root";
							$db_password = "";
							$db_name =  "ssjlinve_inventorysystem";
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
								 +'<div class="col-md-4 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								 +'			<select class="form-control equipment_type" id="field_row_'+inline_item_index+'_Type" name="Type" onChange="get_stock_field(this.value, \'field_row_'+inline_item_index+'\')">'
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
	
	
	
	function Create_Receival(validated)
	{
		//kill function if failure to validate
		if(validated == false)
		{
			return false
		}
		//Variables
		var Invoice_Number = document.getElementById("Invoice_Number").value;
		var Recdate = document.getElementById("Recdate").value;
		var Inline_items = []; //Array to hold the list of inline items that will be purchase -Gavin Palmer || March 2016
		var Inline_items_Sringyfied = ""; //array of objects stringyfied to be passed on to the server  -Gavin Palmer || March 2016
		
		
		//Take all the values of the inline items rows and store the rows individually in objects  -Gavin Palmer || March 2016
		//Firstly find each inline item row by id of the row
		$('div[id^="field_row_"]').each(function()
		{
			//Secnding store the fields of the rows in variables to be added to the object
			var Stock_ID = $("#"+this.id+"_stock").val();
			var Quantity = $("#"+this.id+"_quantity").val();
			
			//Add the value to the object
			var Inline_item = {}; //Empty Inline Item object
			Inline_item["Stock_ID"] = Stock_ID;
			Inline_item["Quantity"] = Quantity;
			
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
					//alert(xhttp.responseText);
					//Options = xhttp.responseText;
					//document.getElementById(inline_item_id).innerHTML = Options;
					document.getElementById("Invoice_Number").value="";
					document.getElementById("Recdate").value="";
					document.getElementById("fields").innerHTML = "";
					document.getElementById("Message").innerHTML = "Receival Created";
					$('#Message').delay(5000).fadeOut(400)
					add_fields();
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
		xhttp.send("Query=Add_Recieval&Invoice_Number="+Invoice_Number+"&Recdate="+Recdate+"&Inline_items="+Inline_items_Sringyfied);
		
		//alert(Inline_items_Sringyfied );
		//alert("End");
	}
	

	/** -Gavin Palmer || March 2016
	*	@Discription:	Remove the receival from the receival listing by id number
	*	
	*	@param (int) id - The id number of the receival
	*
	*	@return (void)
	*/
	function Remove_Receival(id)
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
		xhttp.open("GET", "php/Query_Manager.php?Query=Remove_Receival&id="+id, true);
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
								 +'			<select class="form-control equipment_type" id="field_row_'+inline_item_index+'_Type" name="Type" onChange="get_stock_field(this.value, \'field_row_'+inline_item_index+'\')">'
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
	
	
	/** -Gavin Palmer || March 2016
	*	@Discription:	add new field for every attemp collected for the receival
	*	
	*	@param void
	*
	*	@return void
	*/
	function Edit_add_field(row_num, id, stock_id, stock, qty)
	{
		//alert("Satrt");
		edit_inline_item_index=row_num;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="edit_field_row_"+edit_inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
								 +'<div class="col-md-4 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								 +'			<select class="form-control equipment_type" id="field_row_'+edit_inline_item_index+'_Type" name="Type" onChange="get_stock_field(this.value, \'edit_field_row_'+edit_inline_item_index+'\')">'
								 +'				<option  value="" disabled selected>Type</option>'
								 +'				'+type_options				
								 +'			</select>'
								 +'			<input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_id" name="id" type="hidden" value="'+id+'" placeholder="id"/>'
								 +'		</div>'
								 +'	</div>'
								 +'	<div class="col-md-4 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-shopping-cart"></span>'
								 +'			</div>'
								 +'		<div class="grouped_select required receival_rec_lineitems_stock_id">'
								 +'			<select class="grouped_select required form-control Stocks" name="Stocks" id="edit_field_row_'+edit_inline_item_index+'_stock">'
								 +'					<option value="'+stock_id+'" selected>'+stock+'</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								 +'	<div class="col-md-2 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-scale"></span>'
								 +'			</div>'
								 +'			<input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_quantity" name="Quantity" type="number" value="'+qty+'" placeholder="Quantity"/>'
								 +'		</div>'
								 +'	</div>'
								 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="Remove_Receival_line_item('+row_num+','+id+');"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Remove</span></button>'
								 +'	</div>';
								 +''
			
		document.getElementById("fields_Edit").appendChild(new_line_item);
		//alert("Stop");
	}
	
	
	/** -Gavin Palmer || March 2016
	*	@Discription:	bring up edit receival page
	*	
	*	@param (void)
	*
	*	@return (void)
	*/
	function Show_Edit_Receival(id)
	{
		//alert('Start');
		//Variables
		
		
		//Switch views to show the receival page -Gavin Palmer || March 2016
		switch_page(2);
		
		//Get and display basic receival information -Gavin Palmer || March 2016
		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					//alert(xhttp.responseText);
					var receival_object = JSON.parse(xhttp.responseText);

					document.getElementById('ID_Number_Edit').value = id;
					document.getElementById('Invoice_Number_Edit').value = receival_object.Invoice_Number;
					document.getElementById('Recdate_Edit').value = receival_object.Recdate;
				}
				else
				{
					alert("An error occured while trying to get the data you requested: "+xhttp.responseText);
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Basic_Receival_info&id="+id, true);
		xhttp.send();
		
		//Get and display basic receival information -Gavin Palmer || March 2016
		var xhttp_line_items = new XMLHttpRequest();
		
		xhttp_line_items.onreadystatechange = function()
		{
			if(xhttp_line_items.readyState == 4)
			{
				if(xhttp_line_items.status == 200)
				{
					//alert(xhttp_line_items.responseText);
					document.getElementById('fields_Edit').innerHTML = ""; //Clear the section of the page before writing to it
					var line_item_objects = JSON.parse(xhttp_line_items.responseText);
					
					for (a = 0; a < line_item_objects.length; a++)
					{
						Edit_add_field(a, line_item_objects[a].id, line_item_objects[a].stock_id, line_item_objects[a].name, line_item_objects[a].qty); 
						//alert(line_item_objects[a].name);
					}
					
					//document.getElementById('Invoice_Number_Edit').value = receival_object.Invoice_Number;
					//document.getElementById('Recdate_Edit').value = line_item_objects;
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
	
	
	function edit_new_add_fields()
	{
		//alert("Satrt");
		edit_new_inline_item_index=edit_new_inline_item_index+1;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="edit_new_field_row_"+edit_new_inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
								 +'<div class="col-md-4 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								 +'			<select class="form-control equipment_type" id="edit_new_field_row_'+edit_new_inline_item_index+'_Type" name="Type" onChange="get_stock_field(this.value, \'edit_new_field_row_'+edit_new_inline_item_index+'\')">'
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
								 +'			<select class="grouped_select required form-control Stocks" name="Stocks" id="edit_new_field_row_'+edit_new_inline_item_index+'_stock">'
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
								 +'			<input class="form-control" id="edit_new_field_row_'+edit_new_inline_item_index+'_quantity" name="Quantity" type="number" placeholder="Quantity"/>'
								 +'		</div>'
								 +'	</div>'
								 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Remove</span></button>'
								 +'	</div>';
								 +''
			
		document.getElementById("new_fields_Edit").appendChild(new_line_item);
		//alert("Stop");
	}
	
	

	function Remove_Receival_line_item(row, id)
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
	
	
	/** -Gavin Palmer || March 2016
	*	@Discription:	Collect and send of sets of information required to update the receival information
	*	
	*	@param (void)
	*
	*	@return (void)
	*/
	function Update_Receival(validated)
	{
		//kill function if failure to validate
		if(validated == false)
		{
			return false
		}
		//alert("Start - Update_Receival()");
		//Variables
		var ID = document.getElementById("ID_Number_Edit").value;
		var Invoice_Number = document.getElementById("Invoice_Number_Edit").value;
		var Recdate = document.getElementById("Recdate_Edit").value;
		var Inline_items = []; //Array to hold the list of inline items that will be purchase -Gavin Palmer || March 2016
		var Inline_items_Sringyfied = ""; //array of objects stringyfied to be passed on to the server  -Gavin Palmer || March 2016
		var new_Inline_items = []; //Array to hold the list of newly added inline items that will be purchase -Gavin Palmer || March 2016
		var new_Inline_items_Sringyfied = ""; //array of of newly added inline items  objects stringyfied to be passed on to the server  -Gavin Palmer || March 2016
		
		//Take all the values of the inline items rows and store the rows individually in objects  -Gavin Palmer || March 2016
		//Firstly find each inline item row by id of the row
		$('div[id^="edit_field_row_"]').each(function()
		{
			//Secnding store the fields of the rows in variables to be added to the object
			var Item_ID = $("#"+this.id+"_id").val();
			var Stock_ID = $("#"+this.id+"_stock").val();
			var Quantity = $("#"+this.id+"_quantity").val();
			
			//Add the value to the object
			var Inline_item = {}; //Empty Inline Item object
			Inline_item["Item_ID"] = Item_ID;
			Inline_item["Stock_ID"] = Stock_ID;
			Inline_item["Quantity"] = Quantity;
			
			//Thirdly, add the object to the already existing array of objects
			Inline_items.push(Inline_item);
		});
		
		//Stringyfy array of inline items to be passed to the servers as one variable
		var Inline_items_Sringyfied = JSON.stringify(Inline_items);
		
		
		$('div[id^="edit_new_field_row_"]').each(function()
		{
			//Secnding store the fields of the rows in variables to be added to the object
			var Stock_ID = $("#"+this.id+"_stock").val();
			var Quantity = $("#"+this.id+"_quantity").val();
			
			//Add the value to the object
			var Inline_item = {}; //Empty Inline Item object
			Inline_item["Stock_ID"] = Stock_ID;
			Inline_item["Quantity"] = Quantity;
			
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
					//alert(xhttp.responseText);
					
					document.getElementById("Invoice_Number_Edit").value="";
					document.getElementById("ID_Number_Edit").value="";
					document.getElementById("Recdate_Edit").value="";
					document.getElementById("fields_Edit").innerHTML = "";
					document.getElementById("new_fields_Edit").innerHTML = "";
					alert("Successfuly updated");
					switch_page(0);
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
		xhttp.send("Query=Update_Recieval&ID="+ID+"&Invoice_Number="+Invoice_Number+"&Recdate="+Recdate+"&Inline_items="+Inline_items_Sringyfied+"&new_Inline_items="+new_Inline_items_Sringyfied);
		
		//alert("Stop");
	}
	
	
	/** -Gavin Palmer || March 2016
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
		//Load default reveival listing table
		Load_Default_Receival_table();
		
		$('#search_field').keyup(function()
		{
			Search_Receival_table();
		});
		
		
		//Add validator to form -Gavin Palmer || March 2016
		$('#Create_ID').validator();
		$('#Edit_Create_ID').validator();
		
		//Prevent submition of form and check if the required fields are filled in-Gavin Palmer || March 2016
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
<style type="text/css">
<!--
/*@import url('http://getbootstrap.com/dist/css/bootstrap.css');*/
-->
</style>
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
         	<div class="receivaldata">
               <h3 align="right"></h3>
                        	
                        			
              
                  <div class="" style="overflow-y: auto">
 
 	<!--banner-->	
		     <div class="banner">
		    	<h4>
				<a href="#" onClick="switch_page(0);" style="color: #22A7F0;">Receival listing</a>
			
				<!--span>Receival listing</span-->
			<a href="#" onClick="switch_page(1);" style="color: #22A7F0;">Create Receival</a>
				</h4>
		    </div>

 	<div id="Receival_listing" class="blank" style="overflow-y: auto;">
		
		<div class="row col-md-12 custyle">
			<form id="Main_Search" role="form" class="">
				<div class="form-group">
					<!--label for="inputdefault">Default input</label-->
					<input class="form-control" id="search_field" type="text" placeholder="Search by Invoice number" style="display: inline; width: 50%;">
					<!--br/-->
					<!--label for="search_start_date">Default input</label-->
					<input type="text" id="search_start_date" name="search_start_date" class="form-control" placeholder="Start date" style="display: inline; width: 15%; height: 34px;">
					<!--label for="search_end_date">Default input</label-->
					<input type="text" id="search_end_date" name="search_end_date" class="form-control" placeholder="End date" style="display: inline; width: 15%;">
					<button type="button" onClick="Search_Receival_table();" class="btn btn-info" style="display: inline; width: 15%;">
      					<span class="glyphicon glyphicon-search"></span> Search
    				</button>
				</div>
			</form>
		</div>
		
		<!--Adding in page info-->
		<div class="row col-md-12 custyle">
			<div id="Receival_listing_Message" style="padding: 10px; text-align: center">
			</div>
			<table id="Receival_table" class="table table-striped custab">
				<thead>
					<tr>
						<!--th>ID</th-->
						<th>Invoice number</th>
						<th>Recdate</th>
						<!--th>Type</th-->
						<th>Created at</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody id="Receival_table_body" style="">
					
								
				</tbody>
			</table>
			
		</div>
		<!-- -->
	        	
	</div>
	
	<div id="Enter_Receival" class="blank" style="display: none; overflow-y: auto;">
		<form id="Create_ID" data-toggle="validator" role="form" class="">
			<div class="form-group">
				<div class="row col-md-12 custyle">
									<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-tags"></span> 
										</div>
										<input class="form-control" id="Invoice_Number" name="Invoice_Number" type="number" placeholder="Invoice number" required/>
									</div>
									<div class="help-block with-errors"></div>
									<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span> 
										</div>
										<input class="form-control" id="Recdate" name="Recdate" type="text" placeholder="Received date" required/>
									</div>	
									<div class="help-block with-errors"></div>
				</div>
					
				<hr style="height: 1px; width: 100%; background-color: #999999;"/>
					
				<div id="Message" style="padding: 10px; text-align: center">
				</div>
					
				<div id="fields">
					<div class="row" id="field_row_0">
							<div class="col-md-4 custyle">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-link"></span> 
									</div>
									<select class="form-control equipment_type" id="field_row_0_Type" name="Type" onChange="get_stock_field(this.value, 'field_row_0');">
										<option  value="" disabled selected>Type</option>
											<?php
												//database connection variables
												$db_servername = "localhost";
												$db_username = "root";
												$db_password = "";
												$db_name = "ssjlinve_inventorysystem";
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
											?>
									</select>
								</div>
							</div>
							<div class="col-md-4 custyle">
								<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-shopping-cart"></span> 
								</div>
								<div class="grouped_select required receival_rec_lineitems_stock_id">
										<select class="grouped_select required form-control Stocks" name="Stocks" id="field_row_0_stock">
											<option value="" disabled selected>Stock</option>
										</select>
								</div>
								</div>
							</div>
							<div class="col-md-2 custyle">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-scale"></span> 
									</div>
									<input class="form-control" id="field_row_0_quantity" name="Quantity" type="number" placeholder="Quantity"/>
								</div>
							</div>
							<div class="col-md-2 custyle">
								<button type="button" class="btn btn-danger  Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Remove</span></button>
							</div>	
						</div>
				</div>
				
				<button type="button" class="btn btn-primary" style="border-radius: 10px;" onClick="add_fields();"> <span class="glyphicon glyphicon-plus">&nbsp;Add field</span></button>
				<br/>
				<br/>
				<center>
					<button type="submit" id="Create_ID_submit" class="btn btn-success" style="width: 80%; border-radius: 10px;" onClick="/*Create_Receival(Create_Receival_validator());*/">Create Receival&nbsp;<span class="glyphicon glyphicon-plus-sign"></span></button>
				</center>
			</div><!-- End of form group  -->
		</form>
	</div>
		
		
	<div id="Edit_Receival" class="blank" style="display: none; overflow-y: scroll; font-size: ; font-weight: ; color: #D95459;">
		<div style="padding: 10px; text-align: center; color: #22A7F0;">
			Edit Receival
		</div>
		<form id="Edit_Create_ID" data-toggle="validator" role="form" class="">
			<div class="form-group">
				<div class="row col-md-12 custyle">
									<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-tags"></span> 
										</div>
										<input class="form-control" id="Invoice_Number_Edit" name="Invoice_Number" type="number" placeholder="Invoice number" required/>
										<input class="form-control" id="ID_Number_Edit" name="ID_Number_Edit" type="hidden" placeholder="ID number"/>
									</div>
									<div class="help-block with-errors"></div>
									<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span> 
										</div>
										<input class="form-control" id="Recdate_Edit" name="Recdate" type="text" placeholder="Received date" required/>
									</div>	
									<div class="help-block with-errors"></div>
				</div>
					
				<hr style="height: 1px; width: 100%; background-color: #999999;"/>
					
				<div id="Message" style="padding: 10px; text-align: center">
				</div>
					
				<div id="fields_Edit">

				</div>
				
				<div id="new_fields_Edit">
				
				</div>
				
				<button type="button" class="btn btn-primary" style="border-radius: 10px;" onClick="edit_new_add_fields();"> <span class="glyphicon glyphicon-plus">&nbsp;Add field</span></button>
				<br/>
				<br/>
				<center>
					<button type="submit" class="btn btn-success" style="width: 80%; border-radius: 10px;" onClick="/*Update_Receival();*/">Update Receival&nbsp;<span class="glyphicon glyphicon-plus-sign"></span></button>
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
