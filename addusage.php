<?php
	
function Add_Usage()
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
	 //$Insertqty= $_REQUEST["Insertqty"];
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
				if(empty($item_objects[$x]['Spoilage']))
				{
					$item_objects[$x]['Spoilage']=0;
				}
				
				$sql = "INSERT INTO usage_lineitems(usage_id, stock_id, qty, spoilage, created_at, updated_at,)
					VALUES (".$id.", ".$item_objects[$x]['Stock_ID'].", ".$item_objects[$x]['Quantity']." , ".$item_objects[$x]['Spoilage']." , '".$created_at."', '".$updated_at."')";
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
			
		}
		else
		{
			echo "Error while inserting into database: ".$conn->error;
		}
		$conn->close();
	}
}



?>