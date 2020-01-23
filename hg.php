<?php
date_default_timezone_set("Jamaica");
session_start();
error_reporting(E_ALL-E_NOTICE);

require 'db.php';


//Prevent direct access, via browser
defined('SSJLinventory');

//Global Variables
$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name =  "ssjlinve_inventorysystem";

$dir="../";
require_once($dir."classes/Session_Manager.php");

//Set the access level for th query manager -Gavin Palmer || March 2016
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['role']."]";

$role = $_SESSION[$sid]['role'];


//_____________________________________________________________[Functions]____________________________________________________________________


/** -Gavin Palmer || March 2016
*	@Discription:	Requets from the server the default formated infromation in the receival table
*	
*	@param none
*
*	@return (String) HTML formatted table containing the results of the receival table
*/
function Generate_Receival_table()
{
		//$sql = "SELECT receivals.*,rec_lineitem.* FROM receivals LEFT JOIN rec_lineitems ON receivals.id=rec_lineitem.receival_id";


	$sql = "SELECT receivals.*,rec_lineitems.*,stocks.name,stocks.p1
	FROM receivals INNER JOIN rec_lineitems 
	ON receivals.id=rec_lineitems.receival_id LEFT JOIN stocks ON rec_lineitems.stock_id=stocks.id ";
	//$sql = "SELECT * FROM receivals";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Gavin Palmer || March 2016
	
	
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
			$sql=$sql." and recdate BETWEEN '".$_REQUEST["search_start_date"]."' and '".$_REQUEST["search_end_date"]."'";
		}
	}
	
	$sql=$sql." ORDER BY receivals.id DESC";
	
	//echo "[".$sql."]";
					
					
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
			$div=5000;
		    $box=0;	
		$per=0;
			// output data of each row
			while($row = $result->fetch_assoc())
			{ 
				
					
				    //box=$per/$div;				
				    $per1 =$row["packs"];
						$per =$row["boxs"];
					 //$per=$per/$div;
				
				$data_row_item_formatted = '
											<tr id="Listing_row_'.$row["id"].'">
												<td>'.$row["invoice_number"].'</td>
												<td>'.$row["recdate"].'</td>
													<td>'.$row["equip"].'</td>
												<td>'.$row["name"].' '.$row["p1"].'</td>
												<td>'.$row["envsmall"].'</td>
									<td>'.$row["envlarge"].'</td>
								<td>'.$per.'</td>
								<td>'.$per1.'</td>
									<td>'.$row["qty"].'</td>
									<td>'.$row["printedform1"].'</td>
									<td>'.$row["printedform2"].'</td>
									<td>'.'$'.$row["cost"].'</td>
												<td class="text-center">';
												
			if($GLOBALS['role']>0 && $GLOBALS['role']<3)
				{
					$data_row_item_formatted.=' <a class="btn btn-primary btn-md button_style_addon" href="#" onClick="Show_Edit_Receival('.$row["id"].');" style="border-radius: 5px;"><span class="glyphicon glyphicon-edit"></span> Edit</a>';
				}
				
				if($GLOBALS['role']>0 && $GLOBALS['role']<2)
				{
					$data_row_item_formatted.=' <a href="#" class="btn btn-danger btn-md button_style_addon" style="border-radius: 5px;" onClick="Remove_Receival('.$row["id"].','.$row["receival_id"].');"><span class="glyphicon glyphicon-remove"></span> Del</a>';
				}
												
				$data_row_item_formatted.='		</td>
											</tr>
										  ';
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
}



/** -Gavin Palmer || March 2016
*	@Discription:	Generates the options for the stock menu
*	
*	@param none
*
*	@return (String) HTML formatted output
*/
function Generate_Stock_in_Type()
{
	//Create SQL string
	$sql = "SELECT stocks.id,stocks.name,stocks.p1,stocks.papersize
			FROM stocks
			INNER JOIN fields
			ON fields.id=stocks.field_id";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors 
	if(isset($_REQUEST["Type"]))
	{
		$type = $_REQUEST["Type"];
		$sql = $sql." WHERE fields.name = '".$type."'";
		//echo "[".$sql."]";
	}
		
		
		if($type=="PAPER")
		{
		
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
				$data_row_item_formatted = '
											<option value="'.$row["id"].'">'.$row["name"].' '.$row["p1"].'</option>
										   ';
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
			
			
			
		}




if($type=="Envelope")

{
			
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
				$data_row_item_formatted = '
											<option value="'.$row["id"].'">'.$row["name"].':  '.$row["p1"].'   '.$row["papersize"].'</option>
										   ';
										   
									   
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
	
			
			
		}

	
	if($type=="PrintedForm")

{
			
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
				$data_row_item_formatted = '
											<option value="'.$row["id"].'">'.$row["name"].':  '.$row["p1"].'</option>
										   ';
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
			
			
			
		}
	
		if($type=="INSERTER")

{
			
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
				$data_row_item_formatted = '
											<option value="'.$row["id"].'">'.$row["name"].'</option>
										   ';
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
			
			
			
		}
	
	
}



function Generate_Stock_in_Types()
{
	//Create SQL string
	$sql = "SELECT stocks.id,stocks.name,stocks.p1,stocks.papersize
			FROM stocks
			INNER JOIN fields
			ON fields.id=stocks.field_id";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors 
	if(isset($_REQUEST["Type"]))
	{
		$type = $_REQUEST["Type"];
		$sql = $sql." WHERE fields.name = '".$type."'";
		//echo "[".$sql."]";
	}
		




if($type=="Envelope")

{
			
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
				$data_row_item_formatted = $row["papersize"];
			
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
	
			
			
		}

	

	
	
}






/** -Gavin Palmer || March 2016
*	@Discription:	adds a recieval to the recieval table and the coresponding line item in the receival line item table
*	
*	@param (void)
*
*	@return (void)
*/
function Add_Recieval()
{
	//variables
	$sql = "";
	$Invoice_Number = "";
	$Recdate = "";
	$Inline_items = "";
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	
			
	//If the individual is searching for specific vendors  
	if(isset($_REQUEST["Invoice_Number"]) && isset($_REQUEST["Recdate"]) && isset($_REQUEST["Inline_items"]))
	{
		$Invoice_Number = $_REQUEST["Invoice_Number"];
		$Recdate = $_REQUEST["Recdate"];
		$Inline_items = $_REQUEST["Inline_items"];
		
	}
					
	// Create connection to database
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		$sql ="INSERT INTO receivals(invoice_number, recdate, created_at, updated_at)
			VALUES (".$Invoice_Number.", '".$Recdate."', '".$created_at."', '".$updated_at."')";
						
		if($conn->query($sql) === TRUE)
		{
			  echo "New record created successfully";
			//Get the inserted ID for the Receival that was inserted above -Gavin Palmer || March 2016
			//Store individual line items   -Gavin Palmer || March 2016
			$id = mysqli_insert_id($conn); 
			$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Gavin Palmer || March 2016
			$number_of_inline_items = sizeof($item_objects);
			$box1=5000;
			$pack1=500;
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				//echo "Stock_ID: ".$item_objects[$x]['Stock_ID']." and Quantity: ".$item_objects[$x]['Quantity'];
				//Set numberic field to 0 if emppty
		
			  //This is where you add the Paper  receivals
			 
			   if($item_objects[$x]['Type']=="PAPER"){
			  $type=$item_objects[$x]['Type']; 						
			   	$sql ="SELECT stocks.p1 FROM stocks WHERE stocks.id =".$item_objects[$x]['Stock_ID'];
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$stype= $row['p1'];
	
	}
}	
	if($stype=="75gms"){		   				
		$sql ="SELECT * FROM price WHERE item ='$type'";
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$price= $row["75gms"];
	
	
	}


	 			
			   	  


}

 $sheet=$item_objects[$x]['sheet'];
					$box=$item_objects[$x]['totalbox'];
					$pack=$item_objects[$x]['totalpacks'];	
					$total=$box+$pack+$sheet;
			   	$cost=$total*$price;

			   	
				$sqls = "INSERT INTO rec_lineitems(receival_id, stock_id,cost,qty,boxs,packs,created_at,updated_at,items,equip)
					VALUES (".$id.", ".$item_objects[$x]['Stock_ID'].",".$cost.",".$item_objects[$x]['sheet'].", ".$item_objects[$x]['totalbox']/$box1." ,".$item_objects[$x]['totalpacks']/$pack1." , '".$created_at."', '".$updated_at."','".$stype."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sqls)===TRUE)
				{ 
					//Make adjustment the stock table 
					$total=0;
					$sheet=$item_objects[$x]['sheet'];
					$box=$item_objects[$x]['totalbox'];
					$pack=$item_objects[$x]['totalpacks'];
					$total=$box+$pack+$sheet;
					$sql = "UPDATE stocks
							SET instock = instock + $total ,reams=reams+$pack/500 ,box=box+$box/5000,single=single+$sheet, cost=cost+$cost
							WHERE id=".$item_objects[$x]['Stock_ID'];
									
					if($conn->query($sql) === TRUE)
					{
					 echo "Inventory successfully added";
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}
	}  
	
	if($stype=="80gms"){		   				
		$sql ="SELECT * FROM price WHERE item ='$type'";
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$price= $row["80gms"];
	
	
	}


	 			
			   	  


}

 $sheet=$item_objects[$x]['sheet'];
					$box=$item_objects[$x]['totalbox'];
					$pack=$item_objects[$x]['totalpacks'];	
					$total=$box+$pack+$sheet;
			   	$cost=$total*$price;

			   	
				$sqls = "INSERT INTO rec_lineitems(receival_id, stock_id,cost,qty,boxs,packs,created_at,updated_at,items,equip)
					VALUES (".$id.", ".$item_objects[$x]['Stock_ID'].",".$cost.",".$item_objects[$x]['sheet'].", ".$item_objects[$x]['totalbox']/$box1." ,".$item_objects[$x]['totalpacks']/$pack1." , '".$created_at."', '".$updated_at."','".$stype."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sqls)===TRUE)
				{ 
					//Make adjustment the stock table 
					$total=0;
					$sheet=$item_objects[$x]['sheet'];
					$box=$item_objects[$x]['totalbox'];
					$pack=$item_objects[$x]['totalpacks'];
					$total=$box+$pack+$sheet;
					$sql = "UPDATE stocks
							SET instock = instock + $total ,reams=reams+$pack/500 ,box=box+$box/5000,single=single+$sheet, cost=cost+$cost
							WHERE id=".$item_objects[$x]['Stock_ID'];
									
					if($conn->query($sql) === TRUE)
					{
					 echo "Inventory successfully added";
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}
	}  
	

	
	
	
	
			}
//This is the will add  Receivals to the envelope 

	$sql ="SELECT stocks.p1,stocks.papersize FROM stocks WHERE stocks.id =".$item_objects[$x]['Stock_ID'];
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$stype= $row['p1'];
		$size=$row['papersize'];
	//echo $stype;
	
	}
}
	
	if(($item_objects[$x]['Type']=="Envelope")&& ($stype=="Cayman")){
		
		
				$sql1 ="SELECT * FROM price WHERE teritory ='$stype'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$pricesmall= $row["envsmall"];
	$pricelarge= $row["10*12"];
	
	
	}	
			
			
	$small=$item_objects[$x]['envQuantity1'];
	$large=$item_objects[$x]['envQuantity2'];
				//	$totalsheet=$sheet1+$sheet2;
			   	
			   	$costsmall=$small*$pricesmall;
			   	$costlarge=$large*$pricelarge;
               
			    $totalcostenv=$costsmall+$costlarge;

		
				
			
					
			  $sqlz= "INSERT INTO rec_lineitems(receival_id,stock_id,envsmall,envlarge,costsmall,costlarge,cost,items,created_at,updated_at,equip)
					VALUES (".$id.",".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['envQuantity1']." , ".$item_objects[$x]['envQuantity2'].",".$costsmall.",".$costlarge.",".$totalcostenv.",'$stype','".$created_at."', '".$updated_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sqlz)===TRUE)
				{
					
					echo $x;
					// this update stock instock for the printed form
					$total=$item_objects[$x]['envQuantity1']+$item_objects[$x]['envQuantity2'];
					$sql1 = "UPDATE stocks
							SET small = small + ".$item_objects[$x]['envQuantity1'].",large=large+".$item_objects[$x]['envQuantity2'].",costsmall=costsmall+".$costsmall.",costlarge=costlarge+".$costlarge.",cost=cost+".$totalcostenv.",instock=instock+".$total."
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
					
					//$sql1 = "UPDATE stocks
						//	SET instock = instock + ".$item_objects[$x]['qtysheet1'].+$item_objects[$x]['qtysheet2']."
					      //  WHERE id=".$item_objects[$x]['Stock_ID'];				
					
					
					if($conn->query($sql1) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}		
			
			
			
		}
		
		
		
	}
			
	//	$sid=$item_objects[$x]['Stock_ID'];
		if(($item_objects[$x]['Type']=="Envelope")&& ($stype=="Turks")){
		
		
				$sql1 ="SELECT * FROM price WHERE teritory ='$stype'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$pricesmall= $row["envsmall"];
	$pricelarge= $row["10*12"];
	
	
	}	
			
			
	$small=$item_objects[$x]['envQuantity1'];
	$large=$item_objects[$x]['envQuantity2'];
				//	$totalsheet=$sheet1+$sheet2;
			   	
			   	$costsmall=$small*$pricesmall;
			   	$costlarge=$large*$pricelarge;
               
			    $totalcostenv=$costsmall+$costlarge;

		
				
			
					
			  $sqlz= "INSERT INTO rec_lineitems(receival_id,stock_id,envsmall,envlarge,costsmall,costlarge,cost,items,created_at,updated_at,equip)
					VALUES (".$id.",".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['envQuantity1']." , ".$item_objects[$x]['envQuantity2'].",".$costsmall.",".$costlarge.",".$totalcostenv.",'$stype','".$created_at."', '".$updated_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sqlz)===TRUE)
				{
					
					
					// this update stock instock for the printed form
					$total=$item_objects[$x]['envQuantity1']+$item_objects[$x]['envQuantity2'];
					$sql1 = "UPDATE stocks
							SET small = small + ".$item_objects[$x]['envQuantity1'].",large=large+".$item_objects[$x]['envQuantity2'].",costsmall=costsmall+".$costsmall.",costlarge=costlarge+".$costlarge.",cost=cost+".$totalcostenv.",instock=instock+".$total."
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
					
					//$sql1 = "UPDATE stocks
						//	SET instock = instock + ".$item_objects[$x]['qtysheet1'].+$item_objects[$x]['qtysheet2']."
					      //  WHERE id=".$item_objects[$x]['Stock_ID'];				
					
					
					if($conn->query($sql1) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}		
			
			
			
		}
		
		
		
	}
		
	
	
	if(($item_objects[$x]['Type']=="Envelope")&& ($stype=="Jamaica")){
		
		
				$sql1 ="SELECT * FROM price WHERE teritory ='$stype'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$pricesmall= $row["envsmall"];
	$pricelarge1=$row["9*12"];
	$pricelarge2=$row["10*12"];
	$pricelarge3=$row["12*15"];
	
	
	}	
			
			
	$small=$item_objects[$x]['envQuantity1'];
	$large=$item_objects[$x]['envQuantity2'];
				//	$totalsheet=$sheet1+$sheet2;
			   	
	$costsmall=$small*$pricesmall;
	
	
	if ($size=="9*12"){
			
	$costlarge=$large*$pricelarge1;	
	}
	if($size=="10*12"){
			
	$costlarge=$large*$pricelarge2;	
	}
	if($size=="12*15"){
			
	$costlarge=$large*$pricelarge3;	
	}
	
               
			    $totalcostenv=$costsmall+$costlarge;

		
				
			
					
			  $sqlz= "INSERT INTO rec_lineitems(receival_id,stock_id,envsmall,envlarge,costsmall,costlarge,cost,items,created_at,updated_at,equip)
					VALUES (".$id.",".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['envQuantity1']." , ".$item_objects[$x]['envQuantity2'].",".$costsmall.",".$costlarge.",".$totalcostenv.",'$stype','".$created_at."', '".$updated_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sqlz)===TRUE)
				{
					
				
					// this update stock instock for the printed form
					$total=$item_objects[$x]['envQuantity1']+$item_objects[$x]['envQuantity2'];
					$sql1 = "UPDATE stocks
							SET small = small + ".$item_objects[$x]['envQuantity1'].",large=large+".$item_objects[$x]['envQuantity2'].",costsmall=costsmall+".$costsmall.",costlarge=costlarge+".$costlarge.",cost=cost+".$totalcostenv.",instock=instock+".$total."
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
					
					//$sql1 = "UPDATE stocks
						//	SET instock = instock + ".$item_objects[$x]['qtysheet1'].+$item_objects[$x]['qtysheet2']."
					      //  WHERE id=".$item_objects[$x]['Stock_ID'];				
					
					
					if($conn->query($sql1) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}		
			
			
			
		}
		
		
		
	}
	
			
if(($item_objects[$x]['Type']=="Envelope")&& ($stype=="Ja")){
		
		
				$sql1 ="SELECT * FROM price WHERE teritory ='$stype'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$pricesmall= $row["envsmall"];
	$pricelarge1=$row["9*12"];

	$pricelarge3=$row["12*15"];
	
	
	}	
			
			
	$small=$item_objects[$x]['envQuantity1'];
	$large=$item_objects[$x]['envQuantity2'];
				//	$totalsheet=$sheet1+$sheet2;
			   	
	$costsmall=$small*$pricesmall;
	
	
	if ($size=="9*12"){
			
	$costlarge=$large*$pricelarge1;	
	}

	if($size=="12*15"){
			
	$costlarge=$large*$pricelarge3;	
	}
	
               
			    $totalcostenv=$costsmall+$costlarge;

		
				
			
					
			  $sqlz= "INSERT INTO rec_lineitems(receival_id,stock_id,envsmall,envlarge,costsmall,costlarge,cost,items,created_at,updated_at,equip)
					VALUES (".$id.",".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['envQuantity1']." , ".$item_objects[$x]['envQuantity2'].",".$costsmall.",".$costlarge.",".$totalcostenv.",'$stype','".$created_at."', '".$updated_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sqlz)===TRUE)
				{
					
				
					// this update stock instock for the printed form
					$total=$item_objects[$x]['envQuantity1']+$item_objects[$x]['envQuantity2'];
					$sql1 = "UPDATE stocks
							SET small = small + ".$item_objects[$x]['envQuantity1'].",large=large+".$item_objects[$x]['envQuantity2'].",costsmall=costsmall+".$costsmall.",costlarge=costlarge+".$costlarge.",cost=cost+".$totalcostenv.",instock=instock+".$total."
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
					
					//$sql1 = "UPDATE stocks
						//	SET instock = instock + ".$item_objects[$x]['qtysheet1'].+$item_objects[$x]['qtysheet2']."
					      //  WHERE id=".$item_objects[$x]['Stock_ID'];				
					
					
					if($conn->query($sql1) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}		
			
			
			
		}
		
		
		
	}


if(($item_objects[$x]['Type']=="Envelope")&& ($stype=="Bonaire")){
		
		
				$sql1 ="SELECT * FROM price WHERE teritory ='$stype'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$pricesmall= $row["envsmall"];
	$pricelarge1=$row["9*12"];

	
	
	
	}	
			
			
	$small=$item_objects[$x]['envQuantity1'];
	$large=$item_objects[$x]['envQuantity2'];
				//	$totalsheet=$sheet1+$sheet2;
			   	
	$costsmall=$small*$pricesmall;
	
	
	if ($size=="9*12"){
			
	$costlarge=$large*$pricelarge1;	
	}

	
               
	$totalcostenv=$costsmall+$costlarge;

		
				
			
					
			  $sqlz= "INSERT INTO rec_lineitems(receival_id,stock_id,envsmall,envlarge,costsmall,costlarge,cost,items,created_at,updated_at,equip)
					VALUES (".$id.",".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['envQuantity1']." , ".$item_objects[$x]['envQuantity2'].",".$costsmall.",".$costlarge.",".$totalcostenv.",'$stype','".$created_at."', '".$updated_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sqlz)===TRUE)
				{
					
				
					// this update stock instock for the printed form
					$total=$item_objects[$x]['envQuantity1']+$item_objects[$x]['envQuantity2'];
					$sql1 = "UPDATE stocks
							SET small = small + ".$item_objects[$x]['envQuantity1'].",large=large+".$item_objects[$x]['envQuantity2'].",costsmall=costsmall+".$costsmall.",costlarge=costlarge+".$costlarge.",cost=cost+".$totalcostenv.",instock=instock+".$total."
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
					
					//$sql1 = "UPDATE stocks
						//	SET instock = instock + ".$item_objects[$x]['qtysheet1'].+$item_objects[$x]['qtysheet2']."
					      //  WHERE id=".$item_objects[$x]['Stock_ID'];				
					
					
					if($conn->query($sql1) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}		
			
			
			
		}
		
		
		
	}


if(($item_objects[$x]['Type']=="Envelope")&& ($stype=="Curacao")){
		
		
				$sql1 ="SELECT * FROM price WHERE teritory ='$stype'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$pricesmall= $row["envsmall"];
	$pricelarge1=$row["9*12"];

	
	
	
	}	
			
			
	$small=$item_objects[$x]['envQuantity1'];
	$large=$item_objects[$x]['envQuantity2'];
				//	$totalsheet=$sheet1+$sheet2;
			   	
	$costsmall=$small*$pricesmall;
	
	
	if ($size=="9*12"){
			
	$costlarge=$large*$pricelarge1;	
	}

	
               
	$totalcostenv=$costsmall+$costlarge;

		
				
			
					
			  $sqlz= "INSERT INTO rec_lineitems(receival_id,stock_id,envsmall,envlarge,costsmall,costlarge,cost,items,created_at,updated_at,equip)
					VALUES (".$id.",".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['envQuantity1']." , ".$item_objects[$x]['envQuantity2'].",".$costsmall.",".$costlarge.",".$totalcostenv.",'$stype','".$created_at."', '".$updated_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sqlz)===TRUE)
				{
					
				
					// this update stock instock for the printed form
					$total=$item_objects[$x]['envQuantity1']+$item_objects[$x]['envQuantity2'];
					$sql1 = "UPDATE stocks
							SET small = small + ".$item_objects[$x]['envQuantity1'].",large=large+".$item_objects[$x]['envQuantity2'].",costsmall=costsmall+".$costsmall.",costlarge=costlarge+".$costlarge.",cost=cost+".$totalcostenv.",instock=instock+".$total."
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
					
					//$sql1 = "UPDATE stocks
						//	SET instock = instock + ".$item_objects[$x]['qtysheet1'].+$item_objects[$x]['qtysheet2']."
					      //  WHERE id=".$item_objects[$x]['Stock_ID'];				
					
					
					if($conn->query($sql1) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}		
			
			
			
		}
		
		
		
	}

if(($item_objects[$x]['Type']=="Envelope")&& ($stype=="Aruba")){
		
		
				$sql1 ="SELECT * FROM price WHERE teritory ='$stype'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$pricesmall= $row["envsmall"];
	$pricelarge1=$row["9*12"];

	
	
	
	}	
			
			
	$small=$item_objects[$x]['envQuantity1'];
	$large=$item_objects[$x]['envQuantity2'];
				//	$totalsheet=$sheet1+$sheet2;
			   	
	$costsmall=$small*$pricesmall;
	
	
	if ($size=="9*12"){
			
	$costlarge=$large*$pricelarge1;	
	}

	
               
	$totalcostenv=$costsmall+$costlarge;

		
				
			
					
			  $sqlz= "INSERT INTO rec_lineitems(receival_id,stock_id,envsmall,envlarge,costsmall,costlarge,cost,items,created_at,updated_at,equip)
					VALUES (".$id.",".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['envQuantity1']." , ".$item_objects[$x]['envQuantity2'].",".$costsmall.",".$costlarge.",".$totalcostenv.",'$stype','".$created_at."', '".$updated_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sqlz)===TRUE)
				{
					
				
					// this update stock instock for the printed form
					$total=$item_objects[$x]['envQuantity1']+$item_objects[$x]['envQuantity2'];
					$sql1 = "UPDATE stocks
							SET small = small + ".$item_objects[$x]['envQuantity1'].",large=large+".$item_objects[$x]['envQuantity2'].",costsmall=costsmall+".$costsmall.",costlarge=costlarge+".$costlarge.",cost=cost+".$totalcostenv.",instock=instock+".$total."
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
					
					//$sql1 = "UPDATE stocks
						//	SET instock = instock + ".$item_objects[$x]['qtysheet1'].+$item_objects[$x]['qtysheet2']."
					      //  WHERE id=".$item_objects[$x]['Stock_ID'];				
					
					
					if($conn->query($sql1) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}		
			
			
			
		}
		
		
		
	}

if(($item_objects[$x]['Type']=="Envelope")&& ($stype=="DigiCay")){
		
		
				$sql1 ="SELECT * FROM price WHERE teritory ='$stype'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$pricesmall= $row["envsmall"];
	$pricelarge1=$row["9*12"];

	
	
	
	}	
			
			
	$small=$item_objects[$x]['envQuantity1'];
	$large=$item_objects[$x]['envQuantity2'];
				//	$totalsheet=$sheet1+$sheet2;
			   	
	$costsmall=$small*$pricesmall;
	
	
	if ($size=="9*12"){
			
	$costlarge=$large*$pricelarge1;	
	}

	
               
	$totalcostenv=$costsmall+$costlarge;

		
				
			
					
			  $sqlz= "INSERT INTO rec_lineitems(receival_id,stock_id,envsmall,envlarge,costsmall,costlarge,cost,items,created_at,updated_at,equip)
					VALUES (".$id.",".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['envQuantity1']." , ".$item_objects[$x]['envQuantity2'].",".$costsmall.",".$costlarge.",".$totalcostenv.",'$stype','".$created_at."', '".$updated_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sqlz)===TRUE)
				{
					
				
					// this update stock instock for the printed form
					$total=$item_objects[$x]['envQuantity1']+$item_objects[$x]['envQuantity2'];
					$sql1 = "UPDATE stocks
							SET small = small + ".$item_objects[$x]['envQuantity1'].",large=large+".$item_objects[$x]['envQuantity2'].",costsmall=costsmall+".$costsmall.",costlarge=costlarge+".$costlarge.",cost=cost+".$totalcostenv.",instock=instock+".$total."
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
					
					//$sql1 = "UPDATE stocks
						//	SET instock = instock + ".$item_objects[$x]['qtysheet1'].+$item_objects[$x]['qtysheet2']."
					      //  WHERE id=".$item_objects[$x]['Stock_ID'];				
					
					
					if($conn->query($sql1) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}		
			
			
			
		}
		
		
		
	}


	
				

//This will add the receival and update the stock: Imani Sterling 2018
				if($item_objects[$x]['Type']=="PrintedForm"){
					
					
					
		$sql ="SELECT stocks.p1 FROM stocks WHERE stocks.id =".$item_objects[$x]['Stock_ID'];
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$stype= $row['p1'];
	
	}
}
					
		if($stype=="Jam"){
			
		$sql1 ="SELECT * FROM price WHERE teritory ='$stype'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$pricesheet1= $row["sheet1"];
	$pricesheet2= $row["sheet2"];
	
	
	}	
			
			
	$sheet1=$item_objects[$x]['qtysheet1'];
					$sheet2=$item_objects[$x]['qtysheet2'];
				//	$totalsheet=$sheet1+$sheet2;
			   	
			   	$costsheet1=$sheet1*$pricesheet1;
			   	$costsheet2=$sheet2*$pricesheet2;
               
			    $totalcostsheet=$costsheet1+$costsheet2;

		
				
					
					
			  $sql= "INSERT INTO rec_lineitems(receival_id,stock_id,printedform1,printedform2,costsheet1,costsheet2,cost,items,created_at,updated_at,equip)
					VALUES (".$id.", ".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['qtysheet1']." , ".$item_objects[$x]['qtysheet2'].",".$costsheet1.",".$costsheet2.",".$totalcostsheet.",'$stype','".$created_at."', '".$updated_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sql)===TRUE)
				{
					
					
					// this update stock instock for the printed form
					$total=$item_objects[$x]['qtysheet1']+$item_objects[$x]['qtysheet2'];
					$sql1 = "UPDATE stocks
							SET sheet1 = sheet1 + ".$item_objects[$x]['qtysheet1'].",sheet2=sheet2+".$item_objects[$x]['qtysheet2'].",costsheet1=costsheet1+".$costsheet1.",costsheet2=costsheet2+".$costsheet2.",cost=cost+".$totalcostsheet.",instock=instock+".$total."
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
					
					//$sql1 = "UPDATE stocks
						//	SET instock = instock + ".$item_objects[$x]['qtysheet1'].+$item_objects[$x]['qtysheet2']."
					      //  WHERE id=".$item_objects[$x]['Stock_ID'];				
					
					
					if($conn->query($sql1) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}		
			
			
			
		}


					
			}



if($stype=="DigiPlay"){
			
		$sql1 ="SELECT * FROM price WHERE teritory ='$stype'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$pricesheet1= $row["sheet1"];
	$pricesheet2= $row["sheet2"];
	
	
	}	
			
			
	$sheet1=$item_objects[$x]['qtysheet1'];
					$sheet2=$item_objects[$x]['qtysheet2'];
				//	$totalsheet=$sheet1+$sheet2;
			   	
			   	$costsheet1=$sheet1*$pricesheet1;
			   	$costsheet2=$sheet2*$pricesheet2;
               
			    $totalcostsheet=$costsheet1+$costsheet2;

		
				
					
					
			  $sql= "INSERT INTO rec_lineitems(receival_id,stock_id,printedform1,printedform2,costsheet1,costsheet2,cost,items,created_at,updated_at,equip)
					VALUES (".$id.", ".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['qtysheet1']." , ".$item_objects[$x]['qtysheet2'].",".$costsheet1.",".$costsheet2.",".$totalcostsheet.",'$stype','".$created_at."', '".$updated_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sql)===TRUE)
				{
					
					
					// this update stock instock for the printed form
					$total=$item_objects[$x]['qtysheet1']+$item_objects[$x]['qtysheet2'];
					$sql1 = "UPDATE stocks
							SET sheet1 = sheet1 + ".$item_objects[$x]['qtysheet1'].",sheet2=sheet2+".$item_objects[$x]['qtysheet2'].",costsheet1=costsheet1+".$costsheet1.",costsheet2=costsheet2+".$costsheet2.",cost=cost+".$totalcostsheet.",instock=instock+".$total."
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
					
					//$sql1 = "UPDATE stocks
						//	SET instock = instock + ".$item_objects[$x]['qtysheet1'].+$item_objects[$x]['qtysheet2']."
					      //  WHERE id=".$item_objects[$x]['Stock_ID'];				
					
					
					if($conn->query($sql1) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}		
			
			
			
		}


					
			}



if($stype=="DigiPlay"){
			
		$sql1 ="SELECT * FROM price WHERE teritory ='$stype'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$pricesheet1= $row["sheet1"];
	$pricesheet2= $row["sheet2"];
	
	
	}	
			
			
	$sheet1=$item_objects[$x]['qtysheet1'];
					$sheet2=$item_objects[$x]['qtysheet2'];
				//	$totalsheet=$sheet1+$sheet2;
			   	
			   	$costsheet1=$sheet1*$pricesheet1;
			   	$costsheet2=$sheet2*$pricesheet2;
               
			    $totalcostsheet=$costsheet1+$costsheet2;

		
				
					
					
			  $sql= "INSERT INTO rec_lineitems(receival_id,stock_id,printedform1,printedform2,costsheet1,costsheet2,cost,items,created_at,updated_at,equip)
					VALUES (".$id.", ".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['qtysheet1']." , ".$item_objects[$x]['qtysheet2'].",".$costsheet1.",".$costsheet2.",".$totalcostsheet.",'$stype','".$created_at."', '".$updated_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sql)===TRUE)
				{
					
					
					// this update stock instock for the printed form
					$total=$item_objects[$x]['qtysheet1']+$item_objects[$x]['qtysheet2'];
					$sql1 = "UPDATE stocks
							SET sheet1 = sheet1 + ".$item_objects[$x]['qtysheet1'].",sheet2=sheet2+".$item_objects[$x]['qtysheet2'].",costsheet1=costsheet1+".$costsheet1.",costsheet2=costsheet2+".$costsheet2.",cost=cost+".$totalcostsheet.",instock=instock+".$total."
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
					
					//$sql1 = "UPDATE stocks
						//	SET instock = instock + ".$item_objects[$x]['qtysheet1'].+$item_objects[$x]['qtysheet2']."
					      //  WHERE id=".$item_objects[$x]['Stock_ID'];				
					
					
					if($conn->query($sql1) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}		
			
			
			
		}


					
			}



if($stype=="Aruba"){
			
		$sql1 ="SELECT * FROM price WHERE teritory ='$stype'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$pricesheet1= $row["sheet1"];
	
	
	
	}	
			
			
	$sheet1=$item_objects[$x]['qtysheet1'];
				
				//	$totalsheet=$sheet1+$sheet2;
			   	
			   	$costsheet1=$sheet1*$pricesheet1;
			   
               
			    $totalcostsheet=$costsheet1;

		
				
					
					
			  $sql= "INSERT INTO rec_lineitems(receival_id,stock_id,printedform1,costsheet1,cost,items,created_at,updated_at,equip)
					VALUES (".$id.", ".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['qtysheet1']." ,".$costsheet1.",".",".$totalcostsheet.",'$stype','".$created_at."', '".$updated_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sql)===TRUE)
				{
					
					
					// this update stock instock for the printed form
					$total=$item_objects[$x]['qtysheet1'];
					$sql1 = "UPDATE stocks
							SET sheet1 = sheet1 + ".$item_objects[$x]['qtysheet1'].",costsheet1=costsheet1+".$costsheet1.",cost=cost+".$totalcostsheet.",instock=instock+".$total."
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
					
					//$sql1 = "UPDATE stocks
						//	SET instock = instock + ".$item_objects[$x]['qtysheet1'].+$item_objects[$x]['qtysheet2']."
					      //  WHERE id=".$item_objects[$x]['Stock_ID'];				
					
					
					if($conn->query($sql1) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}		
			
			
			
		}


					
			}



if($stype=="Bonaire"){
			
		$sql1 ="SELECT * FROM price WHERE teritory ='$stype'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$pricesheet1= $row["sheet1"];
	
	
	
	}	
			
			
	$sheet1=$item_objects[$x]['qtysheet1'];
				
				//	$totalsheet=$sheet1+$sheet2;
			   	
			   	$costsheet1=$sheet1*$pricesheet1;
			   
               
			    $totalcostsheet=$costsheet1;

		
				
					
					
			  $sql= "INSERT INTO rec_lineitems(receival_id,stock_id,printedform1,costsheet1,cost,items,created_at,updated_at,equip)
					VALUES (".$id.", ".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['qtysheet1']." ,".$costsheet1.",".",".$totalcostsheet.",'$stype','".$created_at."', '".$updated_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sql)===TRUE)
				{
					
					
					// this update stock instock for the printed form
					$total=$item_objects[$x]['qtysheet1'];
					$sql1 = "UPDATE stocks
							SET sheet1 = sheet1 + ".$item_objects[$x]['qtysheet1'].",costsheet1=costsheet1+".$costsheet1.",cost=cost+".$totalcostsheet.",instock=instock+".$total."
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
					
					//$sql1 = "UPDATE stocks
						//	SET instock = instock + ".$item_objects[$x]['qtysheet1'].+$item_objects[$x]['qtysheet2']."
					      //  WHERE id=".$item_objects[$x]['Stock_ID'];				
					
					
					if($conn->query($sql1) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}		
			
			
			
		}


					
			}

if($stype=="Curacao"){
			
		$sql1 ="SELECT * FROM price WHERE teritory ='$stype'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$pricesheet1= $row["sheet1"];
	
	
	
	}	
			
			
	$sheet1=$item_objects[$x]['qtysheet1'];
				
				//	$totalsheet=$sheet1+$sheet2;
			   	
			   	$costsheet1=$sheet1*$pricesheet1;
			   
               
			    $totalcostsheet=$costsheet1;

		
				
					
					
			  $sql= "INSERT INTO rec_lineitems(receival_id,stock_id,printedform1,costsheet1,cost,items,created_at,updated_at,equip)
					VALUES (".$id.", ".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['qtysheet1']." ,".$costsheet1.",".",".$totalcostsheet.",'$stype','".$created_at."', '".$updated_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sql)===TRUE)
				{
					
					
					// this update stock instock for the printed form
					$total=$item_objects[$x]['qtysheet1'];
					$sql1 = "UPDATE stocks
							SET sheet1 = sheet1 + ".$item_objects[$x]['qtysheet1'].",costsheet1=costsheet1+".$costsheet1.",cost=cost+".$totalcostsheet.",instock=instock+".$total."
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
					
					//$sql1 = "UPDATE stocks
						//	SET instock = instock + ".$item_objects[$x]['qtysheet1'].+$item_objects[$x]['qtysheet2']."
					      //  WHERE id=".$item_objects[$x]['Stock_ID'];				
					
					
					if($conn->query($sql1) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}		
			
			
			
		}


					
			}



if($stype=="Islands"){
			
		$sql1 ="SELECT * FROM price WHERE teritory ='$stype'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$pricesheet2= $row["sheet2"];
	
	
	
	}	
			
			
	$sheet2=$item_objects[$x]['qtysheet2'];
				
				//	$totalsheet=$sheet1+$sheet2;
			   	
			   	$costsheet2=$sheet2*$pricesheet2;
			   
               
			    $totalcostsheet=$costshee2;

		
				
					
					
			  $sql= "INSERT INTO rec_lineitems(receival_id,stock_id,printedform2,costsheet2,cost,items,created_at,updated_at,equip)
					VALUES (".$id.", ".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['qtysheet2']." ,".$costsheet2.",".",".$totalcostsheet.",'$stype','".$created_at."', '".$updated_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sql)===TRUE)
				{
					
					
					// this update stock instock for the printed form
					$total=$item_objects[$x]['qtysheet2'];
					$sql1 = "UPDATE stocks
							SET sheet2 = sheet2 + ".$item_objects[$x]['qtysheet2'].",costsheet2=costsheet2+".$costsheet2.",cost=cost+".$totalcostsheet.",instock=instock+".$total."
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
					
					//$sql1 = "UPDATE stocks
						//	SET instock = instock + ".$item_objects[$x]['qtysheet1'].+$item_objects[$x]['qtysheet2']."
					      //  WHERE id=".$item_objects[$x]['Stock_ID'];				
					
					
					if($conn->query($sql1) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}		
			
			
			
		}


					
			}



if($stype=="DigiCay"){
			
		$sql1 ="SELECT * FROM price WHERE teritory ='$stype'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$pricesheet1= $row["sheet1"];
	
	
	
	}	
			
			
	$sheet1=$item_objects[$x]['qtysheet1'];
				
				//	$totalsheet=$sheet1+$sheet2;
			   	
			   	$costsheet1=$sheet1*$pricesheet1;
			   
               
			    $totalcostsheet=$costsheet1;

		
				
					
					
			  $sql= "INSERT INTO rec_lineitems(receival_id,stock_id,printedform1,costsheet1,cost,items,created_at,updated_at,equip)
					VALUES (".$id.", ".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['qtysheet1']." ,".$costsheet1.",".",".$totalcostsheet.",'$stype','".$created_at."', '".$updated_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sql)===TRUE)
				{
					
					
					// this update stock instock for the printed form
					$total=$item_objects[$x]['qtysheet1'];
					$sql1 = "UPDATE stocks
							SET sheet1 = sheet1 + ".$item_objects[$x]['qtysheet1'].",costsheet1=costsheet1+".$costsheet1.",cost=cost+".$totalcostsheet.",instock=instock+".$total."
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
					
					//$sql1 = "UPDATE stocks
						//	SET instock = instock + ".$item_objects[$x]['qtysheet1'].+$item_objects[$x]['qtysheet2']."
					      //  WHERE id=".$item_objects[$x]['Stock_ID'];				
					
					
					if($conn->query($sql1) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}		
			
			
			
		}


					
			}

if($stype=="Ja"){
			
		$sql1 ="SELECT * FROM price WHERE teritory ='$stype'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$pricesheet1= $row["sheet1"];
	$pricesheet2= $row["sheet2"];
	
	
	}	
			
			
	$sheet1=$item_objects[$x]['qtysheet1'];
					$sheet2=$item_objects[$x]['qtysheet2'];
				//	$totalsheet=$sheet1+$sheet2;
			   	
			   	$costsheet1=$sheet1*$pricesheet1;
			   	$costsheet2=$sheet2*$pricesheet2;
               
			    $totalcostsheet=$costsheet1+$costsheet2;

		
				
					
					
			  $sql= "INSERT INTO rec_lineitems(receival_id,stock_id,printedform1,printedform2,costsheet1,costsheet2,cost,items,created_at,updated_at,equip)
					VALUES (".$id.", ".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['qtysheet1']." , ".$item_objects[$x]['qtysheet2'].",".$costsheet1.",".$costsheet2.",".$totalcostsheet.",'$stype','".$created_at."', '".$updated_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sql)===TRUE)
				{
					
					
					// this update stock instock for the printed form
					$total=$item_objects[$x]['qtysheet1']+$item_objects[$x]['qtysheet2'];
					$sql1 = "UPDATE stocks
							SET sheet1 = sheet1 + ".$item_objects[$x]['qtysheet1'].",sheet2=sheet2+".$item_objects[$x]['qtysheet2'].",costsheet1=costsheet1+".$costsheet1.",costsheet2=costsheet2+".$costsheet2.",cost=cost+".$totalcostsheet.",instock=instock+".$total."
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
					
					//$sql1 = "UPDATE stocks
						//	SET instock = instock + ".$item_objects[$x]['qtysheet1'].+$item_objects[$x]['qtysheet2']."
					      //  WHERE id=".$item_objects[$x]['Stock_ID'];				
					
					
					if($conn->query($sql1) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}		
			
			
			
		}


					
			}




}
if($item_objects[$x]['Type']=="INSERTER"){
			   $sql= "INSERT INTO rec_lineitems(receival_id,stock_id,qty,created_at,updated_at,equip)
					VALUES (".$id.", ".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['inserter']." ,'".$created_at."', '".$updated_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sql)===TRUE)
				{
					// Make adjustment the stock table in
					
					// this update stock envelope quantity: 
					
					$sql = "UPDATE stocks
							SET instock = instock + ".$item_objects[$x]['inserter']."
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
							
					
					
					if($conn->query($sql) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}
			}






		}
			
		}
		else
		{
			echo "Error while inserting into database: ".$conn->error;
		}
		$conn->close();
	}
}




/** -Gavin Palmer || March 2016
*	@Discription:	Remove the given recieval from th receival table along with its line items
*	
*	@param (void)
*
*	@return (String) HTML formatted output
*/
function Remove_Receival()
{

	$sql = "";
	
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);

	if(isset($_REQUEST["id"]))
	{
		$id = $_REQUEST["id"];
		$sql3="SELECT * FROM rec_lineitems 
		WHERE receival_id=".$id;
		
		$result= $conn->query($sql3);
		
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				$equip=$row["equip"];
                $type=$row["items"];
				
			}
		}	
			if(($equip=="PAPER") && ($type=="75gms")){
									
								
		$sql ="SELECT * FROM price WHERE 75gms =".$type;
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$price= $row["75gms"];
	
	
	}


	 			
			   	  


}			
						
					
				
				
				$id = $_REQUEST["id"];
		$sql3="SELECT * FROM rec_lineitems 
		WHERE receival_id=".$id;
		
		$result= $conn->query($sql3);
				
			if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				//$id=$row["id"];
				
				$equip=$row["equip"];
				$stockid=$row["stock_id"];
				$sheet=$row["qty"];
				$box=$row["boxs"];
				$pack=$row["packs"];
				$tdelete=$box*5000+$pack*500+$sheet;
				$cost=$tdelete*$price;
				
				}	
				
				$sql2 = "UPDATE stocks
							SET instock = instock - $tdelete,single=single-$sheet,box=box-$box,reams=reams-$pack, cost=cost-$cost
					        WHERE id=$stockid";
			
				
			}
			
				if ($conn->query($sql2) === TRUE)
			{
				echo "Record deleted from Inventory successfully";
			}
			else
			{
				echo "Error deleting Inventory record: " . $conn->error;
			}
			
			
		}
			
			if($equip=="Envelope"){
				
				
				$id = $_REQUEST["id"];
		$sql3="SELECT * FROM rec_lineitems 
		WHERE receival_id=".$id;
		
		$result= $conn->query($sql3);
				
			if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				//$id=$row["id"];
				$equip=$row["equip"];
				$stockid=$row["stock_id"];
				$envsmall=$row["envsmall"];
				$envlarge=$row["envlarge"];
		        $costsmall=$row["costsmall"];
				 $costlarge=$row["costlarge"];
				 $cost=$row["cost"];
				$totalenv=$envsmall+$envlarge;
				}	
				
				$sql2 = "UPDATE stocks
							SET instock = instock - $totalenv,small=small-$envsmall,large=large-$envlarge,costsmall=costsmall-$costsmall,costlarge=costlarge-$costlarge,cost=cost-$cost
					        WHERE id=$stockid";
			
				
			}
			
				if ($conn->query($sql2) === TRUE)
			{
				echo "Record deleted from Inventory successfully";
			}
			else
			{
				echo "Error deleting Inventory record: " . $conn->error;
			}
			
			
		}
		
		
		if($equip=="PrintedForm"){
				
				
				$id = $_REQUEST["id"];
		$sql3="SELECT * FROM rec_lineitems 
		WHERE receival_id=".$id;
		
		$result= $conn->query($sql3);
				
			if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				//$id=$row["id"];
				$equip=$row["equip"];
				$stockid=$row["stock_id"];
				$sheet1=$row["printedform1"];
				$sheet2=$row["printedform2"];
				
				
				$costsheet1=$row["costsheet1"];
					$costsheet2=$row["costsheet2"];
						$cost=$row["cost"];
				$totalsheet=$sheet1+$sheet2;
				}	
				
				$sql2 = "UPDATE stocks
							SET instock = instock - $totalsheet,sheet1=sheet1-$sheet1,sheet2=sheet2-$sheet2,costsheet1=costsheet1-$costsheet1,costsheet2=costsheet2-$costsheet2,cost=cost-$cost
					        WHERE id=$stockid";
			
				
			}
			
				if ($conn->query($sql2) === TRUE)
			{
				echo "Record deleted from Inventory successfully";
			}
			else
			{
				echo "Error deleting Inventory record: " . $conn->error;
				echo $sql2;
			}
			
			
		}
		
		
		
		
		$sql = "DELETE FROM rec_lineitems WHERE receival_id=".$id;
		//echo "[".$sql.  $sql2."]"  ;
	}
	
					
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
						
		if ($conn->query($sql) === TRUE)
		{
			//finally delete Receival
			$sql = "DELETE FROM receivals WHERE id=".$id;
			
			
		}
		else
		{
			echo "Error deleting record: " . $conn->error;
		}
		$conn->close();
	}
}



/** -Gavin Palmer || March 2016
*	@Discription:	Get the the receival inline items from the inline item table and format the output for display
*	
*	@param (Integer) $id - The id numbere for the receival
*
*	@return (String) HTML formatted output
*/
function Get_Receival_line_items($id)
{
	//Create SQL string -Gavin Palmer || March 2016
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Gavin Palmer || March 2016
	
	
	//If the individual is searching for specific vendors  -Gavin Palmer || March 2016
	if(isset($id))
	{
			
		$sql="SELECT rec_lineitems.id, stocks.name, rec_lineitems.qty , rec_lineitems.envsmall
		
			  FROM rec_lineitems
			  INNER JOIN stocks
			  ON rec_lineitems.stock_id=stocks.id
			  WHERE rec_lineitems.receival_id=".$id;
	}
					
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
						
		//$result = $conn->query($sql);
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				$data_row_item_formatted = '
											<tr id=\''.$row["id"].'\'>
												<td>'.$row["name"].'</td>
												
												
												
											</tr>
										   ';
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
}



/** -Gavin Palmer || March 2016
*	@Discription:	Get the receival id, invoice number and created date in json encoded format
*	
*	@param (void)
*
*	@return (String) JSON ended formatted output
*/
function Basic_Receival_info()
{
	//Create SQL string 
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors  
	if(isset($_REQUEST["id"]))
	{
	
		$id=$_REQUEST["id"];
		
		$sql="SELECT receivals.*, rec_lineitems.*
			  FROM receivals
			  INNER JOIN rec_lineitems
			  ON receivals.id=rec_lineitems.receival_id
			  WHERE rec_lineitems.id=".$id;
	}

					
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
				$json_encoded_out = array('Invoice_Number' => $row["invoice_number"], 'Recdate' => ''.$row["recdate"].'');
				$json_encoded_out = json_encode($json_encoded_out);
				
				$formatted_result=$json_encoded_out;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
}


/** -Gavin Palmer || March 2016
*	@Discription:	Get the the receival inline items from the inline item table and format the output for JSON
*	
*	@param (Integer) $id - The id numbere for the receival
*
*	@return (String) JSON formatted output
*/
function Get_Receival_line_items_JSON()
{
	//Create SQL string -Gavin Palmer || March 2016
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Gavin Palmer || March 2016
	
	
	//If the individual is searching for specific vendors  -Gavin Palmer || March 2016
	if(isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
		
		$sql="SELECT receivals.*, rec_lineitems.*,stocks.*
			  FROM  receivals
			  	INNER JOIN rec_lineitems
			  	ON receivals.id=rec_lineitems.receival_id LEFT JOIN stocks
			  	ON rec_lineitems.stock_id=stocks.id
		      WHERE rec_lineitems.id=".$id;
					 
	}
					
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
			$line_items = array();
			
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				$line_item = array('id' => $row["receival_id"],'ptype' => $row["p1"], 'stock_id' => $row["stock_id"], 'sheet' => $row["qty"], 'name' => ''.$row["name"].'', 'equip' => $row["equip"], 'boxs' => $row["boxs"], 'packs' => $row["packs"],'envsmall' => $row["envsmall"], 'envlarge' => $row["envlarge"], 'printedform1' => $row["printedform1"], 'printedform2' => $row["printedform2"]);
				
				array_push($line_items, $line_item);
			}
			$json_encoded_out = json_encode($line_items);
			$formatted_result=$json_encoded_out;
			$conn->close();
		}
		else
		{
			$conn->close();
		}
	}

	return $formatted_result;
}


/** -Gavin Palmer || March 2016
*	@Discription:	Requets from the server the default formated infromation in the Usage table
*	
*	@param none
*
*	@return (String) HTML formatted table containing the results of the receival table
*/
function Generate_Usage_table()
{
	
	
	$sql = "SELECT usages.*,usage_lineitems.*,stocks.name
			    FROM usages
			    INNER JOIN usage_lineitems
			    ON usages.id=usage_lineitems.usage_id LEFT JOIN stocks ON usage_lineitems.stock_id=stocks.id 
			   ";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Gavin Palmer || March 2016
	
	
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
	
	$sql=$sql." ORDER BY usages.id DESC";
	
	//echo "[".$sql."]";
					
					
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
				$data_row_item_formatted = '
											<tr id="Listing_row_'.$row["id"].'">
												<td>'.$row["invoice_number"].'</td>
												<td>'.$row["usagedate"].'</td>
												<td>'.$row["equip"].'</td>
												<td>'.$row["purpose"].'</td>
												<td>'.$row["name"].'</td>
												<td>'.$row["pack"].'</td>
												<td>'.$row["qty"].'</td>
												<td>'.$row["spoilage"].'</td>
												<td>'.$row["printedform1"].'</td>
												<td>'.$row["printedform2"].'</td>
													<td>'.$row["spform1"].'</td>
												<td>'.$row["spform2"].'</td>
													<td>'.$row["envsmall"].'</td>
												<td>'.$row["envlarge"].'</td>
													<td>'.$row["spenvsmall"].'</td>
												<td>'.$row["spenvlarge"].'</td>
												<td class="text-center">';
												
												
				if($GLOBALS['role']>0 && $GLOBALS['role']<3)
				{
					$data_row_item_formatted.= '<a class="btn btn-primary btn-md button_style_addon" href="#" onClick="Show_Edit_Usage('.$row["id"].');" style="border-radius: 5px;"><span class="glyphicon glyphicon-edit"></span> Edit</a> ';
				}
				if($GLOBALS['role']>0 && $GLOBALS['role']<2)
				{
					$data_row_item_formatted.= '<a href="#" class="btn btn-danger btn-md button_style_addon" style="border-radius: 5px;" onClick="Remove_Usage('.$row["id"].','.$row["usage_id"].');"><span class="glyphicon glyphicon-remove"></span> Del</a> ';
				}
				
				$data_row_item_formatted.= '	</td>
											</tr>
										   ';
										   
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
}


/** -Gavin Palmer || March 2016
*	@Discription:	Get the the Usage inline items from the inline item table and format the output for display
*	
*	@param (Integer) $id - The id numbere for the receival
*
*	@return (String) HTML formatted output
*/
function Get_Usage_line_items($id)
{
	//Create SQL string -Gavin Palmer || March 2016
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Gavin Palmer || March 2016
	
	
	//If the individual is searching for specific vendors  -Gavin Palmer || March 2016
	if(isset($id))
	{
		$sql="SELECT usage_lineitems.id, stocks.name, usage_lineitems.qty,usage_lineitems.reams, usage_lineitems.spoilage
			  FROM usage_lineitems
			  INNER JOIN stocks
			  ON usage_lineitems.stock_id=stocks.id
			  WHERE usage_lineitems.usage_id=".$id;
	}
					
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
				$data_row_item_formatted = '
											<tr id=\''.$row["id"].'\'>
												<td>'.$row["name"].'</td>
													<td>'.$row["reams"].'</td>
												<td>'.$row["qty"].'</td>
												<td>'.$row["spoilage"].'</td>
											</tr>
										   ';
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
}


/** -Gavin Palmer || March 2016
*	@Discription:	Remove the given recieval inline item from th receival inline item table
*	
*	@param (void)
*
*	@return (String) HTML formatted output
*/
function Remove_Receival_line_item()
{
	//Create SQL string -Gavin Palmer || March 2016
	$sql = "";
	
	
	//If the individual is searching for specific vendors  -Gavin Palmer || March 2016
	if(isset($_REQUEST["id"]))
	{
		$id = $_REQUEST["id"];
		$sql = "DELETE FROM rec_lineitems WHERE id=".$id;
		echo "[".$sql."]";
	}
	
					
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
							
		if ($conn->query($sql) === TRUE)
		{
			echo "Record deleted successfully";
		}
		else
		{
			echo "Error deleting record: " . $conn->error;
		}
		$conn->close();
	}
}


/** -Gavin Palmer || March 2016
*	@Discription:	Update the details of a receival and also its line items, allowing for the adding off new line items in the update
*	
*	@param (void)
*
*	@return (void)
*/
function Update_Recieval()
{

	//variables
	$sql = "";
	$ID = "";
	$Invoice_Number = "";
	$Recdate = "";
	
	$Inline_items = "";
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	
			
	//Checking for the presents of the required variables  -
	if(isset($_REQUEST["ID"]) && isset($_REQUEST["Invoice_Number"]) && isset($_REQUEST["Recdate"]) && isset($_REQUEST["Inline_items"]))
	{
		$ID = $_REQUEST["ID"]; 
		$Item_ID = $_REQUEST["Item_ID"]; 
		$Invoice_Number = $_REQUEST["Invoice_Number"];
		$Recdate = $_REQUEST["Recdate"];

		$Inline_items = $_REQUEST["Inline_items"];
		
	}
					
	// Create connection to database
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
			
			
			$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Gavin Palmer || March 2016
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				
				
			$id=$item_objects[$x]['Item_ID'];
			$type=$item_objects[$x]['Type'];
					//echo "[".$sql."]";	
					//echo $type;		
				
			}
			
			$sql3="SELECT * FROM rec_lineitems 
		WHERE receival_id=".$id;
		
		$result= $conn->query($sql3);
		
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				
                $type1=$row["items"];
				
			}
			
			
		}
		
			if(($type=="PAPER")&&($type1=="75gms"))
			{
				
				
											
		$sql ="SELECT * FROM price  WHERE item ='$type'";
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$price= $row["75gms"];
	
	
	}


	 			
			   	  


}		
			$sql2= "SELECT * FROM rec_lineitems
			WHERE id=".$ID;		
			$result = $conn->query($sql2);
				if ($result->num_rows > 0)
		{	
		
			
	
			while($row = $result->fetch_assoc())
			{
				
			 $sheetA=$row["qty"];
			 $packsA=$row["packs"];
			 $boxA=$row["boxs"];
			$idstock=$row["stock_id"];
		}
		}	
				
		$sql = "UPDATE receivals
				SET invoice_number=".$Invoice_Number.", recdate='".$Recdate."'
				WHERE id=".$id;
				
				echo $sql." Type: ".$type;
						
		if($conn->query($sql) === TRUE)
		{
			echo "New record created successfully".$idstock;
			
			//Update individual line items   -Gavin Palmer || March 2016
			//$id = mysqli_insert_id($conn); //Get the inserted ID for the Receival that was inserted above -Gavin Palmer || March 2016
			$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Gavin Palmer || March 2016
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				$sheetB=$item_objects[$x]['Quantitysheet'];
				$packsB=$item_objects[$x]['Quantitypack'];
				$boxB=$item_objects[$x]['Quantitybox'];
				//echo "Stock_ID: ".$item_objects[$x]['Stock_ID']."  small: ".$item_objects[$x]['Quantitybox']."  large: ".$item_objects[$x]['Quantitypack'];		
				//var_dump($item_objects[$x]);
			
				
						
						
						if($sheetB<=$sheetA)
						{
							
							$updatesheet=$sheetA-$sheetB;
							$cost=$updatesheet*$price;	
						
								$sql1 = "UPDATE stocks
						SET instock=instock-$updatesheet,single=single-$updatesheet,cost=cost-$cost
						WHERE id=".$idstock;
							
											$sql = "UPDATE rec_lineitems
						SET cost=cost-$cost,qty=".$item_objects[$x]['Quantitysheet'].", updated_at= '".$updated_at."'
						WHERE id=".$ID;
						
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated inline items successfully";
				}
				
						
								
						if($conn->query($sql) === TRUE)
				{
					echo "Updated Stock successfully";
					
					
					
					
					
					
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
					}
						else{
							
										$updatesheet=$sheetB-$sheetA;
									$cost=$updatesheet*$price;
								
						   $sql1 = "UPDATE stocks
						SET instock=instock+$updatesheet, single=single+$updatesheet, cost=cost+$cost
						WHERE id='$idstock'";
							
										$sql = "UPDATE rec_lineitems
						SET cost=cost+$cost, qty=".$item_objects[$x]['Quantitysheet'].", updated_at= '".$updated_at."'
						WHERE id=".$ID;
						
						if($conn->query($sql) === TRUE)
				{
					echo "Updated inline items successfully";
				}
				
						
								
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated Stock successfully";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
						}	//echo "[".$sql."]";
						
					
								if($packsB<=$packsA)
						{
							
							$updatepacks=$packsA-$packsB;
							$tpack=	$updatepacks*500;
							$cost=$tpack*$price;	
								$sql1 = "UPDATE stocks
						SET instock=instock-$tpack ,reams=reams-$updatepacks, cost=cost-$cost
						WHERE id=".$idstock;
							
						
													$sql = "UPDATE rec_lineitems
						SET cost=cost-$cost, packs=".$item_objects[$x]['Quantitypack'].", updated_at= '".$updated_at."'
						WHERE id=".$ID;
						
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated Stocks items successfully";
				}
					else
				{
					echo "Error while updating items: 	 ".$conn->error;
				}
				
								
						if($conn->query($sql) === TRUE)
				{
					echo "Updated Receivals successfully";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
					}
					
				if($packsB>=$packsA){
							
								$updatepacks=$packsB-$packsA;
							$tpack=	$updatepacks*500;
							$cost=$tpack*$price;	
								$sql = "UPDATE stocks
						SET instock=instock+$tpack ,reams=reams+$updatepacks, cost=cost+$cost
						WHERE id=".$idstock;
									
						$sql1 = "UPDATE rec_lineitems
						SET cost=cost+$cost, packs=".$item_objects[$x]['Quantitypack'].", updated_at= '".$updated_at."'
						WHERE id=".$ID;
						
						if($conn->query($sql) === TRUE)
				{
						echo "Updated Inventory99 Stocks items successfully";
					
				}
				
						
								
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated Receivals items successfully";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
						}	
						
						
								if($boxB<=$boxA)
						{
							
							$updatebox=$boxA-$boxB;
							$tbox=$updatebox*5000;
							$cost=$tbox*$price;	
								$sql1 = "UPDATE stocks
						SET instock=instock-$tbox  ,box=box-$updatebox,cost=cost-$cost
						WHERE id=".$idstock;
							
									
													$sql = "UPDATE rec_lineitems
						SET boxs=".$item_objects[$x]['Quantitybox'].",cost=cost-$cost, updated_at= '".$updated_at."'
						WHERE id=".$ID;
						
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated Stock successfully  $updatebox   $tbox   $cost   $price   ";
				}
				
						
								
						if($conn->query($sql) === TRUE)
				{
					echo "Updated Receivals successfully";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
					}
					
					else{
							
										$updatebox=$boxB-$boxA;
									$tbox=$updatebox*5000;
									$cost=$tbox*$price;
								$sql1 = "UPDATE stocks
						SET instock=instock+$tbox ,box=box+$updatebox,cost=cost+$cost
						WHERE id=".$idstock;
							
						
									
													$sql = "UPDATE rec_lineitems
						SET boxs=".$item_objects[$x]['Quantitybox'].",cost=cost+$cost, updated_at= '".$updated_at."'
						WHERE id=".$ID;
						
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated Inventory Stocks items successfully";
				}
				
								
						if($conn->query($sql) === TRUE)
				{
					echo "Updated Receivals successfully  $updatebox  $tbox   $cost   $price ";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
						}			
									
				
			}
			}


			//Store individual new line items   -Gavin Palmer || March 2016
			
				
	
			
		}


	if($type=="Envelope")
		
			{
				
						
				$sql2= "SELECT * FROM rec_lineitems
			WHERE id=".$ID;		
			$result = $conn->query($sql2);
				if ($result->num_rows > 0)
		{	
		
			
	
			while($row = $result->fetch_assoc())
			{
				
			 $smallA=$row["envsmall"];
			 $largeA=$row["envlarge"];
			$idstock=$row["stock_id"];
			$item=$row["items"];
		}
		}	
				
				
				
				
				
				$sql ="SELECT stocks.p1,stocks.papersize FROM stocks WHERE stocks.id ='$idstock'";
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$stype= $row['p1'];
		$size=$row['papersize'];
	//echo $stype;
	
	}
}	
				
				
					$sql ="SELECT * FROM price WHERE teritory ='$item'";
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
		$pricesmall= $row["envsmall"];
	   $pricelarge1=$row["9*12"];
	   $pricelarge2=$row["10*12"];
	   $pricelarge3=$row["12*15"];
	
	}


	 			
			   	  


}			
				
				
		$sql = "UPDATE receivals
				SET invoice_number=".$Invoice_Number.", recdate='".$Recdate."'
				WHERE id=".$id;
				
			echo $sql." Type: ".$type;
						
		if($conn->query($sql) === TRUE)
		{
			echo "New record created successfully";
			//echo $size;
			//Update individual line items   -Gavin Palmer || March 2016
			//$id = mysqli_insert_id($conn); //Get the inserted ID for the Receival that was inserted above -Gavin Palmer || March 2016
			$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Gavin Palmer || March 2016
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				
				
				
				
				$smallB=$item_objects[$x]['qtysmall'];
				$largeB=$item_objects[$x]['qtylarge'];
				
				//echo "Stock_ID: ".$item_objects[$x]['Stock_ID']."  small: ".$item_objects[$x]['Quantitybox']."  large: ".$item_objects[$x]['Quantitypack'];		
				//var_dump($item_objects[$x]);
			
				
				
				
				
					
						if($smallB<=$smallA)
						{
							
							$updateenv=$smallA-$smallB;
							$costsmall=$updateenv*$pricesmall;		
								$sql1 = "UPDATE stocks
						SET instock=instock-$updateenv ,small=small-$updateenv,costsmall=costsmall-$costsmall,cost=cost-$costsmall
						WHERE id=".$idstock;
							
						
						
								
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated Stock successfully";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
				
			$sql1 = "UPDATE rec_lineitems
						SET envsmall=$smallB,costsmall=costsmall-$costsmall,cost=cost-$costsmall, updated_at='".$updated_at."'
						WHERE id=".$ID;
					//echo "[".$sql."]";			
				if($conn->query($sql1) === TRUE)
				{
					echo "Updated inline items successfully";
				}
				else
				{
					echo "Error while updating receivals: ".$conn->error;
				}
				
				
				
				
				
					}
						
						
						
						
						else{
							
						  $updateenv=$smallB-$smallA;
							$costsmall=$updateenv*$pricesmall;
									
								$sql1 = "UPDATE stocks
						SET instock=instock+$updateenv ,small=small+$updateenv, costsmall=costsmall+$costsmall, cost=cost+$costsmall
						WHERE id=".$idstock;
							
				
						
								
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated Stock successfully";
					
		
					
					
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
				
						
			$sql1 = "UPDATE rec_lineitems
						SET envsmall=$smallB,costsmall=costsmall+$costsmall,cost=cost+$costsmall, updated_at='".$updated_at."'
						WHERE id=".$ID;
					//echo "[".$sql."]";			
				if($conn->query($sql1) === TRUE)
				{
					echo "Updated inline items successfully";
					echo $costsmall;
					
				}
				else
				{
					echo "Error while updating receivals: ".$conn->error;
				}
				
				
					
						}	//echo "[".$sql."]";
				
				
				
				if($largeB<=$largeA)
						{
							
							
							$updateenv=$largeA-$largeB;
								if ($size=="9*12"){
			
	$costlarge=$updateenv*$pricelarge1;	
	}
	if($size=="10*12"){
			
	$costlarge=$updateenv*$pricelarge2;		
	}
	if($size=="12*15"){
			
	$costlarge=$updateenv*$pricelarge3;	
	}
		
							
									
								$sql1 = "UPDATE stocks
						SET instock=instock-$updateenv ,large=large-$updateenv,costlarge=costlarge-$costlarge,cost=cost-$costlarge
						WHERE id=".$idstock;
							
						
						
								
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated Stock successfully";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
				
				
				
				
				//$totalcost=$costsmall+$costlarge;
	
					$sql1 = "UPDATE rec_lineitems
						SET envlarge=$largeB,costlarge=costlarge-$costlarge,cost=cost-$costlarge,updated_at='".$updated_at."'
						WHERE id=".$ID;
					//echo "[".$sql."]";			
				if($conn->query($sql1) === TRUE)
				{
					echo "Updated inline items successfully No";
		 
				}
				else
				{
					echo "Error while updating receivals: ".$conn->error;
				}
				
			
				
				
				
					}
						else{
							
										$updateenv=$largeB-$largeA;
	if ($size=="9*12"){
			
	$costlarge=$updateenv*$pricelarge1;	
	}
	if($size=="10*12"){
			
	$costlarge=$updateenv*$pricelarge2;		
	}
	if($size=="12*15"){
			
	$costlarge=$updateenv*$pricelarge3;	
	}
		
		//$totalcost1=							
									
									
								$sql1 = "UPDATE stocks
						SET instock=instock+$updateenv ,large=large+$updateenv,costlarge=costlarge+$costlarge, cost=cost+$costlarge
						WHERE id=".$idstock;
							
						
						
								
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated Stock successfully";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
				
				
				$totalcost=$costsmall+$costlarge;
	
					$sql1 = "UPDATE rec_lineitems
						SET envlarge=$largeB,costlarge=costlarge+$costlarge,cost=cost+$costlarge, updated_at='".$updated_at."'
						WHERE id=".$ID;
					//echo "[".$sql."]";			
				if($conn->query($sql1) === TRUE)
				{
					echo "Updated inline items successfully No";
					echo $costlarge;
				}
				else
				{
					echo "Error while updating receivals: ".$conn->error;
				}
				
			
						}	
						
						
						
						
						
						//echo "[".$sql."]";
							
			
			}
			}

			
					
	
			
		}

	
	if($type=="PrintedForm")
		
			{
				
					$sql2= "SELECT * FROM rec_lineitems
			WHERE id=".$ID;		
			$result = $conn->query($sql2);
				if ($result->num_rows > 0)
		{	
		
			
	
			while($row = $result->fetch_assoc())
			{
				
			 $printed1A=$row["printedform1"];
			  $printed2A=$row["printedform2"];
			$idstock=$row["stock_id"];
		}
		}	
				
					
				
				$sql = "UPDATE receivals
				SET invoice_number=".$Invoice_Number.", recdate='".$Recdate."'
				WHERE id=".$id;
				
			echo $sql." Type: ".$type;
						
		if($conn->query($sql) === TRUE)
		{
			echo "New record created successfully<br/><br/>";
			
			//Update individual line items   -Gavin Palmer || March 2016
			//$id = mysqli_insert_id($conn); //Get the inserted ID for the Receival that was inserted above -Gavin Palmer || March 2016
			$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Gavin Palmer || March 2016
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				
				
					
				$printed1B=$item_objects[$x]['qtysheet1'];
				$printed2B=$item_objects[$x]['qtysheet2'];
				
				
				//echo "Stock_ID: ".$item_objects[$x]['Stock_ID']."  small: ".$item_objects[$x]['Quantitybox']."  large: ".$item_objects[$x]['Quantitypack'];		
				//var_dump($item_objects[$x]);
				$sql1 = "UPDATE rec_lineitems
						SET printedform1=".$item_objects[$x]['qtysheet1'].", printedform2=".$item_objects[$x]['qtysheet2'].", updated_at= '".$updated_at."'
						WHERE id=".$ID;
					//echo "[".$sql."]";			
				if($conn->query($sql1) === TRUE)
				{
					echo "Updated inline items successfully";
				}
				else
				{
					echo "Error while inserting into database1: ".$conn->error;
				}
			
			
			
			
						if($printed1B<=$printed1A)
						{
							
							$updateform=$printed1A-$printed1B;
									
								$sql1 = "UPDATE stocks
						SET instock=instock-$updateform ,sheet1=sheet1-$updateform
						WHERE id=".$idstock;
							
						
						
								
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated Stock successfully";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
					}
						else{
							
										$updateform=$printed1B-$printed1A;
									
								$sql1 = "UPDATE stocks
						SET instock=instock+$updateform ,sheet1=sheet1+$updateform
						WHERE id=".$idstock;
							
						
						
								
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated Stock successfully";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
						}	//echo "[".$sql."]";
				
			
				if($printed2B<=$printed2A)
						{
							
							$updateform=$printed2A-$printed2B;
									
								$sql1 = "UPDATE stocks
						SET instock=instock-$updateform ,sheet2=sheet2-$updateform
						WHERE id=".$idstock;
							
						
						
								
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated Stock successfully";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
					}
						else{
							
										$updateform=$printed2B-$printed2A;
									
								$sql1 = "UPDATE stocks
						SET instock=instock+$updateform ,sheet2=sheet2+$updateform
						WHERE id=".$idstock;
							
						
						
								
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated Stock successfully";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
						}	
			
			
			
			}
			}

			//Store individual new line items   -Gavin Palmer || March 2016
			
				
	
			
		}
		
		
	}
	}
	



/** -Modified By Imani Sterling 2018
*	@Discription:	adds a Usage to the usage table and the coresponding line item in the usage line item table
*	
*	@param (void)
*
*	@return (void)
*/
function Add_Usage()  //This is where we add the usage request 
{
	//variables
	$sql = "";
	$Invoice_Number = "";
	$Usagedate = "";
	$Purpose = "";
	$Equipment = "";
	$Inline_items = "";
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	
			
	
	if(isset($_REQUEST["Invoice_Number"]) && isset($_REQUEST["Usagedate"]) && isset($_REQUEST["Purpose"]) && isset($_REQUEST["Equipment"]) && isset($_REQUEST["Inline_items"]))
	{
		$Invoice_Number = $_REQUEST["Invoice_Number"];
		$Usagedate = $_REQUEST["Usagedate"];
		$Purpose = $_REQUEST["Purpose"];
		$Equipment = $_REQUEST["Equipment"];
		$Inline_items = $_REQUEST["Inline_items"];
	   // $Insertqty= $_REQUEST["insertqty"];
	}
					
	// Create connection to database
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		$sql = "INSERT INTO usages(invoice_number, usagedate, purpose, equipment_id, created_at, updated_at)
			VALUES (".$Invoice_Number.", '".$Usagedate."', '".$Purpose."', ".$Equipment.", '".$created_at."', '".$updated_at."')";
						
		if($conn->query($sql) === TRUE)
		{
			echo "New record created successfully<br/><br/>";
			
			//Store individual line items   -Gavin Palmer || March 2016
			$id = mysqli_insert_id($conn); //Get the inserted ID for the Receival that was inserted above -Gavin Palmer || March 2016
			$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Gavin Palmer || March 2016
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				//echo "Stock_ID: ".$item_objects[$x]['Stock_ID']." and Quantity: ".$item_objects[$x]['Quantity'];
				//Set numberic field to 0 if emppty
			
			if($Equipment==7){
				$sql = "INSERT INTO usage_lineitems(usage_id, stock_id, qty,spoilage, created_at, equip)
					VALUES (".$id.", ".$item_objects[$x]['Stock_ID']." , ".$item_objects[$x]['Quantity1']." , ".$item_objects[$x]['Spoilage1']." , '".$created_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sql) === TRUE)
				{
					//Make adjustment the stock table -Gavin Palmer || March 2016
					$sql = "UPDATE stocks
							SET instock = instock - ".$item_objects[$x]['Quantity']."
							WHERE id=".$item_objects[$x]['Stock_ID'];
									
					if($conn->query($sql) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}
			}
			if($Equipment==8){
				
		
				
				
				
				if($item_objects[$x]['Type']=="PAPER"){
			  $type=$item_objects[$x]['Type']; 						
			  
			  
			  
			   	$sql ="SELECT stocks.p1 FROM stocks WHERE stocks.id =".$item_objects[$x]['Stock_ID'];
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$stype= $row['p1'];
	
	}
}	
	if($stype=="75gms"){		   				
		$sql ="SELECT * FROM price WHERE item ='$type'";
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$price= $row["75gms"];
	
	
	}}}
	
	if($stype=="80gms"){		   				
		$sql ="SELECT * FROM price WHERE item ='$type'";
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$price= $row["80gms"];
	
	
	}}}}
	
	
	
	
	
		            $qty=$item_objects[$x]['Quantity'];
						
				    $reams=$item_objects[$x]['Reams']*500;
				  	$tsheets=$qty+$reams;
			     	$cost=$tsheets*$price;			
				
				
				
				
				
				
				$sql = "INSERT INTO usage_lineitems(usage_id, cost,items,stock_id,pack, qty, spoilage, created_at, equip)
					VALUES (".$id.",".$cost.",'$stype', ".$item_objects[$x]['Stock_ID']." ,".$item_objects[$x]['Reams']." , ".$item_objects[$x]['Quantity']." , ".$item_objects[$x]['Spoilage']." , '".$created_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sql) === TRUE)
				
				{
						$qty=$item_objects[$x]['Quantity'];
						$ream=$item_objects[$x]['Reams'];
						$reams=$item_objects[$x]['Reams']*500;
					$tsheets=$qty+$reams;
					//Make adjustment the stock table -Gavin Palmer || March 2016
					$sql = "UPDATE stocks
							SET instock = instock - $tsheets,single=single-$qty,reams=reams-$ream,cost=cost-$cost
							WHERE id=".$item_objects[$x]['Stock_ID'];
									
					if($conn->query($sql) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}
			
	
			//This is for the inserter 
		
			

}	
//This is the sql to add to the envelope

		$sql ="SELECT stocks.p1,stocks.papersize FROM stocks WHERE stocks.id =".$item_objects[$x]['Stock_ID'];
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$stype= $row['p1'];
		$size=$row['papersize'];
	//echo $stype;
	
	}
}
	if(($Equipment==9)&& ($stype=="Turks")){
			
					$sql1 ="SELECT * FROM price WHERE teritory ='$stype'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$pricesmall= $row["envsmall"];
	$pricelarge= $row["10*12"];
	
	
	}	
						// Make adjustment the stock table in
				$envsmall=$item_objects[$x]['envQuantity1'];
				$envlarge=$item_objects[$x]['envQuantity2'];
				$totalenv=$envsmall+$envlarge;
				
				
			   	$costsmall=$envsmall*$pricesmall;
			   	$costlarge=$envlarge*$pricelarge;
               $totalcostenv=$costsmall+$costlarge;
			 
				
				
		
				$sql = "INSERT INTO usage_lineitems(usage_id,stock_id,costsmall,costlarge,cost,items,envsmall,envlarge,spenvlarge,spenvsmall,created_at,equip)
					VALUES (".$id.", ".$item_objects[$x]['Stock_ID'].",'$costsmall','$costlarge','$totalcostenv','$stype',".$item_objects[$x]['envQuantity1']." , ".$item_objects[$x]['envQuantity2'].",".$item_objects[$x]['envspoilage1'].",".$item_objects[$x]['envspoilage2'].",'".$created_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sql) === TRUE)
				{
			
					// this update stock envelope quantity: 
					
					$sql = "UPDATE stocks
							SET small = small - $envsmall, large= large-$envlarge,costsmall=costsmall-$costsmall,costlarge=costlarge-$costlarge, cost=cost-$totalcostenv, instock=instock-$totalenv
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
					
					//$sql1 = "UPDATE stocks
							///SET large = large - ".$item_objects[$x]['envQuantity2']."
					      //  WHERE id=".$item_objects[$x]['Stock_ID'];				
					
					
					if($conn->query($sql) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
					
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}
				
			}
			}







			if($Equipment==11){
				$sql = "INSERT INTO usage_lineitems(usage_id,stock_id,printedform1,printedform2,spform1,spform2,created_at,equip)
					VALUES (".$id.", ".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['qtysheet1']." , ".$item_objects[$x]['qtysheet2'].",".$item_objects[$x]['sheet1'].",".$item_objects[$x]['sheet2'].",'".$created_at."', '".$item_objects[$x]['Type']."')";
				//echo "[".$sql."]";				
				if($conn->query($sql) === TRUE)
				{
					// Make adjustment the stock table in
					
					// this update stock envelope quantity: 
					$sheet1=$item_objects[$x]['qtysheet1'];
					$sheet2=$item_objects[$x]['qtysheet2'];
					$tsheet=$sheet1+$sheet2;
					$sql = "UPDATE stocks
							SET sheet1 = sheet1 - $sheet1,sheet2= sheet2-$sheet2,instock=instock-$tsheet
					        WHERE id=".$item_objects[$x]['Stock_ID'];
					
					
					// this update stock envelope spoilage:
								
					
					
					if($conn->query($sql) === TRUE)
					{
					
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
					
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}
			}
		
			
		}

}
	
		
		$conn->close();
	}



}



/** -Gavin Palmer || March 2016
*	@Discription:	Remove the given usage from the usage table along with its line items
*	
*	@param (void)
*
*	@return (void)
*/
function Remove_Usage()
{
	//Create SQL string -Gavin Palmer || March 2016
	$sql = "";
	
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	//Get the id of the usage being deleted  -Gavin Palmer || March 2016
	if(isset($_REQUEST["id"]))
	{
		$id = $_REQUEST["id"];
		$sql3="SELECT * FROM usage_lineitems 
		WHERE usage_id=".$id;
		
		$result= $conn->query($sql3);
		
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				$equip=$row["equip"];

				
			}
		}
	
	if($equip=="PAPER"){
				
				
				$id = $_REQUEST["id"];
		$sql3="SELECT * FROM usage_lineitems 
		WHERE usage_id=".$id;
		
		$result= $conn->query($sql3);
				
			if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				//$id=$row["id"];
				$equip=$row["equip"];
				$stockid=$row["stock_id"];
				$sheet=$row["qty"];
				$cost=$row["cost"];
			
				$ream=$row["pack"];
				$tdelete=$ream*500+$sheet;
				}	
				
				$sql2 = "UPDATE stocks
							SET instock = instock + $tdelete,single=single+$sheet,reams=reams+$ream,cost=cost+$cost
					        WHERE id=$stockid";
			
				
			}
			
				if ($conn->query($sql2) === TRUE)
			{
				echo "Usage deleted from successfully";
			}
			else
			{
				echo "Error deleting Inventory record:   $sql2" . $conn->error;
			}
			
			
		}
	
	
	
	if($equip=="Envelope"){
				
				
				$id = $_REQUEST["id"];
		$sql3="SELECT * FROM usage_lineitems 
		WHERE usage_id=".$id;
		
		$result= $conn->query($sql3);
				
			if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				//$id=$row["id"];
				$envsmall=$row["envsmall"];
				$envlarge=$row["envlarge"];
			    
				$envtotal=$envsmall+$envlarge;
				$stockid=$row["stock_id"];
				$cost=$row["cost"];
				}	
				
				$sql2 = "UPDATE stocks
							SET instock = instock + $envtotal,small=small+$envsmall,large=large+$envlarge,cost=cost+$cost
					        WHERE id=$stockid";
			
				
			}
			
				if ($conn->query($sql2) === TRUE)
			{
				echo "Usage deleted from successfully";
			}
			else
			{
				echo "Error deleting Inventory record:   $sql2" . $conn->error;
			}
			
			
		}
	
	
		if($equip=="PrintedForm"){
				
				
				$id = $_REQUEST["id"];
		$sql3="SELECT * FROM usage_lineitems 
		WHERE usage_id=".$id;
		
		$result= $conn->query($sql3);
				
			if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				//$id=$row["id"];
				$sheet1=$row["printedform1"];
				$sheet2=$row["printedform2"];
			
				$totalsheet=$sheet1+$sheet2;
				$stockid=$row["stock_id"];
				}	
				
				$sql2 = "UPDATE stocks
							SET instock = instock + $totalsheet,sheet1=sheet1+$sheet1,sheet2=sheet2+$sheet2
					        WHERE id=$stockid";
			
				
			}
			
				if ($conn->query($sql2) === TRUE)
			{
				echo "Usage deleted  successfully";
			}
			else
			{
				echo "Error deleting Inventory record:   $sql2" . $conn->error;
			}
			
			
		}
	
	
	
	
	
	
	$sql = "DELETE FROM usage_lineitems WHERE usage_id=".$id;
	
	}
	
					
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
						
		if ($conn->query($sql) === TRUE)
		{
			echo "Record deleted successfully";
			
			//finally delete Receival
			$sql = "DELETE FROM usages WHERE id=".$id;
			
			if ($conn->query($sql) === TRUE)
			{
				echo "Record deleted successfully";
			}
			else
			{
				echo "Error deleting record: " . $conn->error;
			}
			
		}
		else
		{
			echo "Error deleting record: " . $conn->error;
		}
		$conn->close();
	}
}


/** 
*	
*	
*	@param (void)
*
*	@return (String) JSON ended formatted output
*/
function Basic_Usage_info()
{
	
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Gavin Palmer || March 2016
	
	

	if(isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
		
		 
			$sql="SELECT usages.*, usage_lineitems.*
		    FROM usages
			INNER JOIN usage_lineitems
			ON usages.id=usage_lineitems.usage_id
		    WHERE usage_lineitems.id=".$id;
			
			
			
	}

					
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
				$json_encoded_out = array('ID' => $row["id"], 'Invoice_Number' => $row["invoice_number"], 'Usagedate' => ''.$row["usagedate"].'', 'Purpose' => ''.$row["purpose"].'', 'Equipment' => ''.$row["equipment_id"].'');
				$json_encoded_out = json_encode($json_encoded_out);
				
				$formatted_result=$json_encoded_out;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
}




/** -Gavin Palmer || March 2016
*	@Discription:	Get the the usage inline items from the inline item table and format the output for JSON
*	
*	@param (Integer) $id - The id numbere for the receival
*
*	@return (String) JSON formatted output
*/
function Get_Usage_line_items_JSON()
{
	//Create SQL string -Gavin Palmer || March 2016
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Gavin Palmer || March 2016
	
	
	//If the individual is searching for specific vendors  -Gavin Palmer || March 2016
	if(isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
	
		
	  $sql = "SELECT usages.*, usage_lineitems.*,stocks.*
		    FROM usages
			INNER JOIN usage_lineitems 
			ON usages.id=usage_lineitems.usage_id LEFT JOIN stocks ON usage_lineitems.stock_id=stocks.id
			WHERE usage_lineitems.id=".$id;
	}
					
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
			$line_items = array();
			
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				//$reams=$row["reams"];
				$line_item = array('id' => $row["id"], 'stock_id' => $row["stock_id"],'pack' => $row["pack"], 'name' => ''.$row["name"].'', 'qty' => $row["qty"], 'spoilage' => $row["spoilage"], 'equip' => $row["equip"], 'envsmall' => $row["envsmall"], 'envlarge' => $row["envlarge"], 'spenvsmall' => $row["spenvsmall"], 'spenvlarge' => $row["spenvlarge"], 'printedform1' => $row["printedform1"], 'printedform2' => $row["printedform2"], 'spform1' => $row["spform1"], 'spform2' => $row["spform2"], 'usage_id' => $row["usage_id"]);
				
				array_push($line_items, $line_item);
			}
			$json_encoded_out = json_encode($line_items);
			$formatted_result=$json_encoded_out;
			$conn->close();
		}
		else
		{
			$conn->close();
		}
	}

	return $formatted_result;
}



/** -Gavin Palmer || March 2016
*	@Discription:	Remove the given usage inline item from th usage inline item table
*	
*	@param (void)
*
*	@return (void)
*/
function Remove_Usage_line_item()
{
	//Create SQL string -Gavin Palmer || March 2016
	$sql = "";
	
	
	//If the individual is searching for specific vendors  -Gavin Palmer || March 2016
	if(isset($_REQUEST["id"]))
	{
		$id = $_REQUEST["id"];
		$sql = "DELETE FROM usage_lineitems WHERE id=".$id;
		//echo "[".$sql."]";
	}
	
					
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
						
		if ($conn->query($sql) === TRUE)
		{
			echo "Record deleted successfully";
		}
		else
		{
			echo "Error deleting record: " . $conn->error;
		}
		$conn->close();
	}
}


/** -Gavin Palmer || March 2016
*	@Discription:	Update the details of a usage and also its line items, allowing for the adding off new line items in the update
*	
*	@param (void)
*
*	@return (void)
*/
function Update_Usage()
{
	//variables
	$sql = "";
	$ID = "";
	$Invoice_Number = "";
	$Usagedate = "";
	$Equipment = "";
	$Purpose = "";
	$Inline_items = "";
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	
			
	//Checking for the presents of the required variables  -Gavin Palmer || March 2016
	if(isset($_REQUEST["ID"]) && isset($_REQUEST["Invoice_Number"]) && isset($_REQUEST["Usagedate"]) && isset($_REQUEST["Purpose"]) && isset($_REQUEST["Equipment"]) && isset($_REQUEST["Inline_items"]) && isset($_REQUEST["new_Inline_items"]))
	{
		$ID = $_REQUEST["ID"]; 
		$Item_ID = $_REQUEST["Item_ID"]; 
		$Invoice_Number = $_REQUEST["Invoice_Number"];
		$Usagedate = $_REQUEST["Usagedate"];
		$Purpose = $_REQUEST["Purpose"];
		$Equipment = $_REQUEST["Equipment"];
		$Inline_items = $_REQUEST["Inline_items"];
		$new_Inline_items = $_REQUEST["new_Inline_items"];
	}
					
	// Create connection to database
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
			
			$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Gavin Palmer || March 2016
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				
				
			$id=$item_objects[$x]['Item_ID'];
			$type=$item_objects[$x]['Type'];
			$stock_id=$item_objects[$x]['Stock_ID'];
					//echo "[".$sql."]";			
			}
	
			if($Equipment==9)
		
			{
										
								
				$sql ="SELECT stocks.p1,stocks.papersize FROM stocks WHERE stocks.id ='$stock_id'";
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$stype= $row['p1'];
		$size=$row['papersize'];
	//echo $stype;
	
	}
}	
						
			$sql2= "SELECT * FROM usage_lineitems
			WHERE id=".$ID;		
			$result = $conn->query($sql2);
				if ($result->num_rows > 0)
		{	
		
			
	
			while($row = $result->fetch_assoc())
			{
				
			 $envsmallA=$row["envsmall"];
			 $envlargeA=$row["envlarge"];
			 
			 
			 $spenvsmallA=$row["spenvsmall"];
			 $spenvlargeA=$row["spenvlarge"];
			$idstock=$row["stock_id"];
			$item=$row["items"];
			
			
		}
		}
			
							$sql ="SELECT * FROM price WHERE teritory ='$item'";
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
		$pricesmall= $row["envsmall"];
	   $pricelarge1=$row["9*12"];
	   $pricelarge2=$row["10*12"];
	   $pricelarge3=$row["12*15"];
	
	}


	 			
			   	  


}
			
			
			
						
				$sql1 = "UPDATE usages
				SET invoice_number=".$Invoice_Number.", usagedate='".$Usagedate."', purpose='".$Purpose."', equipment_id=".$Equipment."
				WHERE id=".$id;
				
				//echo $sql1;
						
		if($conn->query($sql1) === TRUE)
		{
		//	echo "ok";
		}	
			//Update individual line items   -Gavin Palmer || March 2016
			//$id = mysqli_insert_id($conn); //Get the inserted ID for the Receival that was inserted above -Gavin Palmer || March 2016
		
		$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Gavin Palmer || March 2016
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 1; $x < $number_of_inline_items; $x++)
			{		
				$envsmallB=$item_objects[$x]['qtysmall'];
				$envlargeB=$item_objects[$x]['qtylarge'];
			 
				$spenvsmallB=$item_objects[$x]['small'];
			    $spenvlargeB=$item_objects[$x]['large'];
				
				//echo "Stock_ID: ".$item_objects[$x]['Stock_ID']."  small: ".$item_objects[$x]['small']."  large: ".$item_objects[$x]['large'];		
				//var_dump($item_objects[$x]);
				
				
				if($envsmallB<=$envsmallA)
						{
							
					 $small=$envsmallA-$envsmallB;
					$costsmall=$small*$pricesmall;
					
					
									
					    $sql1 = "UPDATE stocks
						SET instock=instock+$small,small=small+$small,costsmall=costsmall+$costsmall, cost=cost+$costsmall
						WHERE id=".$idstock;
						
						
						$sql = "UPDATE usage_lineitems
						SET stock_id=".$item_objects[$x]['Stock_ID'].",cost=cost-$costsmall,costsmall=costsmall-$costsmall, envsmall=".$item_objects[$x]['qtysmall'].",spenvsmall=".$item_objects[$x]['small'].",spenvlarge=".$item_objects[$x]['large'].", updated_at= '".$updated_at."'
						WHERE id=".$ID;
					
				//echo "[".$sql."]";			
				if($conn->query($sql) === TRUE)
				{
					echo "Updated usage:    $small   $costsmall  ";
				
				}
						
						
							
						
				if($conn->query($sql1) === TRUE)
				{
					echo "Updated  stock   $small   $costsmall";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
					}
						else{
							
										$small=$envsmallB-$envsmallA;
							            $costsmall=$small*$pricesmall;
									
								$sql1 = "UPDATE stocks
						SET instock=instock-$small, small=small-$small,costsmall=costsmall-$costsmall, cost=cost-$costsmall
						WHERE id=".$idstock;
							
									$sql = "UPDATE usage_lineitems
						SET stock_id=".$item_objects[$x]['Stock_ID'].",cost=cost+$costsmall,costsmall=costsmall+$costsmall, envsmall=".$item_objects[$x]['qtysmall'].",spenvsmall=".$item_objects[$x]['small'].",spenvlarge=".$item_objects[$x]['large'].", updated_at= '".$updated_at."'
						WHERE id=".$ID;
					//echo "[".$sql."]";			
				
				if($conn->query($sql1) === TRUE)
				{
					echo "Updated inline items successfully:    $updateenv   $costsmall    $pricesmall  $sql1  ";
				
				}
					
						
								
						if($conn->query($sql) === TRUE)
				{
					//echo "Updated envelope add successfully    $sql";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
						}	
			
		

//this is for enevlope large usage

if($envlargeB<=$envlargeA)
						{
							
							$updateenv=$envlargeA-$envlargeB;
						 
	if ($size=="9*12"){
			
	$costlarge=$updateenv*$pricelarge1;	
	}
	if($size=="10*12"){
			
	$costlarge=$updateenv*$pricelarge2;		
	}
	if($size=="12*15"){
			
	$costlarge=$updateenv*$pricelarge3;	
	}
		
					
	$sql1 = "UPDATE stocks
	SET instock=instock+$updateenv,large=large+$updateenv, costlarge=costlarge+$costlarge,cost=cost+$costlarge
	WHERE id=".$idstock;
	
	
	$sql = "UPDATE usage_lineitems
		SET stock_id=".$item_objects[$x]['Stock_ID'].",cost=cost-$costlarge,costlarge=costlarge-$costlarge, envlarge=".$item_objects[$x]['qtylarge'].",spenvsmall=".$item_objects[$x]['small'].",spenvlarge=".$item_objects[$x]['large'].", updated_at= '".$updated_at."'
		WHERE id=".$ID;
					//echo "[".$sql."]";			
				
				if($conn->query($sql1) === TRUE)
				{
					echo "Updated inline items successfully:    $updateenv   $costlarge    $priceslarge   $sql1 ";
				
				}
									
						if($conn->query($sql) === TRUE)
				{
					echo "Updated large successfully ";
				}
				else
				{
					echo "Error while updating stock ".$conn->error;
				}
					}
						else{
							
										$updateenv=$envlargeB-$envlargeA;
							
							
							
							if ($size=="9*12"){
			
	$costlarge=$updateenv*$pricelarge1;	
	}
	if($size=="10*12"){
			
	$costlarge=$updateenv*$pricelarge2;		
	}
	if($size=="12*15"){
			
	$costlarge=$updateenv*$pricelarge3;	
	}
		
							
							
							
							
							
							
						$sql1 = "UPDATE stocks
						SET instock=instock-$updateenv, large=large-$updateenv,costlarge=costlarge-$costlarge,cost=cost-$costlarge
						WHERE id=".$idstock;
							
			
	$sql = "UPDATE usage_lineitems
		SET stock_id=".$item_objects[$x]['Stock_ID'].",cost=cost+$costlarge,costlarge=costlarge+$costlarge, envlarge=".$item_objects[$x]['qtylarge'].",spenvsmall=".$item_objects[$x]['small'].",spenvlarge=".$item_objects[$x]['large'].", updated_at= '".$updated_at."'
		WHERE id=".$ID;
					//echo "[".$sql."]";			
				
				if($conn->query($sql1) === TRUE)
				{
					echo "Updated inline items successfully:    $updateenv   $costlarge    $pricelarge  ";
				
				}
						
								
						if($conn->query($sql) === TRUE)
				{
					echo "Updated Stock successfully";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
						}



}
			//Store individual new line items   -Gavin Palmer || March 2016
			
			}		
	
			
		
	
		
		

			if($Equipment==8)
		
			{
			$sql2= "SELECT * FROM usage_lineitems
			WHERE id=".$ID;		
			$result = $conn->query($sql2);
				if ($result->num_rows > 0)
		{	
		
			
	
			while($row = $result->fetch_assoc())
			{
				
			
			
			$type1=$row["items"];
			
		}
		}		
			
			
			if($type1=="75gms"){
					
			
				$sql ="SELECT * FROM price WHERE item  = '$type'";
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$price= $row["75gms"];
	
	
	}


	 			
			   	  


}
			}		
			
			
		if($type1=="80gms"){
			
			$sql ="SELECT * FROM price WHERE item  = '$type'";
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$price= $row["80gms"];
	
	
	}


	 			
			   	  


}
			}		
				
					$sql2= "SELECT * FROM usage_lineitems
			WHERE id=".$ID;		
			$result = $conn->query($sql2);
				if ($result->num_rows > 0)
		{	
		
			
	
			while($row = $result->fetch_assoc())
			{
				
				 $reamsA=$row["pack"];
			 $sheetA=$row["qty"];
			 $spoilA=$row["spoilage"];
			 $idstock=$row["stock_id"];
			
		}
		}
			
						
				$sql1 = "UPDATE usages
				SET invoice_number=".$Invoice_Number.", usagedate='".$Usagedate."', purpose='".$Purpose."', equipment_id=".$Equipment."
				WHERE id=".$id;
				
				echo $sql1;
						
		if($conn->query($sql1) === TRUE)
		{
			echo "New record created successfully<br/><br/>";
			
			//Update individual line items   -Gavin Palmer || March 2016
			//$id = mysqli_insert_id($conn); //Get the inserted ID for the Receival that was inserted above -Gavin Palmer || March 2016
			$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Gavin Palmer || March 2016
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x =0; $x < $number_of_inline_items; $x++)
			{
				
				
					$reamsB=$item_objects[$x]['Reams'];
				$sheetB=$item_objects[$x]['Quantity'];
			 
				$spoilB=$item_objects[$x]['Spoilage'];
				
				//echo "Stock_ID: ".$item_objects[$x]['Stock_ID']."  small: ".$item_objects[$x]['small']."  large: ".$item_objects[$x]['large'];		
				//var_dump($item_objects[$x]);
			
				
			if($reamsB<=$reamsA)
						{
							
						$updatesheet=$reamsA-$reamsB;
							$updatesheet1=$updatesheet*500;	
							$cost=$updatesheet1*$price;		
					
					$sql1 = "UPDATE stocks
						SET instock=instock+$updatesheet1,reams=reams+$updatesheet,cost=cost+$cost
						WHERE id=".$idstock;
						
						
						
								$sql = "UPDATE usage_lineitems
						SET stock_id=".$item_objects[$x]['Stock_ID'].", pack=".$item_objects[$x]['Reams'].",cost=cost-$cost, spoilage=".$item_objects[$x]['Spoilage'].", updated_at= '".$updated_at."'
						WHERE id=".$ID;
					//echo "[".$sql."]";			
				if($conn->query($sql) === TRUE)
				{
					echo "Updated inline items successfully:   $reamsA $reamsB   $updatesheet $cost   $price    $type    $updatesheet1   $type1";
				
				}
							
						
				if($conn->query($sql1) === TRUE)
				{
				echo "Updated Reams substract successfully";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
					}
						else{
							
										$updatesheet=$reamsB-$reamsA;
							    $updatesheet1=$updatesheet*500;	
								$cost=$updatesheet1*$price;	
								
								
								$sql1 = "UPDATE stocks
						SET instock=instock-$updatesheet1, reams=reams-$updatesheet, cost=cost-$cost
						WHERE id=".$idstock;
							
								
								$sql = "UPDATE usage_lineitems
						SET stock_id=".$item_objects[$x]['Stock_ID'].", pack=".$item_objects[$x]['Reams'].", cost=cost+$cost, spoilage=".$item_objects[$x]['Spoilage'].", updated_at= '".$updated_at."'
						WHERE id=".$ID;
					//echo "[".$sql."]";			
				if($conn->query($sql) === TRUE)
				{
					echo "Updated Reams successfully:   $reamsA $reamsB   $updatesheet $cost   $price    $type    $updatesheet1   $type1";
				
				}
					
						
								
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated envelope add successfully";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
						}	
			
			

//this is for enevlope large usage
		
	
if($sheetB<=$sheetA)
						{
							
							$updatesingle=$sheetA-$sheetB;
							$cost=$updatesingle*$price;	
					
								$sql1 = "UPDATE stocks
						SET instock=instock+$updatesingle,single=single+$updatesingle,cost=cost+$cost
						WHERE id=".$idstock;
						
										$sql = "UPDATE usage_lineitems
						SET stock_id=".$item_objects[$x]['Stock_ID'].",cost=cost-$cost,qty=".$item_objects[$x]['Quantity'].", spoilage=".$item_objects[$x]['Spoilage'].", updated_at= '".$updated_at."'
						WHERE id=".$ID;
					//echo "[".$sql."]";			
				if($conn->query($sql) === TRUE)
				{
				echo "Updated Sheet successfully:   $sheetA $sheetB   $updatesingle $cost   $price    $type      $type1";
				
				
				}
					
						
						
						
								
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated large successfully";
				}
				else
				{
					echo "Error while updating stock ".$conn->error;
				}
					}
						else{
							
										$updatesheet=$sheetB-$sheetA;
							            $cost=$updatesheet*$price;	
									
								$sql1 = "UPDATE stocks
						SET instock=instock-$updatesheet, single=single-$updatesheet,cost=cost-$cost
						WHERE id=".$idstock;
							
							$sql = "UPDATE usage_lineitems
						SET stock_id=".$item_objects[$x]['Stock_ID'].",cost=cost+$cost,qty=".$item_objects[$x]['Quantity'].", spoilage=".$item_objects[$x]['Spoilage'].", updated_at= '".$updated_at."'
						WHERE id=".$ID;
					//echo "[".$sql."]";			
				if($conn->query($sql) === TRUE)
				{
						echo "Updated Sheet successfully:   $sheetA $sheetB   $updatesheet $cost   $price    $type      $type1";
				
				}
						
							
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated Stock successfully";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
					}	
}	



			//Store individual new line items   -Gavin Palmer || March 2016
			}	
				
	
			
		}
		
		
			if($Equipment==11)
		
			{
				
				
								$sql2= "SELECT * FROM usage_lineitems
			WHERE id=".$ID;		
			$result = $conn->query($sql2);
				if ($result->num_rows > 0)
		{	
		
			
	
			while($row = $result->fetch_assoc())
			{
				
				 $sheet1A=$row["printedform1"];
			 $sheet2A=$row["printedform2"];
			 $spoil1A=$row["spform1"];
			  $spoil2A=$row["spform2"];
			 $idstock=$row["stock_id"];
			
		}
		}
			
				
				$sql1 = "UPDATE usages
				SET invoice_number=".$Invoice_Number.", usagedate='".$Usagedate."', purpose='".$Purpose."', equipment_id=".$Equipment."
				WHERE id=".$id;
				
				echo $sql1;
						
		if($conn->query($sql1) === TRUE)
		{
			echo "New record created successfully<br/><br/>";
			
			
			$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Gavin Palmer || March 2016
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 2; $x < $number_of_inline_items; $x++)
			{
				
				
					
					$sheet1B=$item_objects[$x]['qtysheet1'];
					$sheet2B=$item_objects[$x]['qtysheet2'];
			 
				$spoil1B=$item_objects[$x]['sheet1'];
				$spoil2B=$item_objects[$x]['sheet2'];
				
				
			
				$sql1 = "UPDATE usage_lineitems
						SET stock_id=".$item_objects[$x]['Stock_ID'].", printedform1=".$item_objects[$x]['qtysheet1'].", printedform2=".$item_objects[$x]['qtysheet2'].",spform1=".$item_objects[$x]['sheet1'].",spform2=".$item_objects[$x]['sheet2'].", updated_at= '".$updated_at."'
						WHERE id=".$ID;
					//echo "[".$sql."]";			
				if($conn->query($sql1) === TRUE)
				{
					echo "Updated Printed Form inline items successfully   $x";
				}
				else
				{
					echo "Error while inserting into database1: ".$conn->error;
				}
				
				
			if($sheet1B<=$sheet1A)
						{
							
						$updatesheet1=$sheet1A-$sheet1B;
							
									
					$sql1 = "UPDATE stocks
						SET instock=instock+$updatesheet1,sheet1=sheet1+$updatesheet1
						WHERE id=".$idstock;
							
						
				if($conn->query($sql1) === TRUE)
				{
				echo "Updated Add Printed form successfully";
				}
				else
				{
					echo "Error while updating stock: Printed Form 	 ".$conn->error;
				}
					}
						else{
							
										$updatesheet1=$sheet1B-$sheet1A;
							   
									
								$sql1 = "UPDATE stocks
						SET instock=instock-$updatesheet1, sheet1=sheet1-$updatesheet1
						WHERE id=".$idstock;
							
						
						
								
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated envelope add successfully";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
						}	
				
				
					
			if($sheet2B<=$sheet2A)
						{
							
						$updatesheet2=$sheet2A-$sheet2B;
							
									
					$sql1 = "UPDATE stocks
						SET instock=instock+$updatesheet2,sheet2=sheet2+$updatesheet2
						WHERE id=".$idstock;
							
						
				if($conn->query($sql1) === TRUE)
				{
				echo "Updated Add Printed form 2 successfully";
				}
				else
				{
					echo "Error while updating stock: Printed Form 2 ".$conn->error;
				}
					}
						else{
							
										$updatesheet2=$sheet2B-$sheet2A;
							   
									
								$sql1 = "UPDATE stocks
						SET instock=instock-$updatesheet2, sheet2=sheet2-$updatesheet1
						WHERE id=".$idstock;
							
						
						
								
						if($conn->query($sql1) === TRUE)
				{
					echo "Updated envelope add successfully";
				}
				else
				{
					echo "Error while updating stock: 	 ".$conn->error;
				}
						}	
				
				
				
				
				
				
				
				
				
				
			}
			}

			//Store individual new line items   -Gavin Palmer || March 2016
			
				
	
			
		}
	
		
		$conn->close();
	}
	
	}



function CreateStock()
{
	//variables
	$sql = "";
	$BOX = "";
	$Reams = "";
	$Singles = "";
	$Type ="";
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	
			
	//Checking for the presents of the required variables  -Gavin Palmer || March 2016
	if(isset($_POST["type"]))
	{
		$box = $_POST["box"]; 
		$reams = $_POST["reams"]; 
		$singles = $_POST["singles"];
		$name = $_POST["name"];

	}
	
/*	$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name =  "ssjlinve_inventorysystem";*/
					
	// Create connection to database
	//$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
									
	$tbox=5000*$box+$reams+$singles;
	$sql ="SELECT * FROM fields WHERE name=".$type;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$fieldid= $row["id"];

   $updated_at = date("Y-m-d h:i:s");
	
	$sql = "INSERT INTO stocks(field_id,name,instock,created_at)
	VALUES ('$fieldid', '$name','$tbox','$updated_at')";
echo $sql;
if ($conn->query($sql) === TRUE) {
   $mess="New record created successfully";
	return $mess;
   

  
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	
	
	}
} else {
    echo "0 results";
}
	


	
			

	

		
	
		
		$conn->close();
	
	
	}










/** -Gavin Palmer || March 2016
*	@Discription:	Requets from the server the default formated infromation in the Inventory table
*	
*	@param none
*
*	@return (String) HTML formatted table containing the results of the receival table
*/
function Generate_Inventory_table()
{  
	//Create SQL string -Gavin Palmer || March 2016
	$sql = "SELECT stocks.id, fields.name as type, stocks.name, stocks.p1, stocks.p2, stocks.p3, stocks.small,stocks.large,stocks.papersize,stocks.sheet1,stocks.sheet2, stocks.instock, stocks.reorderlevel, stocks.cost
		    FROM stocks
			INNER JOIN fields
			ON stocks.field_id=fields.id";

	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Gavin Palmer || March 2016
	
	
	//If the individual is searching for specific vendors  -Gavin Palmer || March 2016
	if(isset($_REQUEST["search_value"]))
	{
		$search_value=$_REQUEST["search_value"];
		$sql=$sql." WHERE stocks.name LIKE '".$search_value."%'";
	}
	
	/*if(isset($_REQUEST["search_start_date"]) && isset($_REQUEST["search_end_date"]))
	{
		if(($_REQUEST["search_start_date"]!="") && ($_REQUEST["search_end_date"]!=""))
		{
			$sql=$sql." and usagedate BETWEEN '".$_REQUEST["search_start_date"]."' and '".$_REQUEST["search_end_date"]."'";
		}
	}*/
	
	$sql=$sql." ORDER BY stocks.id DESC";
	
	//echo "[".$sql."]";
					
					
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
		//echo $sql;		
		$result = $conn->query($sql);
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				$data_row_item_formatted = '
											<tr id="Listing_row_'.$row["id"].'">
												<td>'.$row["id"].'</td>
												<td>'.$row["type"].'</td>
												<td>'.$row["name"].'</td>
												<td>'.$row["p1"].'</td>
												<td>'.$row["small"].'</td>
												<td>'.$row["large"].' '.$row["papersize"].'</td>
												<td>'.$row["sheet1"].'</td>
												<td>'.$row["sheet2"].'</td>
												<td>'.$row["instock"].'</td>
												<td>'.$row["reorderlevel"].'</td>
												<td>'.'$'.$row["cost"].'</td>
											
											
												<td class="text-center">';
												
												
				if($GLOBALS['role']>0 && $GLOBALS['role']<2)
				{								
					$data_row_item_formatted.= '<a href="#" class="btn btn-danger btn-md button_style_addon" style="border-radius: 5px;" onClick="Remove_Usage('.$row["id"].');"><span class="glyphicon glyphicon-remove"></span> Del</a> ';
				}
				
				$data_row_item_formatted.= '	</td>
											</tr>
										   ';
										   
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
}



/** -Gavin Palmer || March 2016
*	@Discription:	Remove the given stock itm from the stocks
*	
*	@param (void)
*
*	@return (void)
*/
function Remove_Stock()
{
	//Create SQL string -Gavin Palmer || March 2016
	$sql = "";
	
	
	//Get the id of the usage being deleted  -Gavin Palmer || March 2016
	if(isset($_REQUEST["id"]))
	{
		$id = $_REQUEST["id"];
		$sql = "DELETE FROM stocks WHERE id=".$id;
		//echo "[".$sql."]";
	}
	
					
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
						
		if ($conn->query($sql) === TRUE)
		{
			echo "Record deleted successfully";
		}
		else
		{
			echo "Error deleting record: " . $conn->error;
		}
		$conn->close();
	}
}









//_____________________________________________________________[Action scripts]____________________________________________________________________

//Limit access to SQL by only respnding to named queries only

if(isset($_REQUEST["Query"]))
{
	$Query = $_REQUEST["Query"];
	
	switch ($Query)
	{
		case "Receival_default":
			$response_table = Generate_Receival_table();
			echo $response_table;
			break;
			
		case "Stock_in_Type":
			$response_table = Generate_Stock_in_Type();
			echo $response_table;
			break;
			
			
			case "Stock_in_Types":
			$size = Generate_Stock_in_Types();
			echo $size;
			break;
			
		case "Add_Recieval":
			Add_Recieval();
			break;
			
		case "Remove_Receival":
			Remove_Receival();
			break;
			
		case "Basic_Receival_info":
			$response_table = Basic_Receival_info();
			echo $response_table;
			break;
			
		case "Get_Receival_line_items_JSON":
			$response_table = Get_Receival_line_items_JSON();
			echo $response_table;
			break;
			
		case "Usage_default":
			$response_table = Generate_Usage_table();
			echo $response_table;
			break;
			
		case "Remove_Receival_line_item":
			Remove_Receival_line_item();
			break;
			
		case "Update_Recieval":
			Update_Recieval();
			break;
			
		case "Add_Usage":
			Add_Usage();
			break;
			
		case "Remove_Usage":
			Remove_Usage();
			break;
			
		case "Basic_Usage_info":
			$response_table = Basic_Usage_info();
			echo $response_table;
			break;
			
		case "Get_Usage_line_items_JSON":
			$response_table = Get_Usage_line_items_JSON();
			echo $response_table;
			break;
			
		case "Remove_Usage_line_item":
			Remove_Usage_line_item();
			break;
			
		case "Update_Usage":
			Update_Usage();
			break;
			
		case "Inventory_default":
			$response_table = Generate_Inventory_table();
			echo $response_table;
			break;
			
		case "Remove_Stock":
			Remove_Stock();
			break;

		default:
			echo "No such query could be found";
	}
}

//echo "<br/>STOP - Server running";
?>
