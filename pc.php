<?php
include 'reorder.php';
include('page.php');
session_start();

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
                    <link rel="shortcut icon" href="assets/images/ssl.ico">
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
	
	//Dynamically get all the types -Gavin Palmer || March 2016
	var type_options = "<?php
							//database connection variables
							$db_servername = "localhost";
                             $db_username = "dert1_stream";
                            $db_password = "streamline";
                            $db_name =  "dert1_ssjlinve_inventorysystem";
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
		                   	  
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								
								 +'	<select class="form-control equipment_type" id="field_row_'+inline_item_index+'_Type" name="Type" onChange="get_stock_field(this.value, \'field_row_'+inline_item_index+'\'); showqty(this.value, \'field_row_'+inline_item_index+'\');showqty1(this.value, \'field_row_'+inline_item_index+'\'); showqty2(this.value, \'field_row_'+inline_item_index+'\'); showqty3(this.value, \'field_row_'+inline_item_index+'\'); showqty4(this.value, \'field_row_'+inline_item_index+'\');showqty5(this.value, \'field_row_'+inline_item_index+'\');">'
								
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
								 +'			<select class="grouped_select required form-control Stocks" name="Stocks" id="field_row_'+inline_item_index+'_stock">'
								 +'					<option value="" disabled selected>Stock</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								 
								 
								 //This is the input for printedform usageage sheet amount
								 			  +' <div class="col-md-2 custyle">'
								 +'		<div class="input-group" id="sheet1_input_field_row_'+inline_item_index+'" style="visibility: hidden">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-scale"></span>'
								 +'			</div>'
								 +'			<input class="form-control" id="field_row_'+inline_item_index+'_sheet1" name="Sheet1" type="number" placeholder="Sheet1"/>'
								  +'			<input class="form-control" id="field_row_'+inline_item_index+'_sheet2" name="Sheet2" type="number" placeholder="Sheet2"/>'
								  +'		</div>'
									 //This is the input for printedform usageage sheet amount
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
							//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	
								 		 +'<div class="col-md-2 custyle">'
								 +'		<div class="input-group" id="qtysheet1_input_field_row_'+inline_item_index+'" style="visibility: hidden">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-scale"></span>'
								 +'			</div>'
								 +'			<input class="form-control" id="field_row_'+inline_item_index+'_qtysheet1" name="qtysheet1" type="number" placeholder="Qty Sheet1"/>'
								  +'			<input class="form-control" id="field_row_'+inline_item_index+'_qtysheet2" name="qtysheet2" type="number" placeholder="Qty Sheet2"/>'
								  +'		</div>'
								
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
								
								//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	 
								
								  
						
							 						//This is the input for Envelope usageage spoilage amount this has 2 input	
						
								
 		 			
								//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	
								 		 +'<div class="col-md-2 custyle">'
								 +'		<div class="input-group" id="qtysheet2_input_field_row_'+inline_item_index+'" style="visibility: hidden">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-scale"></span>'
								 +'			</div>'
								 +'			<input class="form-control" id="field_row_'+inline_item_index+'_paperqty" name="qty" type="number" placeholder="Box"/>'
								  +'			<input class="form-control" id="field_row_'+inline_item_index+'_paperslp" name="spl" type="number" placeholder="Reams"/>'
								   +'			<input class="form-control" id="field_row_'+inline_item_index+'_papersheet" name="papersheet" type="number" placeholder="Sheets"/>'
								  +'		</div>'
								
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
								 
								 //This is the input for Envelope usageage spoilage amount this has 2 input	 
								 
								   +' <div class="col-md-2 custyle">'
								 +'		<div class="input-group" id="env_input_field_row_'+inline_item_index+'" style="visibility: hidden">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-scale"></span>'
								 +'			</div>'
								 +'			<input class="form-control" id="field_row_'+inline_item_index+'_small" name="small" type="number" placeholder="Spoilage Sm"/>'
								  +'			<input class="form-control" id="field_row_'+inline_item_index+'_large" name="large" type="number" placeholder="Spoilage Lg"/>'
								  +'		</div>'
								
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
								 
				
					
						
								 	//This is the input for Envelope usageage quantity amount this has 2 input	 	
						
						  +' <div class="col-md-2 custyle">'
								 +'		<div class="input-group" id="envqty_input_field_row_'+inline_item_index+'" style="visibility: hidden">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-scale"></span>'
								 +'			</div>'
								 +'			<input class="form-control" id="field_row_'+inline_item_index+'_qtysmall" name="qtysmall" type="number" placeholder="Qty small"/>'
								 +'			<input class="form-control" id="field_row_'+inline_item_index+'_qtylarge" name="qtylarge" type="number" placeholder="Qty large"/>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								 +'	</div>'
						      
						        //This is the input for Envelope usageage amount this has 2 input
						
			
												
								
					
								//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	
								 		 +'<div class="col-md-2 custyle">'
								 +'		<div class="input-group" id="qtysheet3_input_field_row_'+inline_item_index+'" style="visibility: hidden">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-scale"></span>'
								 +'			</div>'
								 +'			<input class="form-control" id="field_row_'+inline_item_index+'_inserterqty" name="qtyin" type="number" placeholder="Quantity"/>'
								//  +'			<input class="form-control" id="field_row_'+inline_item_index+'_inserterspoilage" name="splin" type="number" placeholder="Spoilage"/>'
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
		alert(stock_type);
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
					alert(xhttp.responseText);
					//Options = xhttp.responseText;
					//document.getElementById(inline_item_id).innerHTML = Options;
				}
				else
				{
					alert("An error occured while trying to get the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Stock_in_Types&Type="+stock_type, true);
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
		
		var id="field_row_'+inline_item_index+'_stock";
	
    //    var size = document.getElementById(id).value;

		var Inline_items = []; //Array to hold the list of inline items that will be purchase -Gavin Palmer || March 2016
		var Inline_items_Sringyfied = ""; //array of objects stringyfied to be passed on to the server  -Gavin Palmer || March 2016

		
		//Take all the values of the inline items rows and store the rows individually in objects  -Gavin Palmer || March 2016
		//Firstly find each inline item row by id of the row
		$('div[id^="field_row_"]').each(function()
		{
			
		var Type = $("#"+this.id+"_Type").val();
		
			
			//Secnding store the fields of the rows in variables to be added to the object
			var Stock_ID = $("#"+this.id+"_stock").val();
            var inserter = $("#"+this.id+"_inserterqty").val();			//this is for paper
			var Box = $("#"+this.id+"_paperqty").val();
			var Sheet = $("#"+this.id+"_papersheet").val();
			var TotalBox=Box*5000; //This is for a box
			var Packs = $("#"+this.id+"_paperslp").val();
			var TotalPacks=Packs*500 //this is for packs
					//this is for envelope quantity
			var envQuantity1 = $("#"+this.id+"_qtysmall").val();//tHIS IS SMALL ENVELOPE 
			var envQuantity2 = $("#"+this.id+"_qtylarge").val(); //tHIS IS SMALL ENVELOPE 
			
			
			//this is for envelope Spoliage current task
			
			var envspoilage1 = $("#"+this.id+"_small").val();//tHIS IS SMALL ENVELOPE 
			var envspoilage2 = $("#"+this.id+"_large").val(); //tHIS IS SMALL ENVELOPE 
			
			
			//this is for the printed form
			var sheet1 = $("#"+this.id+"_sheet1").val();//tHIS IS for the printed form sheet from input
			var sheet2 = $("#"+this.id+"_sheet2").val();//tHIS IS for the printed form sheet from input
			
			var qtysheet1 = $("#"+this.id+"_qtysheet1").val();//tHIS IS for the printed form spoilage sheet1
			var qtysheet2 = $("#"+this.id+"_qtysheet2").val();//tHIS IS for the printed form spoilage sheet2
			
			
			//this is for the printed form
			
			
		
			
			//Add the value to the object
			var Inline_item = {}; //Empty Inline Item object
			//var Inline_item = {}; 
			Inline_item["Stock_ID"] = Stock_ID;
			Inline_item["totalbox"] = TotalBox;
			Inline_item["totalpacks"] = TotalPacks;
			Inline_item["sheet"] = Sheet;
			Inline_item["Type"] = Type;
			Inline_item["envQuantity1"] = envQuantity1;
			Inline_item["envQuantity2"] = envQuantity2;
			
			// this add envelope spoilage  
			Inline_item["envspoilage1"] = envspoilage1;
			Inline_item["envspoilage2"] = envspoilage2;
		
			//this is for the printed form
			Inline_item["qtysheet1"] = qtysheet1;
			Inline_item["qtysheet2"] = qtysheet2;
			
			Inline_item["sheet1"] = sheet1;
			Inline_item["sheet2"] = sheet2;
			
			
					Inline_item["inserter"] = inserter;
			
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
					//Options = xhttp.responseText;
					//document.getElementById(inline_item_id).innerHTML = Options;
					document.getElementById("Invoice_Number").value="";
					document.getElementById("Recdate").value="";
		
					document.getElementById("fields").innerHTML = "";
					document.getElementById("Message").innerHTML = xhttp.responseText;
					$('#Message').delay(5000).fadeOut(400)
					reload();
					//alert('finish');
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
		//xhttp.send("Query=Add_Usage&Invoice_Number="+Invoice_Number+"&Usagedate="+Usagedate+"&Inline_items="+Inline_items_Sringyfied);
		xhttp.send("Query=Add_Recieval&Invoice_Number="+Invoice_Number+"&Recdate="+Recdate+"&Inline_items="+Inline_items_Sringyfied);
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
	function Remove_Receival(row,id,sid,rid) //This is the function to remove the receivals for the Receival Tabel
	{
		//alert("start");
		var xhttp = new XMLHttpRequest();
		
		//Confirm before action is taken
		var action = confirm("Are you sure?"+rid);
		
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
					document.getElementById("Receival_listing_Message").innerHTML =xhttp.responseText;
					$('#Receival_listing_Message').delay(5000).fadeOut(400);
					$('#Listing_row_'+row).delay(1000).fadeOut(400);
					

					Rtest(sid);
					
					
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Remove_Receival&id="+id+"&rid="+rid, true);
		xhttp.send();
		//alert("stop");
		
	}
		function Rtest(sid) //This is the function to remove the receivals for the Receival Tabel
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
		xhttp1.send("&sid="+sid);
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
								 +'			<select class="form-control equipment_type" id="field_row_'+inline_item_index+'_Type" name="Type" onChange="get_stock_field(this.value, \'field_row_'+inline_item_index+'\');">'
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

	
	/** -Gavin Palmer || March 2016
	*	@Discription:	bring up edit receival page
	*	
	*	@param (void)
	*
	*	@return (void)
	*/
	function Show_Edit_Receival(id,sid,rid)
	{
		//alert(id);
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
					//alert('Start');
					//alert(id);
				   // alert(xhttp.responseText);
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
				{ //alert('herer')
					//alert(xhttp_line_items.responseText);
					document.getElementById('fields_Edit').innerHTML = ""; //Clear the section of the page before writing to it
					var line_item_objects = JSON.parse(xhttp_line_items.responseText);
					
					for (a = 0; a < line_item_objects.length; a++)
					{
						Edit_add_field(a, line_item_objects[a].id,line_item_objects[a].rid,line_item_objects[a].ptype, line_item_objects[a].stock_id, line_item_objects[a].sheet, line_item_objects[a].name, line_item_objects[a].equip, line_item_objects[a].boxs,line_item_objects[a].packs, line_item_objects[a].envsmall, line_item_objects[a].envlarge, line_item_objects[a].printedform1, line_item_objects[a].printedform2); 
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
	
		function Edit_add_field(row_num, id,rid,ptype, stock_id,sheet, stock, equip, boxs,packs,envsmall,envlarge,printedform1,printedform2)
	{
			if(equip=="PAPER")
		{

		
	 //  alert("start");
		edit_inline_item_index=row_num;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="edit_field_row_"+edit_inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
		                      
		                       
		                          
		                   // this is the 1st option select
		                   	  
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								
								 +'	<select class="form-control equipment_type" id="edit_field_row_'+edit_inline_item_index+'_Type" name="Type">'
								
								 +'				<option value="'+equip+'" selected>'+equip+'</option>'
											
								 +'			</select>'  
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_usageid" name="id" type="visible" value="'+rid+'" placeholder="id"/>'
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
									 +'					<option value="'+stock_id+'" selected>'+stock+' '+ptype+'</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								 
							
								
								//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	 
								
								  
						
							 						//This is the input for Envelope usageage spoilage amount this has 2 input	
						
								
 		 			
								//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	
								 		 +'<div class="col-md-2 custyle">'
								 +'		<div class="input-group" id="qtysheet2_input_field_row_'+edit_inline_item_index+'" style="visibility: visible">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-scale"></span>'
								 +'			</div>'
								 +'			<input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_paperbox" name="qty" type="number" value="'+boxs+'"placeholder="Boxes"/>'
								 +'			<input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_paperpack" name="qty" type="number" value="'+packs+'"placeholder="Packs"/>'
 +'			<input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_papersheet" name="sheet" type="number" value="'+sheet+'"placeholder="Sheets"/>'
								  +'		</div>'
								
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
								 
								 //This is the input for Envelope usageage spoilage amount this has 2 input	 
				
				
					
						
						 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Remove</span></button>'
								 +'	</div>';
								 
								  +'	</br>';
								   +'	</br>';
								   
								  
							
								 +''
			
		document.getElementById("fields_Edit").appendChild(new_line_item);
		
		}
		
		
			if(equip=="Envelope")
		{
			   

			
		
	 //  alert("start");
		edit_inline_item_index=row_num;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="edit_field_row_"+edit_inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
		                      
		                       
		                          
		                   // this is the 1st option select
		                   	  
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								
								 +'	<select class="form-control equipment_type" id="edit_field_row_'+edit_inline_item_index+'_Type" name="Type">'
								
								 +'				<option value="'+equip+'" selected>'+equip+'</option>'
											
								 +'			</select>'  
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_usageid" name="id" type="visible" value="'+rid+'" placeholder="id"/>'
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
									 +'					<option value="'+stock_id+'" selected>'+stock+' '+ptype+'</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								 
							
								
								//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	 
								
								  
						
							 						//This is the input for Envelope usageage spoilage amount this has 2 input	
						
								
 		 			
								//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	
								 		 +'<div class="col-md-2 custyle">'
								 +'		<div class="input-group" id="qtysheet2_input_field_row_'+edit_inline_item_index+'" style="visibility: visible">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-scale"></span>'
								 +'			</div>'
								 +'			<input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_qtysmall" name="qty" type="number" value="'+envsmall+'"placeholder="Env Small"/>'
								  +'			<input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_qtylarge" name="qty" type="number" value="'+envlarge+'"placeholder="Env Large"/>'
						
								  +'		</div>'
								
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
								 
								 //This is the input for Envelope usageage spoilage amount this has 2 input	 
				
				
					
						
						 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Remove</span></button>'
								 +'	</div>';
								 
								  +'	</br>';
								   +'	</br>';
								   
								  
							
								 +''
			
		document.getElementById("fields_Edit").appendChild(new_line_item);
		
		}
		
	
			if(equip=="PrintedForm")
		{
			   

			
		
	 //  alert("start");
		edit_inline_item_index=row_num;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="edit_field_row_"+edit_inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
		                      
		                       
		                          
		                   // this is the 1st option select
		                   	  
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								
								 +'	<select class="form-control equipment_type" id="edit_field_row_'+edit_inline_item_index+'_Type" name="Type">'
								
								 +'				<option value="'+equip+'" selected>'+equip+'</option>'
											
								 +'			</select>'  
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_usageid" name="id" type="visible" value="'+rid+'" placeholder="id"/>'
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
									 +'					<option value="'+stock_id+'" selected>'+stock+' '+ptype+'</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								 
							
								
								//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	 
								
								  
						
							 						//This is the input for Envelope usageage spoilage amount this has 2 input	
						
								
 		 			
								//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	
								 		 +'<div class="col-md-2 custyle">'
								 +'		<div class="input-group" id="qtysheet2_input_field_row_'+edit_inline_item_index+'" style="visibility: visible">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-scale"></span>'
								 +'			</div>'
								 +'			<input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_qtysheet1" name="qty" type="number" value="'+printedform1+'"placeholder="Sheet1"/>'
								  +'			<input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_qtysheet2" name="qty" type="number" value="'+printedform2+'"placeholder="Sheet2"/>'
						
								  +'		</div>'
								
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
								 
								 //This is the input for Envelope usageage spoilage amount this has 2 input	 
				
				
					
						
						 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Remove</span></button>'
								 +'	</div>';
								 
								  +'	</br>';
								   +'	</br>';
								   
								  
							
								 +''
			
		document.getElementById("fields_Edit").appendChild(new_line_item);
		
		}
		

		
		
		//alert("Stop");
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
	
	
	/** -Gavin Palmer || March 2016
	*	@Discription:	Collect and send of sets of information required to update the receival information
	*	
	*	@param (void)
	*
	*	@return (void)
	*/
	function Update_Receival()
	{
		//kill function if failure to validate
		
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
			var Item_ID = $("#"+this.id+"_usageid").val();
			var Stock_ID = $("#"+this.id+"_stock").val();
			var Type = $("#"+this.id+"_Type").val();
			
			//this is for the paper
			var Quantitypack = $("#"+this.id+"_paperpack").val();
			var Quantitybox = $("#"+this.id+"_paperbox").val();
			var Quantitysheet = $("#"+this.id+"_papersheet").val();
	
			//this is for the envelope
			var qtysmall = $("#"+this.id+"_qtysmall").val();
			var qtylarge = $("#"+this.id+"_qtylarge").val();
		
			//this is for the printed form
			var qtysheet1 = $("#"+this.id+"_qtysheet1").val();
			var qtysheet2 = $("#"+this.id+"_qtysheet2").val();
	
			//Add the value to the object
			var Inline_item = {}; //Empty Inline Item object
			Inline_item["Item_ID"] = Item_ID;
			Inline_item["Stock_ID"] = Stock_ID;
			
			Inline_item["Quantitypack"] = Quantitypack;
			Inline_item["Quantitybox"] = Quantitybox;
			Inline_item["Quantitysheet"] = Quantitysheet;
	
			Inline_item["qtysmall"] = qtysmall;
			Inline_item["qtylarge"] = qtylarge;
			Inline_item["Type"] = Type;
			
			
		
			Inline_item["qtysheet1"] = qtysheet1;
			Inline_item["qtysheet2"] = qtysheet2;
			
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
					
					document.getElementById("Invoice_Number_Edit").value="";
					document.getElementById("ID_Number_Edit").value="";
					document.getElementById("Recdate_Edit").value="";
					document.getElementById("fields_Edit").innerHTML = "";
					document.getElementById("new_fields_Edit").innerHTML = "";
					document.getElementById("Receival_listing_Message").innerHTML =xhttp.responseText;
					$('#Message').delay(5000).fadeOut(400)
					//alert(Type);
					var sid=localStorage.getItem('sid');
				   //alert(sid);
				   Rtest(sid);
					//
					switch_page(0);
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
 

<script>

function check(){  //this function load content to a div
$('#live_data').load('purchaseorder.html');
}

	//this function loads the input 
	function showqty(stock_id, inline_item_id)
	{
	  
	
  
		if(stock_id == "Envelope")
		{
		 
		var cl2=inline_item_id;
		var cl3=inline_item_id;
		var cl4=inline_item_id;
		var cl5=inline_item_id;

	     
		cl2="sheet1_input_"+cl2;
		cl3="qtysheet1_input_"+cl3;
		cl4="qtysheet2_input_"+cl4;
		cl5="qtysheet3_input_"+cl5;
		
			   document.getElementById(cl2).style.visibility="hidden";
				document.getElementById(cl3).style.visibility="hidden";
					document.getElementById(cl4).style.visibility="hidden";
					document.getElementById(cl5).style.visibility="hidden";
			
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

	function showqty2(stock_id, inline_item_id)
	{
	  
	
     
		if(stock_id == "Envelope")
		{
	//alert(stock_id);

		
	
		}
		
		
		
				if(stock_id == "PrintedForm")
		{
			
				//alert(stock_id);
				inline_item_id="qtysheet1_input_"+inline_item_id; 
			 
	
			document.getElementById(inline_item_id).style.visibility="visible";
			
			
			
		}
		
					if(stock_id == "Inserter")
		{
				//alert(stock_id);
		
		}
		else
		{

		}
		
		
	}
	
	function showqty3(stock_id, inline_item_id)
	{
	  
	
    if(stock_id == "PAPER")
		{
	
		//alert(stock_id);
	//	inline_item_id="qtyfield_row_"+inline_item_id; 
			//alert(inline_item_id);
			//document.getElementById(inline_item_id).style.visibility="visible";
	 var cl=inline_item_id;
		var cl1=inline_item_id;
		var cl2=inline_item_id;
		var cl3=inline_item_id;
		var cl4=inline_item_id;
		var cl5=inline_item_id;

	     cl="env_input_"+cl;
		cl1="envqty_input_"+cl1;
		cl2="sheet1_input_"+cl2;
		cl3="qtysheet1_input_"+cl3;
		cl4="qtysheet2_input_"+cl4;
				cl5="qtysheet3_input_"+cl5;
		document.getElementById(cl).style.visibility="hidden";
				document.getElementById(cl1).style.visibility="hidden";
				document.getElementById(cl2).style.visibility="hidden";
				document.getElementById(cl3).style.visibility="hidden";
					document.getElementById(cl4).style.visibility="hidden";
					document.getElementById(cl5).style.visibility="hidden";
				
		}
if(stock_id == "PrintedForm")
		{
        var cl=inline_item_id;
	    var cl1=inline_item_id;
	
		
		var cl4=inline_item_id;
		var cl5=inline_item_id;

	     cl="env_input_"+cl;
		cl1="envqty_input_"+cl1;
		
		cl4="qtysheet2_input_"+cl4;
		cl5="qtysheet3_input_"+cl5;
		document.getElementById(cl).style.visibility="hidden";
		document.getElementById(cl1).style.visibility="hidden";
		
					document.getElementById(cl4).style.visibility="hidden";
					document.getElementById(cl5).style.visibility="hidden";

	    
		}
	
		else
		{
			
				
		}
		
		//alert("stop");
	}

	function showqty1(stock_id, inline_item_id)
	{
	  
	
     if(stock_id == "PAPER")
		{
	

		}
		if(stock_id == "Envelope")
		{

	
	inline_item_id="env_input_"+inline_item_id; 
		
			//document.getElementById(inline_item_id).style.visibility="visible";
		}
		
		
				if(stock_id == "PrintedForm")
		{
			
			
				inline_item_id="qtysheet1_input_"+inline_item_id; 
			 
	
			document.getElementById(inline_item_id).style.visibility="visible";
			
			
			
		}
		
					
		else
		{

		}
		
		
	}
function showqty4(stock_id, inline_item_id)
	{
	  
	
    if(stock_id == "PAPER")
		{
	

			inline_item_id="qtysheet2_input_"+inline_item_id; 
	   	document.getElementById(inline_item_id).style.visibility="visible";
	
		}

		
	
		else
		{
			
			
		}
		
		//alert("stop");
	}
	function showqty5(stock_id, inline_item_id)
	{
	  
	
    if(stock_id == "INSERTER")
		{
				//alert(stock_id);
		var cl=inline_item_id;
		var cl1=inline_item_id;
		var cl2=inline_item_id;
		var cl3=inline_item_id;
		var cl4=inline_item_id;
	

	     cl="env_input_"+cl;
		cl1="envqty_input_"+cl1;
		cl2="sheet1_input_"+cl2;
		cl3="qtysheet1_input_"+cl3;
		cl4="qtysheet2_input_"+cl4;
		inline_item_id="qtysheet3_input_"+inline_item_id; 		
		document.getElementById(cl).style.visibility="hidden";
		document.getElementById(cl1).style.visibility="hidden";
		document.getElementById(cl2).style.visibility="hidden";
		document.getElementById(cl3).style.visibility="hidden";
	    document.getElementById(cl4).style.visibility="hidden";
			document.getElementById(inline_item_id).style.visibility="visible";
			
		}
		
	
		else
		{
			
		}
		
		//alert("stop");
	}

function reload(){
    setTimeout(function(){location.reload()}, 3000);
    var timer = null;
  }

function stock(sid){
	var sid=sid;
	alert(sid);
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

  <script>
var role=<?php echo $role;?>

function myFunction(){
	if(role==1||role==2){
	
document.getElementById('pur').style.display="block";
document.getElementById('cur').style.display="block";



	

//alert(role);
}
else{

	document.getElementById('usg1').style.display="none";
}
}

 
 
 
 
 </script>      
    </head>


    <body onload="myFunction();" class="fixed-left">
        
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

                                 <!--   <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light"

                                       data-toggle="dropdown" aria-expanded="true">

                                        <i class="md md-notifications"></i> <span

                                            class="badge badge-xs badge-pink">3</span>

                                 </a>-->

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                   <!-- <ul class="dropdown-menu dropdown-menu-lg">

                                        <li class="text-center notifi-title">Notification</li>

                                        <li class="list-group nicescroll notification-list">

                                           

                                           

                                           

                                           

                                           

                                           

                                           

                                           

                                           

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

                                            

                                            

                                            

                                            

                                            

                                            

                                            

                                            

                                            



                                            

                                        </li>



                                        <li>

                                            <a href="javascript:void(0);" class=" text-right">

                                                <small><b>See all notifications</b></small>

                                            </a>

                                        </li>



                                    </ul>-->

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                    

                                </li>
                                <li class="hidden-xs">
                                  <!--  <a href="#" class="right-bar-toggle waves-effect waves-light"><i
                                            class="md md-settings"></i></a>-->
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

                                   <!-- <li><a href="javascript:void(0);">Purchase Reports</a></li>-->

                                    <li><a href="spoilreport.php">Spoilage Reports</a></li>

                     

                                </ul>

                            </li>



                     

    <li class="has_sub" id="tool" style="display: block">

                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="md md-view-list"></i><span> Tools </span> <span class="menu-arrow"></span></a>

                                <ul class="list-unstyled">

                                    <li><a href="price.php">Price Listing</a></li>

                                   <!-- <li><a href="pricefinal.php">Final Cost Price</a></li>-->

                              

                             

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

                          

                            <li><a href="logout.php"><i class="md md-settings-power"></i> Logout</a></li>

                        </ul>



                    </div>

                </div>

            </div>

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
                                   
                                    <h4 class="page-title">Streamline Inventory System</h4>
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
				<a href="#" onClick="switch_page(0);" style="color: #22A7F0;">Receival listing</a> &nbsp;&nbsp;&nbsp;&nbsp;
			
				<!--span>Receival listing</span-->
				
				
										
		<a href="#" onClick="switch_page(1);" style="color: #22A7F0;">Create Receival</a>
			
				
				
	
				</h5>
		    </div>

 	<div id="Receival_listing" class="blank" style="overflow-y: none;">
		
	
		
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
                                                <th>Invoice</th>
                                                <th>Date</th>
                                                 <th>Type</th>
                                                <th>Item</th>
                                                <th>Sheet</th>
                                                <!--<th>Reams</th>-->
                                                <th>sml</th>
                                                <th>lrg</th>
                                                <th>Sheet1</th>
                                                <th>Sheet2</th>
                                                <th>Cost</th>
                                              
                                                <th>Action</th>
                                                <th></th>
                                            </tr>
                                        </thead>
<tbody id="" style="" >

  
                                        	
                                       <?php
require 'db.php';
$db_servername = "localhost";
$db_username = "dert1_stream";
$db_password = "streamline";
$db_name =  "dert1_ssjlinve_inventorysystem";




	
	$sql = "SELECT receivals.*,rec_lineitems.*,rec_lineitems.id as rid, stocks.name,stocks.p1,stocks.id as sid
	FROM receivals 
	 INNER JOIN rec_lineitems 
	ON receivals.id=rec_lineitems.receival_id LEFT JOIN stocks ON rec_lineitems.stock_id=stocks.id  ";
	
	 

	
	//If the individual is searching for specific vendors  -Gavin Palmer || March 2016
	if(isset($_REQUEST["search_value"]))
	{
		$search_value=$_REQUEST["search_value"];
		$sql=$sql." WHERE invoice_number LIKE '".$search_value."%'";
	}
	
	if(isset($_REQUEST["search_start_date"]) && isset($_REQUEST["search_end_date"]))
	{
		if(($_REQUEST["search_start_date"]!="") && ($_REQUEST["search_end_date"]!=""))
		{
			$sql=$sql." and usagedate BETWEEN '".$_REQUEST["search_start_date"]."' and '".$_REQUEST["search_end_date"]."'";
		}
	}
	
$sql=$sql." ORDER BY receivals.id DESC";
	
	//echo "[".$sql."]";*/
					
					
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
											   $sid=$row["sid"];
											   $rid=$row["rid"];
										       $recid=$row["receival_id"];
												$inv=$row["invoice_number"];
												$rec=$row["created_at"];
												$equip=$row["equip"];
												$item=$row["items"];
												$name=$row["name"];
												$pack=$row["packs"];
												$qty=$row["tqty"];
											    $sheet1=$row["printedform1"];
												$sheet2=$row["printedform2"];
								                $envsmall=$row["envsmall"];
										        $envlarge=$row["envlarge"];
												$spenvsmall=$row["spenvsmall"];
											
												$cost=$row["cost"];
									$myNumber = $cost;			
									
									
										if($envlarge=="")
									{$envlarge="-";
									}
										if($envsmall=="")
									{$envsmall="-";
									}	
										if($sheet1=="")
									{$sheet1="-";
									}		
										if($sheet2=="")
									{$sheet2="-";
									}			
										if($sheet2=="")
									{$sheet2="-";
									}				
									
									if($qty=="")
									{$qty="&nbsp;&nbsp;&nbsp;&nbsp;-";;
									}		
										
										if($spenvsmall=="")
									{$spenvsmall="-";
									}					
										
									
									
												
												
												
												
											echo"
												
											<tr id='Listing_row_$id'>
											<td>$inv</td>
											<td>$rec</td>
											<td>$equip</td>
											<td>$name &nbsp;&nbsp;$item</td>
										
											<td>$qty</td>
											<!--<td>$pack</td>-->
											<td>$envsmall</td>
										    <td>$envlarge</td>
										    <td>$sheet1</td>
										    <td>$sheet2</td>
										  <td> $"?><?php echo number_format($myNumber,2);"</td>
										    
				<td class='text-center'>";														
				if($GLOBALS['role']>0 && $GLOBALS['role']<3)
				{
				  echo "<td> <a class='btn btn-primary btn-md button_style_addon' href='#' onClick='Show_Edit_Receival($id,$sid,$rid);stock($sid)'; style='border-radius: 5px;'><span class='glyphicon glyphicon-edit'></span> Edit</a> </td>";
				}
					if($GLOBALS['role']>0 && $GLOBALS['role']<2)
				{
				  echo " <td><a href='#' class='btn btn-danger btn-md button_style_addon' style='border-radius: 5px;' onClick='Remove_Receival($id,$recid,$sid,$rid);'><span class='glyphicon glyphicon-remove'></span> Del</a></td> ";
				}
						
						
					
										echo"</td></tr>";					
											
												
												
												
												
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
		<form id="Create_ID" data-toggle="validator" role="form" class="">
			<div class="form-group">
				<div class="row col-md-12 custyle">
									<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-tags"></span> 
										</div>
										<input class="form-control" id="Invoice_Number" name="Invoice_Number" type="text" placeholder="Invoice number" required/>
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
			Edit Receivals
		</div>
		<form id="Edit_Create_ID" data-toggle="validator" role="form" class="">
			<div class="form-group">
				<div class="row col-md-12 custyle">
									<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-tags"></span> 
										</div>
										<input class="form-control" id="Invoice_Number_Edit" name="Invoice_Number" type="text" placeholder="Invoice number" required/>
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

    

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "../plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
            TableManageButtons.init();

        </script>
        
        <!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->

    
    </body>
</html>
