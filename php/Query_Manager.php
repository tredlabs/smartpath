<?php
date_default_timezone_set("Jamaica");
session_start();
error_reporting(E_ALL-E_NOTICE);

require 'db.php';


//Prevent direct access, via browser
defined('Pembrokehall High School');

//Global Variables
	 	 $db_servername = "localhost";
		$db_username = "dert1_path";
		$db_password = "smartpath2000";
		$db_name =  "dert1_smartpath";

  
$dir="../";
require_once($dir."classes/Session_Manager.php");

//Set the access level for th query manager -Imani Sterling|| 2018
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="";
$userid = $_SESSION[$sid]['userid'];
//echo " $username  $userid";

//_____________________________________________________________[Functions]____________________________________________________________________


/** -Imani Sterling|| 2018
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
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Imani Sterling|| 2018
	
	
	//If the individual is searching for specific vendors  -Imani Sterling|| 2018
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



/** -Imani Sterling|| 2018
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
	//Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors 
	if(isset($_REQUEST["Type"]))
	{
		$location = $_REQUEST["location"];
		$sql = "SELECT $location.id,$location.name
			FROM $location
			INNER JOIN fields
			ON fields.id=$location.field_id";
	$formatted_result=""; 
		$type = $_REQUEST["Type"];
		
		$sql = $sql." WHERE fields.name = '".$type."'";
		//echo "[".$sql."]";
	}
		

if($type=="$type")
		{
		
		
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
		$conn->close();
				
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
				$data_row_item_formatted = $row["p1"];
			
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
				$data_row_item_formatted = $row["p1"];
			
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






/** -Imani Sterling|| 2018
*	@Discription:	adds a recieval to the recieval table and the coresponding line item in the receival line item table
*	
*	@param (void)
*
*	@return (void)
*/
function Add_Recieval()
{
	  
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Add Books";
$userid = $_SESSION[$sid]['userid'];
	//variables
	$sql = "";
	
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	//echo "$mess $username  $userid";
			
	//If the individual is searching for specific vendors  
	if(isset($_REQUEST["Invoice_Number"]) && isset($_REQUEST["Recdate"]))
	{
		$Invoice_Number = $_REQUEST["Invoice_Number"];
		$Recdate = $_REQUEST["Recdate"];
		$manudate = $_REQUEST["manudate"];
		$name = $_REQUEST["name"];
		$subject = $_REQUEST["subject"];
		$auth = $_REQUEST["auth"];
		$pub = $_REQUEST["pub"];
	//	$qty = $_REQUEST["qty"];
		$location = $_REQUEST["location"];
		
	}
	
	if($Invoice_Number==null){
		echo "Please Enter ISBN \n";
	exit;
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
		
				$sql ="SELECT * FROM receivals WHERE invoice_number ='$Invoice_Number'";
			
					$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$isbn= $row["invoice_number"];
	
	
	}

echo "ISBN already present: $isbn \n";	
exit();

}
		
		
		
			
				$sql ="INSERT INTO receivals(invoice_number, recdate, created_at)
			VALUES ('$Invoice_Number', '".$Recdate."', '".$manudate."')";
						
		if($conn->query($sql) === TRUE){
		 echo "Receival Created\n";
			$ids = mysqli_insert_id($conn); 
		}
		else
					{
						echo "Error while creating receival ".$conn->error;
					}
					
	
	   	   
					
							$sqls = "INSERT INTO $location(isbn,name,subject,auth,pub,manudate,recdate,location)
					VALUES ('$Invoice_Number','$name','$subject','$auth','$pub','$manudate','$Recdate','$location')";
				//echo "[".$sql."]";
				if($conn->query($sqls)===TRUE)
				{
					
				}
					
					



			$sqls = "INSERT INTO rec_lineitems(receival_id,name,subject,auth,pub,manudate,recdate,location)
					VALUES ('$ids','$name','$subject','$auth','$pub','$manudate','$Recdate','$location')";
				//echo "[".$sql."]";				
				if($conn->query($sqls)===TRUE)
				{ 
					
					$id = mysqli_insert_id($conn);
	
	
                   
				   $info="Item: $name ISBN: $Invoice_Number quantity: $quantity";
				   
				   
	               $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	               VALUES ('$userid','$username','$action','$id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   
  
  
} else {
    echo "Error: " . $sqltr . "<br>" . $conn->error;
}		
	
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}
	
		
		$conn->close();
	}
}

function Assign_barcode()
{
	  
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Assign Barcode";
$userid = $_SESSION[$sid]['userid'];
	//variables
	$sql = "";
	
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	//echo "$mess $username  $userid";
			
	//If the individual is searching for specific vendors  
	if(isset($_REQUEST["barcode"]))
	{
		$id = $_POST["id"];
		$barcode = $_POST["barcode"];
		$name = $_POST["name"];
		$dob = $_POST["dob"];
	

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
		
			
		$sql="SELECT * FROM Barcode
		WHERE barcode='$barcode'";
		
						
		$result = $conn->query($sql);
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				$barcode1=$row["barcode"];
				
			
			}
		echo "$barcode1 Already Added\n";	
		exit();
		}
		
		
		
		
		$sql1="SELECT * FROM Barcode
		WHERE student_name='$name'";
		
						
		$result = $conn->query($sql1);
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				$name1=$row["student_name"];
				
			
			}
		echo "$name1 Already Added\n";	
		}
		
		
		
		
	
		else
		{
			
			 $sqls = "INSERT INTO Barcode(student_name,barcode,stu_id,dob)
					VALUES ('$name','$barcode','$id','$dob')";
				//echo "[".$sql."]";
				if($conn->query($sqls)===TRUE)
				{
					echo "Barcode Successfully Assign";
					
					 		
	  
   $sql = "UPDATE Students SET bstatus='Yes',stu_barcode='$barcode' WHERE id=".$id;
									
					if($conn->query($sql) === TRUE)
					{
					//echo " Updated\n";
					}
					
					else {
    echo "Error: Updating Barcode " . $sql . "<br>" . $conn->error;
}		
	
					
					
					
					
				}
			
					$id = mysqli_insert_id($conn);
	             
				   $info="Item: $name ISBN: $Invoice_Number Barcode: $barcode Condition: $condition Grade: $grade";
				   
				   
	               $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	               VALUES ('$userid','$username','$action','$id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   
  
  
} else {
    echo "Error: " . $sqltr . "<br>" . $conn->error;
}		
				
		}
		
		

       

	
		
		$conn->close();
	}
}


function update_barcode()
{
	  
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Update Barcode";
$userid = $_SESSION[$sid]['userid'];
	//variables
	$sql = "";
	
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	//echo "$mess $username  $userid";
			
	//If the individual is searching for specific vendors  
	if(isset($_REQUEST["barcode"]))
	{
		$id = $_POST["id"];
		$barcode = $_POST["barcode"];
		$name = $_POST["name"];
		$dob = $_POST["dob"];
	

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
		
		
			$sql="SELECT * FROM Barcode
		WHERE barcode='$barcode'";
		
						
		$result = $conn->query($sql);
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				$barcode1=$row["barcode"];
				
			
			}
		echo "$barcode1 Already Exist\n";	
		exit();
		}
		
		
		
		
		
			
		$sql="Update Barcode  SET barcode='$barcode' WHERE stu_id='$id'";
		
		if($conn->query($sql) === TRUE)
					{
					echo " Updated\n";
					}
					
					else {
    echo "Error: Updating Barcode " . $sql . "<br>" . $conn->error;
}		
		$sql1="Update Students  SET stu_barcode='$barcode' WHERE id='$id'";
		
		if($conn->query($sql1) === TRUE)
					{
				//	echo " Updated\n";
					}
					
					else {
    echo "Error: Updating Students " . $sql1 . "<br>" . $conn->error;
}		
					
			
	             
				   $info="Student Name: $name Barcode: $barcode";
				   
				   
	               $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	               VALUES ('$userid','$username','$action','$id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   
  
  
} else {
    echo "Error: " . $sqltr . "<br>" . $conn->error;
}		
				
		}
	
	
		
		$conn->close();
	}















function add_lunch()
{
	  
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Add Lunch";
$userid = $_SESSION[$sid]['userid'];
	//variables
	$sql = "";
	
	$created_at = date("Y-m-d");
	$updated_at = date("Y-m-d h:i:s");
	//echo "$mess $username  $userid";
			
	//If the individual is searching for specific vendors  
	if(isset($_REQUEST["barcode"]))
	{
		$id = $_POST["id"];
		$barcode = $_POST["barcode"];
		$name = $_POST["name"];
		$dob = $_POST["dob"];
		$pic = $_POST["pic"];
		$stu_id = $_POST["stu_id"];
		$qty=1;
	

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
		$sql="SELECT * FROM path_lunch
		WHERE barcode='$barcode' and created_at='$created_at'";
		
						
		$result = $conn->query($sql);
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				$barcode1=$row["barcode"];
				
			
			}
		echo "$name Already Taken Lunch\n";	
		}
		else
		{
			
			 $sqls = "INSERT INTO path_lunch(stu_id,name,qty,barcode,image,created_at)
					VALUES ('$stu_id','$name','$qty','$barcode','$pic','$created_at')";
				//echo "[".$sql."]";
				if($conn->query($sqls)===TRUE)
				{
					echo "Lunch Approved";
					
					  // $sql = "UPDATE Warehouse1 set instock=instock+$qty
					  // WHERE isbn='$isbn'";
				//echo "[".$sql."]";
				//if($conn->query($sql)===TRUE)
				//{
					//echo "Barcode Successfully Assign";
					
			//	}
					
					
					
					
				}
			
					$id = mysqli_insert_id($conn);
	             
				   $info="Student name: $name  Barcode: $barcode ";
				   
				   
	               $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	               VALUES ('$userid','$username','$action','$id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   
  
  
} else {
    echo "Error: " . $sqltr . "<br>" . $conn->error;
}		
				
		}
		
		

       

	
		
		$conn->close();
	}
}



/** -
*	@Discription:	Remove the given recieval from th receival table along with its line items
*	
*	@param (void)
*
*	@return (String) HTML formatted output
*/
function Remove_price()
{

$created_at = date("Y-m-d h:i:s");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Remove Item Price ";
$userid = $_SESSION[$sid]['userid'];

	$sql = "";
	

	
	
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
	
	if(isset($_REQUEST["id"]))
	{
		$id = $_REQUEST["id"];
		$sql3="SELECT * FROM price WHERE
		id=".$id;
		
		$result= $conn->query($sql3);
		
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				$code=$row["code"];
				$unit_cost=$row["unit_cost"];
				$name=$row["name"];
				$size=$row["size"];
                $sale_cost=$row["sale_cost"];
				
			}
		}

				
	$sql = "DELETE FROM price WHERE id=".$id;
			
		
			
			if ($conn->query($sql) === TRUE)
			{
			echo "Record deleted successfully \n";	
	
			}
			else
			{
				echo "Error deleting record: " . $conn->error;
			}
			
		
	
	
	

	
	$info="Name: $name Code :$code  Unit Cost: $unit_cost  Sale Cost: $sale_cost Size: $size";
				   
				   
	
	$sqltr = "INSERT INTO user_action(user_id,user,action,purpose,created_at)
	VALUES ('$userid','$username','$action','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     
   } 				
	


	
	
	
	}
	
	
	
	}
function Del_Receival()
{

$created_at = date("Y-m-d h:i:s");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Remove Usage";
$userid = $_SESSION[$sid]['userid'];

	$sql = "";

	
	
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
	
	if(isset($_REQUEST["id"]))
	{
		$id = $_REQUEST["id"];
		$sql3="SELECT * FROM rec_lineitems WHERE
		id=".$id;
		
		$result= $conn->query($sql3);
		
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				$location=$row["location"];
				$stock_id=$row["stock_id"];
				$receival_id=$row["receival_id"];
				$cost=$row["cost"];
                $qty=$row["qty"];
				
				
			$sql2 = "UPDATE $location SET instock = instock - $qty,cost=cost-$cost WHERE id=$stock_id";
	
	
				if ($conn->query($sql2) === TRUE)
			{
				
			}
				else
		{
			echo "Error updating record: " . $conn->error;
		}
				
			
					
		}
			
		
		}
	
		
	$sql = "DELETE FROM rec_lineitems WHERE id =".$id;
			
			
			
			if ($conn->query($sql) === TRUE)
			{
			echo "Record deleted successfully \n";	
						
						}
			else
			{
				echo "Error deleting record: " . $conn->error;
			}
		
	
	
	

	
	$info="Quantity :$qty  Cost: $cost";
				   
				   
	
	$sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$stockid','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     
   } 				
	


	
	
	
	}
	
	
	
	}	

function Remove_Receival()
{

$created_at = date("Y-m-d h:i:s");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Remove Usage";
$userid = $_SESSION[$sid]['userid'];

	$sql = "";
	

		
	
	
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
	
	if(isset($_REQUEST["rid"]))
	{
		$rrid = $_REQUEST["rid"];
		$sql3="SELECT * FROM rec_lineitems WHERE
		id=".$rrid;
		
		$result= $conn->query($sql3);
		
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				$location=$row["location"];
				$stock_id=$row["stock_id"];
				$receival_id=$row["receival_id"];
				$cost=$row["cost"];
                $qty=$row["qty"];
				
				
			$sql2 = "UPDATE $location SET instock = instock - $qty,cost=cost-$cost WHERE id=$stock_id";
	
	
				if ($conn->query($sql2) === TRUE)
			{
				
			}
				else
		{
			echo "Error updating record: " . $conn->error;
		}
				
			
					
		}
			
		
		}
	
		
	$sql = "DELETE FROM rec_lineitems WHERE receival_id =".$rrid;
			
			$sql2 = "DELETE FROM receivals WHERE id=".$rrid;
			
			if ($conn->query($sql) === TRUE)
			{
			echo "Record deleted successfully \n";	
			$result = $conn->query($sql2);
			}
			else
			{
				echo "Error deleting record: " . $conn->error;
			}
		
	
	
	

	
	$info="Quantity :$qty  Cost: $cost";
				   
				   
	
	$sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$stockid','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     
   } 				
	


	
	
	
	}
	
	
	
	}
	
	
	function Add_price()
{
	
	
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Add Price Item";
$userid = $_SESSION[$sid]['userid'];
	//variables
	$sql = "";
	$Invoice_Number = "";
	$Recdate = "";
	$Inline_items = "";
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	//echo "$mess $username  $userid";
	

	
	
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
	
	
		if(isset($_REQUEST["type"]))
	{
		$type=$_REQUEST["type"];
		$sql2="SELECT * FROM fields WHERE name='$type'";
		$result = $conn->query($sql2);
			
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$field_id=$row["id"];
										
				
			}
		}
		else{

      $sql = "INSERT INTO fields(name)
	VALUES ('$type')";
	$result = $conn->query($sql);
	$field_id = mysqli_insert_id($conn);

		}
		
	
	
	$sql2="SELECT * FROM equipment WHERE name='$type'";
		$result = $conn->query($sql2);
			
		if ($result->num_rows > 0)
		{
			//echo "Already exist\n";
		}
		else{

      $sql = "INSERT INTO equipment(name)
	VALUES ('$type')";
	$result = $conn->query($sql);
	//echo "equipment: $type Added\n";
		
		}
		
	}
		
		
	
	//If the individual is searching for specific vendors  
	if(isset($_REQUEST["code"]) && isset($_REQUEST["name"]) && isset($_REQUEST["unit_cost"]))
	{
		$code = $_REQUEST["code"];
		$name = $_REQUEST["name"];
		
		//$type = $_REQUEST["type"];
			$unit_cost = $_REQUEST["unit_cost"];
		$sale_cost = $_REQUEST["sale_cost"];
			$location = $_REQUEST["location"];
			$instock = $_REQUEST["instock"];
		$reorder = $_REQUEST["reorder"];
		$cost=$instock*$unit_cost;
	
		
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
						   
	
	$sql = "INSERT INTO price(code,unit_cost,name,type)
	VALUES ('$code','$unit_cost','$name','$type')";
	
	 $sql2 = "INSERT INTO $location(code,field_id,cost,unit_cost,instock,reorderlevel,name,type,location,created_at)
	VALUES ('$code','$field_id','$cost','$unit_cost','$instock','$reorder','$name','$type','$location','$created_at')";
			
  if ($conn->query($sql) === TRUE) {
   $result = $conn->query($sql2);
  	
	  echo "Successfully Added";
   
 } 				
	else
		{
			echo "Error adding price item: " . $conn->error;
		}
		
		
			
  
		
		
$info="Name: $name  Code: $code Unit Cost: $unit_cost Instock: $instock reorder: $reorder location: $location ";

	 $sqltr = "INSERT INTO user_action(user_id,user,action,purpose,created_at)
	             VALUES ('$userid','$username','$action','$info','$created_at')";
	}
	
	   if ($conn->query($sqltr) === TRUE) {
 
   } 
	  
	  
	
	}



/** -Imani Sterling|| 2018
*	@Discription:	Get the the receival inline items from the inline item table and format the output for display
*	
*	@param (Integer) $id - The id numbere for the receival
*
*	@return (String) HTML formatted output
*/
function Get_Receival_line_items($id)
{
	//Create SQL string -Imani Sterling|| 2018
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Imani Sterling|| 2018
	
	
	//If the individual is searching for specific vendors  -Imani Sterling|| 2018
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



/** -Imani Sterling|| 2018
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
			  WHERE receivals.id=".$id;
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
				$json_encoded_out = array('Invoice_Number' => $row["invoice_number"],'location' => $row["location"], 'Recdate' => ''.$row["recdate"].'');
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
function Basic_Receival_price()
{
	//Create SQL string 
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors  
	if(isset($_REQUEST["id"]))
	{
	
		$id=$_REQUEST["id"];
		
		$sql="SELECT price.*
			  FROM price
			  WHERE id=".$id;
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
				$json_encoded_out = array('code' => $row["code"],'unit_cost' => $row["unit_cost"],'sale_cost' => $row["sale_cost"],'size' => $row["size"], 'name' => ''.$row["name"].'');
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


function Basic_warehouse()
{
	//Create SQL string 
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors  
	if(isset($_REQUEST["id"]))
	{
	
		$id=$_REQUEST["id"];
		$location=$_REQUEST["location"];
		
		$sql="SELECT *
			  FROM $location
			  WHERE id=".$id;
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
				$json_encoded_out = array('isbn' => $row["isbn"],'name' => $row["name"],'subject' => $row["subject"],'auth' => $row["auth"],'books' => $row["books"],'instock' => $row["instock"],'status' => $row["status"], 'pub' => ''.$row["pub"].'');
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

function Basic_student()
{
	//Create SQL string 
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors  
	if(isset($_REQUEST["id"]))
	{
	
		$id=$_REQUEST["id"];
		$location=$_REQUEST["location"];
		
		$sql="SELECT *
			  FROM $location
			  WHERE id=".$id;
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
				$json_encoded_out = array('fname' => $row["firstname"],'mname' => $row["middlename"],'lname' => $row["lastname"],'grade' => $row["grade"],'dob' => $row["dob"].'');
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



function Basic_teacher()
{
	
	//Create SQL string 
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors  
	if(isset($_GET["id"]))
	{
	
		$id=$_GET["id"];
		$location=$_GET["location"];
		
		$sql="SELECT *
			  FROM $location
			  WHERE id=".$id;
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
				$json_encoded_out = array('fname' => $row["firstname"],'lname' => $row["lastname"].'');
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







function Basic_barcode()
{
	
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors  
	if(isset($_REQUEST["id"]))
	{
	
		$id=$_REQUEST["id"];
		$location=$_REQUEST["location"];
		
		$sql="SELECT $location.*,Warehouse1.*
			  FROM $location INNER JOIN Warehouse1 ON $location.isbn=Warehouse1.isbn
			  WHERE barcode=".$id;
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
				$json_encoded_out = array('isbn' => $row["isbn"],'barcode' => $row["barcode"],'name' => $row["name"].' '.$row["books"],'cond' => $row["cond"],'auth' => $row["subject"],'pub' => $row["pub"],'cond' => $row["cond"].'');
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


function Basic_barcode_check()
{
	
	$created_at = date("Y-m-d");	
	
	
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors  
	if(isset($_REQUEST["id"]))
	{
	
		$id=$_REQUEST["id"];
		$location=$_REQUEST["location"];
		
		
		
		/*$sql="SELECT rentteacher_lineitems.tid,rentteacher_lineitems.barcode,rentteacher_lineitems.isbn,rentteacher_lineitems.cond,rentteacher_lineitems.name,Teachers.id,Teachers.fullname
			  FROM rentteacher_lineitems INNER JOIN Teachers ON rentteacher_lineitems.tid=Teachers.id
			  WHERE barcode=".$id;*/
			  
			/*$sql1="SELECT rent_lineitems.stu_id,rent_lineitems.barcode,rent_lineitems.isbn,rent_lineitems.cond,rent_lineitems.name,Students.id,Students.fullname
			  FROM rent_lineitems INNER JOIN Students ON rent_lineitems.stu_id=Students.id
			  WHERE barcode=".$id;*/
				  
			  /*	if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				$code=$row["tid"];
				$unit_cost=$row["unit_cost"];
				$name=$row["name"];
				
				
			}
		}*/
			  
		
		
		$sql="SELECT $location.*,Students.*
			  FROM $location INNER JOIN Students ON $location.stu_id=Students.id
			  WHERE barcode=".$id;
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
				$json_encoded_out = array('stu_name' => $row["student_name"],'stu_id' => $row["stu_id"],'barcode' => $row["barcode"],'dob' => $row["dob"],'image' => $row["pic"].'');
				$json_encoded_out = json_encode($json_encoded_out);
				
				$formatted_result=$json_encoded_out;
			}
			$conn->close();
		}
		else
		{
			 $json_encoded_out="Not Found";
			$json_encoded_out = json_encode($json_encoded_out);
				
				$formatted_result=$json_encoded_out;
		}
	}

	return $formatted_result;
}





function Add_barcode()
{
	//Create SQL string 
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors  
	if(isset($_GET["id"]))
	{
	
		$id=$_GET["id"];
		$location=$_REQUEST["location"];
		
		$sql="SELECT *
			  FROM $location
			  WHERE id=".$id;
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
				$json_encoded_out = array('fname' => $row["firstname"],'lname' => $row["lastname"],'dob' => $row["dob"].'');
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


function Add_barcode1()
{
	//Create SQL string 
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors  
	if(isset($_GET["id"]))
	{
	
		$id=$_GET["id"];
		$location=$_REQUEST["location"];
		
		$sql="SELECT *
			  FROM $location
			  WHERE stu_id=".$id;
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
				$json_encoded_out = array('name' => $row["student_name"],'barcode' => $row["barcode"],'dob' => $row["dob"].'');
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


  
/** -Imani Sterling|| 2018
*	@Discription:	Get the the receival inline items from the inline item table and format the output for JSON
*	
*	@param (Integer) $id - The id numbere for the receival
*
*	@return (String) JSON formatted output
*/
function Get_Receival_line_items_JSON()
{
	//Create SQL string -Imani Sterling|| 2018
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Imani Sterling|| 2018
	
	
	//If the individual is searching for specific vendors  -Imani Sterling|| 2018
	if(isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
		//$rid=$_REQUEST["rid"];
		$sql="SELECT receivals.*, rec_lineitems.*,rec_lineitems.id as rid
			  FROM  receivals
			  	INNER JOIN rec_lineitems
			  	ON receivals.id=rec_lineitems.receival_id
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
						
		$result = $conn->query($sql);
			
		if ($result->num_rows > 0)
		{
			$line_items = array();
			
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				$line_item = array('id' => $row["receival_id"],'rid' => $row["rid"],'name' => $row["item"], 'stock_id' => $row["stock_id"], 'qty' => $row["qty"],'unitcost' => $row["unit_cost"], 'equip' => $row["type"]);
				
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


/** -Imani Sterling|| 2018
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
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Imani Sterling|| 2018
	
	
	//If the individual is searching for specific vendors  -Imani Sterling|| 2018
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
									/*$data_row_item_formatted = '
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
												<td>'.$row["cost"].'</td>
												<td class="text-center">';*/
								
							
						
					
						
					
				
				$data_row_item_formatted = '
											<tr id="Listing_row_'.$row["id"].'">
												<td>'.$row["invoice_number"].'</td>
												<td>'.$row["usagedate"].'</td>
												<td>'.$row["equip"].'</td>
												<td>'.$row["purpose"].'</td>
												<td>'.$row["name"].'</td>
												<td>'.$row["pack"].'</td>
												<td>'.$row["qty"].'</td>
												
												<td>'.$row["printedform1"].'</td>
												<td>'.$row["printedform2"].'</td>
												
													<td>'.$row["envsmall"].'</td>
												
													<td>'.$row["spenvsmall"].'</td>
											
												<td>'.$row["cost"].'</td>
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


/** -Imani Sterling|| 2018
*	@Discription:	Get the the Usage inline items from the inline item table and format the output for display
*	
*	@param (Integer) $id - The id numbere for the receival
*
*	@return (String) HTML formatted output
*/
function Get_Usage_line_items($id)
{
	//Create SQL string -Imani Sterling|| 2018
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Imani Sterling|| 2018
	
	
	//If the individual is searching for specific vendors  -Imani Sterling|| 2018
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


/** -Imani Sterling|| 2018
*	@Discription:	Remove the given recieval inline item from th receival inline item table
*	
*	@param (void)
*
*	@return (String) HTML formatted output
*/
function Remove_Receival_line_item()
{
	//Create SQL string -Imani Sterling|| 2018
	$sql = "";
	
	
	//If the individual is searching for specific vendors  -Imani Sterling|| 2018
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


/** -Imani Sterling|| 2018
*	@Discription:	Update the details of a receival and also its line items, allowing for the adding off new line items in the update
*	
*	@param (void)
*
*	@return (void)
*/
function Update_Recieval()
{
	
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Update Receival";
$userid = $_SESSION[$sid]['userid'];

	//variables
	$sql = "";
	$ID = "";
	$Invoice_Number = "";
	$Recdate = "";
	
	$Inline_items = "";
	
	$updated_at = date("Y-m-d h:i:s");
	
			
	//Checking for the presents of the required variables  -
	if(isset($_REQUEST["ID"]) && isset($_REQUEST["Invoice_Number"]) && isset($_REQUEST["Recdate"]) && isset($_REQUEST["Inline_items"]))
	{
		$ID = $_REQUEST["ID"]; 
		$Item_ID = $_REQUEST["Item_ID"]; 
		$Invoice_Number = $_REQUEST["Invoice_Number"];
		$Recdate = $_REQUEST["Recdate"];
        $location = $_REQUEST["location"];
		$stock_id = $_REQUEST["stock_id"];
		$Inline_items = $_REQUEST["Inline_items"];
	$add_item=$_REQUEST["add_item"];
	
	}
	if(isset($_REQUEST["new_Inline_items"])){
		
			$ID = $_REQUEST["ID"]; 

		$Invoice_Number = $_REQUEST["Invoice_Number"];
		$Recdate = $_REQUEST["Recdate"];
        $location = $_REQUEST["location"];
	
		$add_item=$_REQUEST["new_Inline_items"];
		
		$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
					$item_objects = json_decode($add_item, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
						$quantity=$item_objects[$x]['qty'];
					    $unitcost=$item_objects[$x]['unitcost'];
				
			
			   	
			       $type=$item_objects[$x]['type']; 						
			   	   $sql ="SELECT $location.code,$location.name FROM $location WHERE $location.id =".$item_objects[$x]['stock'];
		           $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	    $code= $row['code'];
		$name= $row['name'];
		
	
	}
}	
			   				
		$sql ="SELECT * FROM price WHERE code ='$code'";
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$unitcost1= $row["unit_cost"];
}

}

 $quantity=$item_objects[$x]['qty'];
 $unitcost=$item_objects[$x]['unitcost'];					
					
			   	$cost=$quantity*$unitcost;
             
              	$item=$name;
           
			   	
				$sqls = "INSERT INTO rec_lineitems(receival_id,stock_id,cost,unit_cost,item,type,qty,created_at,location)
					VALUES ('$ID',".$item_objects[$x]['stock'].",'$cost','$unitcost','$item','$type',".$item_objects[$x]['qty'].", '$Recdate','$location')";
				//echo "[".$sql."]";				
				if($conn->query($sqls)===TRUE)
				{
					echo"Item Added\n"; 
					//Make adjustment the stock table 
				
				    $sql = "UPDATE $location
							SET instock = instock + $quantity,cost=cost+$cost,unit_cost=$unitcost
							WHERE id=".$item_objects[$x]['stock'];
							
									
  if ($conn->query($sql) === TRUE) {
   
  
} else {
    echo "Error: " . $sqltr . "<br>" . $conn->error;
}		
			
							
					
					$id = mysqli_insert_id($conn);
	
	
                   
				   $info="Item: $item quantity: $quantity  Cost:$ $cost";
				   
				   
	               $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	               VALUES ('$userid','$username','$action','$id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   
  
  
} else {
    echo "Error: " . $sqltr . "<br>" . $conn->error;
}		
					
					
									
					
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}
	 

			
			
			
		}
		
		
		
		
		
		
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
		
		$sql = "UPDATE receivals
				SET invoice_number='$Invoice_Number', recdate='$Recdate'
				WHERE id='$ID'";
				
				
						
		if($conn->query($sql) === TRUE)
		{
			 echo "Updated successfully\n";	
			}  
	
			
			$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				
			$id=$item_objects[$x]['Item_ID'];
			$type=$item_objects[$x]['Type'];
			$stockid=$item_objects[$x]['stockid'];
	
					$sql="SELECT * FROM $location 
		WHERE id=".$stockid;
		
		$result= $conn->query($sql);
		
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				
                $code=$row["code"];
				
			}
			
			
		}	
				
			
			
										
		$sql ="SELECT * FROM price  WHERE code ='$code'";
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$unit_cost1=$row["unit_cost"];
	
	
	}

}		
			$sql2= "SELECT * FROM rec_lineitems
			WHERE id=".$item_objects[$x]['Item_ID'];		
			$result = $conn->query($sql2);
				if ($result->num_rows > 0)
		{	
		
			
	
			while($row = $result->fetch_assoc())
			{
				
			 $qtyA=$row["qty"];
			
			$stockid1=$row["stock_id"];
			
		}
		}	
				
		
			//Update individual line items   -Imani Sterling|| 2018
			//$id = mysqli_insert_id($conn); //Get the inserted ID for the Receival that was inserted above -Imani Sterling || 2018
			
			$item_objects = json_decode($Inline_items, true); 
			$number_of_inline_items = sizeof($item_objects);
			
			
				$qtyB=$item_objects[$x]['Quantity'];
				$unitcost=$item_objects[$x]['unitcost'];
			
						if($qtyB<=$qtyA)
						{
							
							$updatesheet=$qtyA-$qtyB;
							$cost=$updatesheet*$unitcost;	
							$cost1=$unitcost*$qtyB;
						
								$sql1 = "UPDATE $location
						SET instock=instock-$updatesheet,cost=cost-$cost, unit_cost=$unitcost
						WHERE id=".$stockid;
							
											$sql = "UPDATE rec_lineitems
						SET cost=$cost1,qty=".$item_objects[$x]['Quantity'].",unit_cost=$unitcost, updated_at= '".$Recdate."'
						WHERE id=".$item_objects[$x]['Item_ID'];
						
						if($conn->query($sql1) === TRUE)
				{
					
               $purpose="Remove Sheets: $updatesheet Cost:  $cost";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$stockid','$purpose','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
  	$uid = mysqli_insert_id($conn);
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   
  
  
} else {
    echo "Error3: " . $sqltr . "<br>" . $conn->error;
}		
					
					
					
							if($conn->query($sql) === TRUE)
				{
					if($qtyB==$qtyA||$qtyB==""){
					// echo "Updated successfully\n";	
					}else{
						  //echo "Updated\n";	
					}
					
					
				}
				else
				{
					echo "Error updating Receival: 	 ".$conn->error;
				}	
				}
				else
				{
					echo "Error while updating $location: 	 ".$conn->error;
				}
					}
						else{
							        $updatesheet=$qtyB-$qtyA;
									$cost=$updatesheet*$unitcost;
								$cost1=$unitcost*$qtyB;
						   $sql1 = "UPDATE $location
						SET instock=instock+$updatesheet, cost=cost+$cost,unit_cost=$unitcost
						WHERE id='$stockid'";
							
						  $sql = "UPDATE rec_lineitems
						SET cost=$cost1, qty=".$item_objects[$x]['Quantity'].",unit_cost=$unitcost, updated_at= '$updated_at'
						WHERE id=".$item_objects[$x]['Item_ID'];
						
						if($conn->query($sql) === TRUE)
				{
					
					$purpose="Add Sheets: $updatesheet Cost:  $cost";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$stockid','$purpose','$created_at')";
			
         if ($conn->query($sqltr) === TRUE) {
         	$uid = mysqli_insert_id($conn);
           //$mess="Trace user  ";
	       //echo "$mess $username  $userid";
           } else 
           {
              echo "Error1: " . $sqltr . "<br>" . $conn->error;
           }
			 if($conn->query($sql1) === TRUE)
				{
					//echo "Updated successfully\n";
				}
				else
				{
					echo "Error while updating:".$conn->error;
				}
					
				}
				else
				{
					echo "Error while updating Receival: 	 ".$conn->error;
				}
			
						}	
			
						
							
									
				
			
			}

		
		
	}
	}
	
	
	function Update_price()
{

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Update Price";
$userid = $_SESSION[$sid]['userid'];

	//variables

	
	$updated_at = date("Y-m-d h:i:s");
	
			
	//Checking for the presents of the required variables  -
	if(isset($_REQUEST["ID"]) && isset($_REQUEST["code"]) && isset($_REQUEST["unit_cost"]))
	{
		$ID = $_REQUEST["ID"]; 
		$code = $_REQUEST["code"]; 
		$unit_cost = $_REQUEST["unit_cost"];
		$sale_cost = $_REQUEST["sale_cost"];
        $name = $_REQUEST["name"];	
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
			$sql1="SELECT * FROM price WHERE id='$ID' ";
			$result= $conn->query($sql1);
	
		echo"$rowcount";
			$i=0;
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$codeA=$row["code"];
               
			}
		}	
		
		
		
		
		
		
		
		
			
				
		$sql = "UPDATE price
				SET code='$code', unit_cost='$unit_cost',name='$name'
				WHERE id='$ID'";
		
		//$sql1 = "UPDATE Warehouse1
			//	SET code='$code,name='$name'
				//WHERE code='$codeA'";	
				
							
		
				
					
				
						
		if($conn->query($sql) === TRUE)
		{
			echo "Updated Successfully\n";
			
			//	if($conn->query($sql1) === TRUE)
		//{
		//	echo "Updated Successfully";
			
		//}	
			
					
               $purpose="Update Price Items:  code:  $code Name: $name Sale Cost: $sale_cost Size: $size Unit Cost: $unit_cost";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$ID','$purpose','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
  	$uid = mysqli_insert_id($conn);
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   
  
  
} else {
    echo "Error3: " . $sqltr . "<br>" . $conn->error;
}		
					
					
					
			
				}
				else
				{
					echo "Error updating Price: 	 ".$conn->error;
				}	
				}
	
						}	


					
	function Update_all()
{
//echo"love";
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Update Warehouse";
$userid = $_SESSION[$sid]['userid'];

	//variables

	
	$updated_at = date("Y-m-d h:i:s");
	
			
	//Checking for the presents of the required variables  -
	if(isset($_REQUEST["ID"]) && isset($_REQUEST["name"]) && isset($_REQUEST["type"]))
	{
		$ID = $_REQUEST["ID"]; 
		$type = $_REQUEST["type"]; 
		$cost = $_REQUEST["cost"];
		$reorder = $_REQUEST["reorder"];
        $name = $_REQUEST["name"];
		$instock = $_REQUEST["instock"];
       $location = $_REQUEST["location"];
       $qty=$instock;
		
		
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
		
			$sql="SELECT * FROM $location ";
			$result= $conn->query($sql);
		$rowcount=mysqli_num_rows($result);
		echo"$rowcount";
			$i=0;
		if ($result->num_rows > 0)
		{
			// output data of each row
			for($count=0;$count<$rowcount;$count++)
			{
				//echo"$rowcount";
				$code[$i]=$row["code"];
				$ID[$i]=$row["id"];
				
                $qtyA[$i]=$row["instock"];
				$i++;
				
			}
		}
		
		for($count=0;$count>$i;$count++)
		{$sql1 ="SELECT * FROM price WHERE code ='$code[$i]'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$unit_cost[$i]= $row["unit_cost"];
	//$size= $row["size"];
	
	}
}
	
		$cost[$i]=$qtyA[$i]*$unit_cost[$i];
		
			
		$sql = "UPDATE $location 
				SET  cost=$cost[$i],instock=$qtyA[$i],reorderlevel='$reorder'
				WHERE id='$ID[$i]'";
				
				
						
		if($conn->query($sql) === TRUE)
		{
			echo "Updated Successfully";
		}
			
		
		
	}	
				}
				
				}
	function Add_book()
{

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Add Book";
$userid = $_SESSION[$sid]['userid'];

	//variables

	
	$updated_at = date("Y-m-d h:i:s");
	
			
	//Checking for the presents of the required variables  -
	if(isset($_REQUEST["name"]) && isset($_REQUEST["isbn"])&& isset($_REQUEST["subject"])&& isset($_REQUEST["auth"])&& isset($_REQUEST["pub"]))
	{
		$id= $_REQUEST["id"]; 
		$isbn = $_REQUEST["isbn"]; 
		$name = $_REQUEST["name"];
		$subject= $_REQUEST["subject"];
        $book = $_REQUEST["book"];
		$auth = $_REQUEST["auth"];
       $location = $_REQUEST["location"];
       $status = $_REQUEST["status"];
       $qty = $_REQUEST["qty"];
       $pub = $_REQUEST["pub"];
	   $instock= $_REQUEST["instock"];
     
		
		
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
		
		
			$sql ="SELECT * FROM $location WHERE isbn ='$isbn'";
			
					$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$isbn= $row["isbn"];
	
	
	}

echo "ISBN already present: $isbn \n";	
exit();

}
	
	
		$sql = "INSERT INTO $location(isbn,name,subject,books,instock,auth,pub,status)
		VALUES('$isbn','$name','$subject','$book','$qty','$auth','$pub','$status')";
				
				
						
		if($conn->query($sql) === TRUE)
		{
			$id = mysqli_insert_id($conn);
			echo "Book Successfully Added";
			
			//Update individual line items   -Imani Sterling|| 2018
			//$id = mysqli_insert_id($conn); //Get the inserted ID for the Receival that was inserted above -Imani Sterling|| 2018
			
					
               $purpose="Add book: ISBN:$isbn Title: $name Book: $book Subject: $subject Auth:$auth  Pub: $pub";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$id','$purpose','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
 
  
} else {
    echo "Error3: " . $sqltr . "<br>" . $conn->error;
}		
			
				}
				else
				{
					echo "Error updating: 	 ".$conn->error;
				}	
				}
	
						}	
			
						
			function Add_student()
{

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Add Student";
$userid = $_SESSION[$sid]['userid'];

	//variables

	
	$updated_at = date("Y-m-d h:i:s");
	
			
	//Checking for the presents of the required variables  -
	if(isset($_REQUEST["fname"]) && isset($_REQUEST["mname"])&& isset($_REQUEST["lname"])&& isset($_REQUEST["dob"])&& isset($_REQUEST["grade"]))
	{
	   $fullname = $_REQUEST["fullname"];
		$fname = $_REQUEST["fname"];
		$mname = $_REQUEST["mname"];
		$lname = $_REQUEST["lname"];
		$dob= $_REQUEST["dob"];
        $grade= $_REQUEST["grade"];
	
       $location = $_REQUEST["location"];
    
     
		
		
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
		
	
	
		$sql = "INSERT INTO $location(fullname,lastname,firstname,middlename,dob,grade)
		VALUES('$fullname','$lname','$fname','$mname','$dob','$grade')";
				
				
						
		if($conn->query($sql) === TRUE)
		{
			$id = mysqli_insert_id($conn);
			echo "Student Successfully Added";
			
			//Update individual line items   -Imani Sterling|| 2018
			//$id = mysqli_insert_id($conn); //Get the inserted ID for the Receival that was inserted above -Imani Sterling|| 2018
			
					
               $purpose="Add Student: Fullname:$fullname Dob: $dob Grade: $grade";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$id','$purpose','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
 
  
} else {
    echo "Error3: " . $sqltr . "<br>" . $conn->error;
}		
			
				}
				else
				{
					echo "Error updating: 	 ".$conn->error;
				}	
				}
	
						}	
			
														
									
	
	
			function Add_pic()
{



$dir="../";
require_once($dir."classes/Session_Manager.php");

//Set the access level for th query manager -Imani Sterling|| 2018
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Add Students";
$userid = $_SESSION[$sid]['userid'];

$created_at = date("Y-m-d");
$updated_at = date("Y-m-d h:i:s");


if (!empty ($_FILES['imgInp'])){
 
$fileName = $_FILES['imgInp']['name'];
$fileType = $_FILES['imgInp']['type'];
$fileContent = file_get_contents($_FILES['imgInp']['tmp_name']);
$dataUrl = 'data:' . $fileType . ';base64,' . base64_encode($fileContent);
$json = json_encode(array(
  'name' => $fileName,
  'type' => $fileType,
  'dataUrl' => $dataUrl,

));

$imagetmp=addslashes (file_get_contents($_FILES['imgInp']['tmp_name']));


$upload_image=$_FILES['imgInp']['name'];

$folder="./stu_image/";
$img="php/stu_image/";
$pic="$img"."$fileName";



move_uploaded_file($_FILES['imgInp']['tmp_name'], "$folder".$_FILES['imgInp']['name']);


  $location="Students";
        $fullname = $_POST["fullname"];
		$fname = $_POST["fname"];
		$mname = $_POST["mname"];
		$lname = $_POST["lname"];
		$grade = $_POST["grade"];
		$dob= $_POST["dob"];
		$id= $_POST["id"];
		
			$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
		

$sql = "INSERT INTO $location(fullname,lastname,firstname,middlename,dob,grade,pic)
		VALUES('$fullname','$lname','$fname','$mname','$dob','$grade','$pic')";
				
				
				
						
		if($conn->query($sql) === TRUE)
		{
		
			echo " Successfully Updated \n";			
		
					
               $purpose="Student: Fullname:$fullname Dob: $dob Grade: $grade";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$id','$purpose','$updated_at')";
			
  if ($conn->query($sqltr) === TRUE) {
 
  
} else {
    echo "Error3: " . $sqltr . "<br>" . $conn->error;
}		
			
				}
				else
				{
					echo "Error updation : $location 	 ".$conn->error;

//echo "$name\n";
//echo "$dob\n";


						}	







}
else{


        $location="Students";
        $fullname = $_POST["fullname"];
		$fname = $_POST["fname"];
		$mname = $_POST["mname"];
		$lname = $_POST["lname"];
		$grade = $_POST["grade"];
		$dob= $_POST["dob"];
		
		
			$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
		

$sql = "INSERT INTO $location(fullname,lastname,firstname,middlename,dob,grade)
		VALUES('$fullname','$lname','$fname','$mname','$dob','$grade')";
				
				
						
		if($conn->query($sql) === TRUE)
		{
			$id = mysqli_insert_id($conn);
		echo "Student Successfully Added";
			
	
					
               $purpose="Add Student: Fullname:$fullname Dob: $dob Grade: $grade";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$id','$purpose','$updated_at')";
			
  if ($conn->query($sqltr) === TRUE) {
 
  
} else {
    echo "Error3: " . $sqltr . "<br>" . $conn->error;
}		
			
				}
				else
				{
					echo "Error Adding : $location 	 ".$conn->error;

//echo "$name\n";
//echo "$dob\n";


	
						}		
	
	
	
}







			
							
	
	
	}
	
				
				function Add_pic1()
{

$updated_at = date("Y-m-d h:i:s");

$dir="../";
require_once($dir."classes/Session_Manager.php");

//Set the access level for th query manager -Imani Sterling|| 2018
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Update Students with pic";
$userid = $_SESSION[$sid]['userid'];

$created_at = date("Y-m-d");



if (!empty ($_FILES['imgInp1'])){
 
$fileName = $_FILES['imgInp1']['name'];
$fileType = $_FILES['imgInp1']['type'];
$fileContent = file_get_contents($_FILES['imgInp1']['tmp_name']);
$dataUrl = 'data:' . $fileType . ';base64,' . base64_encode($fileContent);
$json = json_encode(array(
  'name' => $fileName,
  'type' => $fileType,
  'dataUrl' => $dataUrl,

));

$imagetmp=addslashes (file_get_contents($_FILES['imgInp1']['tmp_name']));


$upload_image=$_FILES['imgInp1']['name'];

$folder="./stu_image/";
$img="php/stu_image/";
$pic="$img"."$fileName";



move_uploaded_file($_FILES['imgInp1']['tmp_name'], "$folder".$_FILES['imgInp1']['name']);


  $location="Students";
        $fullname = $_POST["fullname"];
		$fname = $_POST["fname"];
		$mname = $_POST["mname"];
		$lname = $_POST["lname"];
		$grade = $_POST["grade"];
		$dob= $_POST["dob"];
		$id= $_POST["id"];
		
			$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
		

$sql = "UPDATE $location 
				SET pic='$pic',fullname='$fullname',lastname='$lname',firstname='$fname',middlename='$mname',dob='$dob',grade='$grade'
				WHERE id=".$id;
				
				
				
						
		if($conn->query($sql) === TRUE)
		{
		
			echo " Successfully Updated \n";			
		
					
               $purpose="Update Student: Fullname:$fullname Dob: $dob Grade: $grade";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$id','$purpose','$updated_at')";
			
  if ($conn->query($sqltr) === TRUE) {
 
  
} else {
    echo "Error3: " . $sqltr . "<br>" . $conn->error;
}		
			
				}
				else
				{
					echo "Error updation : $location 	 ".$conn->error;

//echo "$name\n";
//echo "$dob\n";


						}	







} else {
			
	$action="Update Students info";	
	
      	    
      $location="Students";
        $fullname = $_POST["fullname"];
		$fname = $_POST["fname"];
		$mname = $_POST["mname"];
		$lname = $_POST["lname"];
		$grade = $_POST["grade"];
		$dob= $_POST["dob"];
		$id= $_POST["id"];
		
			$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
		

$sql = "UPDATE $location 
				SET fullname='$fullname',lastname='$lname',firstname='$fname',middlename='$mname',dob='$dob',grade='$grade'
				WHERE id=".$id;
				
				
				
						
		if($conn->query($sql) === TRUE)
		{
		
			echo " Successfully Updated \n";			
		
					
               $purpose="Update Student: Fullname:$fullname Dob: $dob Grade: $grade";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$id','$purpose','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
 
  
} else {
    echo "Error3: " . $sqltr . "<br>" . $conn->error;
}		
			
				}
				else
				{
					echo "Error updation : $location 	 ".$conn->error;

//echo "$name\n";
//echo "$dob\n";


						}	     
}








//echo" $json ";




      
			
							
	
	
	}
						

			
						
	function Update_warehouse()
{

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Update Book";
$userid = $_SESSION[$sid]['userid'];

	//variables

	
	$updated_at = date("Y-m-d h:i:s");
	
			
	//Checking for the presents of the required variables  -
	if(isset($_REQUEST["id"]) && isset($_REQUEST["name"]) && isset($_REQUEST["isbn"]))
	{
		$id= $_REQUEST["id"]; 
		$isbn = $_REQUEST["isbn"]; 
		$name = $_REQUEST["name"];
		$subject= $_REQUEST["subject"];
        $book = $_REQUEST["book"];
		$auth = $_REQUEST["auth"];
       $location = $_REQUEST["location"];
       $status = $_REQUEST["status"];
       $pub = $_REQUEST["pub"];
	   $instock= $_REQUEST["instock"];
     
		
		
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
		
	
	
		$sql = "UPDATE $location 
				SET isbn='$isbn',name='$name',subject='$subject',books='$book',auth='$auth',instock='$instock',pub='$pub',status='$status'
				WHERE id='$id'";
				
				
						
		if($conn->query($sql) === TRUE)
		{
			echo "Updated Successfully";
			
			//Update individual line items   -Imani Sterling|| 2018
			//$id = mysqli_insert_id($conn); //Get the inserted ID for the Receival that was inserted above -Imani Sterling|| 2018
			
					
               $purpose="Update Inventory book:$name Auth:$auth subject: $subject Instock: $instock ";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$id','$purpose','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
  	$uid = mysqli_insert_id($conn);
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   
  
  
} else {
    echo "Error3: " . $sqltr . "<br>" . $conn->error;
}		
					
					
					
			
				}
				else
				{
					echo "Error updating Price: 	 ".$conn->error;
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
		
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Add Usage";
$userid = $_SESSION[$sid]['userid'];
	
	//variables
	$sql = "";
	$Invoice_Number = "";
	$Usagedate = "";
	$Purpose = "";
	$Equipment = "";
	$Req="";
	$Inline_items = "";
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	
			
	
	if(isset($_REQUEST["Invoice_Number"]) && isset($_REQUEST["Recdate"]) && isset($_REQUEST["Purpose"]) && isset($_REQUEST["Inline_items"]))
	{
		$Invoice_Number = $_REQUEST["Invoice_Number"];
		
		$Usagedate = $_REQUEST["Recdate"];
		$Purpose = $_REQUEST["Purpose"];
		//$Equipment = $_REQUEST["Equipment"];
		$jname = $_REQUEST["jname"];
		$location = $_REQUEST["location"];
		$Inline_items = $_REQUEST["Inline_items"];
	   // $Insertqty= $_REQUEST["insertqty"];
	   
	   
	}
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
	
	
	
	$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
						$quantity=$item_objects[$x]['quantity'];
						$stock=$item_objects[$x]['Stock_ID'];
						
			}
			
				 $sql ="SELECT * FROM $location WHERE id ='$stock'";
		
		     $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $instock= $row["instock"];
	  $code= $row["code"];
	  $name=$row["name"];
	  $unitcost=$row["unit_cost"];
	
	}}	
			
			
			$qty=$quantity;
			
			if($qty<=$instock){
				
	
			$sql = "INSERT INTO usages(invoice_number, usagedate, purpose, equipment_id,created_at)
			VALUES ('$Invoice_Number', '$Usagedate', '$Purpose','$Equipment','$created_at')";
						
	if($conn->query($sql) === TRUE){
		$id = mysqli_insert_id($conn);
	
				}		
}	
			
			
			
			
			
	
	if($quantity==null){
		echo "Please Enter Quantity\n  $Usagedate";
	exit;
	}
	if($stock==null){
		echo "Please Enter Stock Type\n";
	exit;
	}
	
	
	

	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
			
		

		
			$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				
					// $id=$item_objects[$x]['Item_ID'];	
		      $stock_id=$item_objects[$x]['Stock_ID'];
		      $qty=$item_objects[$x]['quantity'];
			  $spoil=$item_objects[$x]['spoil'];
		      $type=$item_objects[$x]['Type'];
	
			
			     
			      	
						 $sql ="SELECT * FROM $location WHERE id ='$stock_id'";
		
		     $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $instock= $row["instock"];
	  $code= $row["code"];
	  $name=$row["name"];
	  $unitcost=$row["unit_cost"];
	
	}}	
		
	$sql1 ="SELECT * FROM price WHERE code ='$code'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$unit_cost= $row["unit_cost"];
	//$size= $row["size"];
	
	}
}
	


	$cost=$qty*$unitcost;
	$spcost=$spoil*$unitcost;	
		
			
			if($qty<=$instock){
				
				 
              	$item=$name;
              
			   	
				
			
					
	
		$sql1 = "INSERT INTO usage_lineitems(usage_id,req_by,cost,spoilcost,items,stock_id,qty,spoilage,created_at,equip,location)
					VALUES ('$id','$jname','$cost','$spcost','$item','$stock_id','$qty','$spoil','$created_at','$type','$location')";
				//echo "[".$sql."]";				
				if($conn->query($sql1) === TRUE)
				
				{
					$info="Jobname: $jname Type:$type  Item: $item   spoil: $spoil spcost: $ $spcost  sheets: $qty  cost: $ $cost";
					
					$sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   } else {
    echo "here Error: " . $sqltr . "<br>" . $conn->error;
}	

	
					
					$sql = "UPDATE $location
							SET instock = instock - $qty,cost=cost-$cost
							WHERE id=".$item_objects[$x]['Stock_ID'];
									
					if($conn->query($sql) === TRUE)
					{
						echo "Internal PO Created \n";
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
						$sql ="DELETE  FROM usages WHERE id  ='$id'";
		$result = $conn->query($sql);
					
				}
				
	
		
				

	
			

}
else{
	$amount=$qty-$instock;
	echo "You have exceeded stock amount by: $amount  Instock: $instock";
	
}	



		}

}
	
		
		$conn->close();
	



}

function Add_rental()  //This is where we add the usage request 
{
		
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Add Student Rental";
$userid = $_SESSION[$sid]['userid'];
	
	//variables
	$sql = "";

	$Inline_items = "";
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	
			
	
	if(isset($_REQUEST["sid"]) && isset($_REQUEST["Recdate"]) && isset($_REQUEST["fname"]) && isset($_REQUEST["Inline_items"]))
	{
		$sid = $_REQUEST["sid"];
		
		$Usagedate=$_REQUEST["Recdate"];
		$fname=$_REQUEST["fname"];
		//$Equipment = $_REQUEST["Equipment"];
		$dob=$_REQUEST["dob"];
		$grade=$_REQUEST["grade"];
		$Inline_items=$_REQUEST["Inline_items"];
	   // $Insertqty= $_REQUEST["insertqty"];
	   
	   
	}
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
		
		$sql ="SELECT * FROM Students WHERE id='$sid'";
		    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $firstname= $row["firstname"];
	 $middlename= $row["middlename"];
	   $lastname= $row["lastname"];
	
	}}	
			
	$sql = "INSERT INTO rental(stu_id, name, dob, grade,date)
			VALUES ('$sid', '$fname', '$dob','$grade','$Usagedate')";
						
	if($conn->query($sql) === TRUE){
		$id = mysqli_insert_id($conn);
	
				}	
	
	
	$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
						$quantity=$item_objects[$x]['quantity'];
						$isbn=$item_objects[$x]['isbn'];
			
			$sql ="SELECT * FROM Warehouse1 WHERE isbn='$isbn'";
		    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $instock= $row["instock"];
	
	
	}}	
			
			
			$qty=$quantity;
			
		
	

	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
			
		

		
		
				
					// $id=$item_objects[$x]['Item_ID'];	
		      $name=$item_objects[$x]['name'];
		     
			  $isnb=$item_objects[$x]['isnb'];
			  $barcode=$item_objects[$x]['barcode'];
		      $auth=$item_objects[$x]['auth'];
	          $cond=$item_objects[$x]['cond'];
			
			     
			      	
						  $sql ="SELECT * FROM Warehouse1 WHERE isbn='$isbn'";
		
		     $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $instock= $row["instock"];
	
	
	}}	
		
		
			
			if($qty<=$instock){
				
	
		$sql1 = "INSERT INTO rent_lineitems(rent_id,stu_id,barcode,isbn,name,cond,auth,qty,created_at)
					VALUES ('$id','$sid','$barcode','$isbn','$name','$cond','$auth','$qty','$Usagedate')";
				//echo "[".$sql."]";				
				if($conn->query($sql1) === TRUE)
				
				{
					
					$return="";
					$sql1 = "INSERT INTO checkbook(fullname,first_name,middle_name,last_name,num_ref,book_title,cond,rent_date,return_date)
					VALUES ('$fname','$firstname','$middlename','$lastname','$barcode','$name','$cond','$Usagedate','$return')";
				//echo "[".$sql."]";				
				if($conn->query($sql1) === TRUE)
				
				{
					
				}else {
    echo "Error: Inserting into checkbook " . $sql1 . "<br>" . $conn->error;
}
					
					
					
					
					  $info="Student Name: $fname  Book name: $name   ISBN: $isbn Barcode: $barcode  Qty: $qty";
					
					  $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   } else {
    echo "here Error: " . $sqltr . "<br>" . $conn->error;
}	

	
					
					$sql = "UPDATE Warehouse1
							SET instock = instock - $qty
							WHERE isbn=".$item_objects[$x]['isbn'];
									
					if($conn->query($sql) === TRUE)
					{
						echo "Process Completed\n";
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database:Rent_lineitems ".$conn->error;
						$sql ="DELETE  FROM rental WHERE id  ='$id'";
		$result = $conn->query($sql);
					
				}
				
	
		
				

	
			

}
else{
	$amount=$qty-$instock;
	echo "You have exceeded stock amount by: $amount  Instock: $instock\n";
	echo "Book: $name  \n";
	echo "ISBN: $isbn \n";
	$sql = "DELETE FROM rental WHERE id='$id'";
						
	if($conn->query($sql) === TRUE){
		
	
				}	
	
}	


}
		

}
	
		
		$conn->close();
	



}



function Add_rental_teacher()  //This is where we add the usage request 
{
		
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Add Teacher Rental";
$userid = $_SESSION[$sid]['userid'];
	
	//variables
	$sql = "";

	$Inline_items = "";
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	
			
	
	if(isset($_POST["sid"]) && isset($_POST["Recdate"]) && isset($_POST["fname"]) && isset($_POST["Inline_items"]))
	{
		$sid = $_POST["sid"];
		
		$Usagedate=$_POST["Recdate"];
		$fname=$_POST["fname"];
		//$Equipment = $_REQUEST["Equipment"];
		
		$Inline_items=$_POST["Inline_items"];
	   // $Insertqty= $_REQUEST["insertqty"];
	   
	   
	}
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
		
		$sql ="SELECT * FROM Teachers WHERE id='$sid'";
		    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $firstname= $row["firstname"];
	
	   $lastname= $row["lastname"];
	   $staff_id=$row["staff_id"];
	
	}}	
			
	$sql = "INSERT INTO rental_teacher(tid,staff_id,name,date)
			VALUES ('$sid','$staff_id', '$fname','$Usagedate')";
						
	if($conn->query($sql) === TRUE){
		$id = mysqli_insert_id($conn);
	
				}	
	
	
	$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
						$quantity=$item_objects[$x]['quantity'];
						$isbn=$item_objects[$x]['isbn'];
			
			$sql ="SELECT * FROM Warehouse1 WHERE isbn='$isbn'";
		    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $instock= $row["instock"];
	
	
	}}	
			
			
			$qty=$quantity;
			
		
	

	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
			
		

		
		
				
					// $id=$item_objects[$x]['Item_ID'];	
		      $name=$item_objects[$x]['name'];
		     
			  $isnb=$item_objects[$x]['isnb'];
			  $barcode=$item_objects[$x]['barcode'];
		      $auth=$item_objects[$x]['auth'];
	          $cond=$item_objects[$x]['cond'];
			
			     
			      	
						  $sql ="SELECT * FROM Warehouse1 WHERE isbn='$isbn'";
		
		     $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $instock= $row["instock"];
	
	
	}}	
		
		
			
			if($qty<=$instock){
				
	
		$sql1 = "INSERT INTO rentteacher_lineitems(rent_id,tid,barcode,isbn,name,cond,auth,qty,created_at)
					VALUES ('$id','$sid','$barcode','$isbn','$name','$cond','$auth','$qty','$Usagedate')";
				//echo "[".$sql."]";				
				if($conn->query($sql1) === TRUE)
				
				{
					//this will change to teacher book status ============------------------=========
					$return="";
					/*$sql1 = "INSERT INTO checkbook(fullname,first_name,middle_name,last_name,num_ref,book_title,cond,rent_date,return_date)
					VALUES ('$fname','$firstname','$middlename','$lastname','$barcode','$name','$cond','$Usagedate','$return')";
				//echo "[".$sql."]";				
				if($conn->query($sql1) === TRUE)
				
				{
					
				}else {
    echo "Error: Inserting into checkbook " . $sql1 . "<br>" . $conn->error;
}
		[[[[[[[[[[[]]]]]]]]]]]ppppppppp			
	*/				
					
					
					  $info="Teacher Name: $fname  Book name: $name   ISBN: $isbn Barcode: $barcode  Qty: $qty";
					
					  $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   } else {
    echo "here Error: " . $sqltr . "<br>" . $conn->error;
}	

	
					
					$sql = "UPDATE Warehouse1
							SET instock = instock - $qty
							WHERE isbn=".$item_objects[$x]['isbn'];
									
					if($conn->query($sql) === TRUE)
					{
						echo "Process Completed\n";
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database:Rent_lineitems ".$conn->error;
						$sql ="DELETE  FROM rental_teacher WHERE id  ='$id'";
		$result = $conn->query($sql);
					
				}
				
	
		
				

	
			

}
else{
	$amount=$qty-$instock;
	echo "You have exceeded stock amount by: $amount  Instock: $instock\n";
	echo "Book: $name  \n";
	echo "ISBN: $isbn \n";
	$sql = "DELETE FROM rental_teacher WHERE id='$id'";
						
	if($conn->query($sql) === TRUE){
		
	
				}	
	
}	


}
		

}
	
		
		$conn->close();
	



}






function Add_return()  //This is where we add the usage request 
{
		
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Add Student Return";
$userid = $_SESSION[$sid]['userid'];
	
	//variables
	$sql = "";

	$Inline_items = "";
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	
			
	
	if(isset($_REQUEST["sid"]) && isset($_REQUEST["Recdate"]) && isset($_REQUEST["fname"]) && isset($_REQUEST["Inline_items"]))
	{
		$sid = $_REQUEST["sid"];
		
		$returndate=$_REQUEST["Recdate"];
		$fname=$_REQUEST["fname"];
		//$Equipment = $_REQUEST["Equipment"];
		$dob=$_REQUEST["dob"];
		$grade=$_REQUEST["grade"];
		$Inline_items=$_REQUEST["Inline_items"];
	   // $Insertqty= $_REQUEST["insertqty"];
	   
	   
	}
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
	
	
	
	$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			

			
				
	
			$sql = "INSERT INTO returnbook(sid, name, dob, grade,date)
			VALUES ('$sid', '$fname', '$dob','$grade','$returndate')";
						
	if($conn->query($sql) === TRUE){
		$id = mysqli_insert_id($conn);
	
				}		

 
	

	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
			
		

		
			$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				
					// $id=$item_objects[$x]['Item_ID'];	
		      $name=$item_objects[$x]['name'];
		     
			  $isbn=$item_objects[$x]['isbn'];
			  $barcode=$item_objects[$x]['barcode'];
		      $auth=$item_objects[$x]['auth'];
	          $cond=$item_objects[$x]['returncond'];
              $qty=$item_objects[$x]['quantity'];
              
	
		$sql1 = "INSERT INTO return_lineitems(return_id,stu_id,barcode,isbn,name,cond,auth,qty,created_at)
					VALUES ('$id','$sid','$barcode','$isbn','$name','$cond','$auth','$qty','$returndate')";
				//echo "[".$sql."]";				
				if($conn->query($sql1) === TRUE)
				
				{
					  $info="Student Name: $fname  Book name: $name   ISBN: $isbn Barcode: $barcode  Qty: $qty";
					
					  $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   } else {
    echo "here Error: " . $sqltr . "<br>" . $conn->error;
}	
    
	
					
					$sql = "UPDATE Warehouse1
							SET instock = instock + $qty
							WHERE isbn=".$item_objects[$x]['isbn'];
									
					if($conn->query($sql) === TRUE)
					{
						echo "Process Completed\n";
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
					
					
					$sql1 = "UPDATE Barcode
							SET cond = '$cond'
							WHERE barcode=".$item_objects[$x]['barcode'];
									
					if($conn->query($sql1) === TRUE)
					{
						//echo "Process Completed\n";
					}
					else
					{
						echo "Error while updating barcode: ".$conn->error;
					}
				
				
						$sql1 = "Update checkbook SET return_date='$returndate'
				          WHERE fullname='$fname' AND num_ref=".$item_objects[$x]['barcode'];
				//echo "[".$sql."]";				
				if($conn->query($sql1) === TRUE)
				
				{
					
				}else {
    echo "Error: Inserting into checkbook " . $sql1 . "<br>" . $conn->error;
}
				
				
				
				
				
					
				
				}
				else
				{
					echo "Error while inserting into database:Return_lineitems ".$conn->error;
						$sql ="DELETE  FROM returnbook WHERE id  ='$id'";
		$result = $conn->query($sql);
					
				}
				


		}

}
	
		
		$conn->close();
	



}



function Add_returnt()  //This is where we add the usage request 
{
		
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Add Teacher Return";
$userid = $_SESSION[$sid]['userid'];
	
	//variables
	$sql = "";

	$Inline_items = "";
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	
			
	
	if(isset($_REQUEST["sid"]) && isset($_REQUEST["Recdate"]) && isset($_REQUEST["fname"]) && isset($_REQUEST["Inline_items"]))
	{
		$sid = $_REQUEST["sid"];
		
		$returndate=$_REQUEST["Recdate"];
		$fname=$_REQUEST["fname"];
		
	
		$Inline_items=$_REQUEST["Inline_items"];
	   
	   
	   
	}
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
	
	
	
	$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			

			
				
	
			$sql = "INSERT INTO returnbookt(tid,name,date)
			VALUES ('$sid','$fname','$returndate')";
						
	if($conn->query($sql) === TRUE){
		$id = mysqli_insert_id($conn);
	
				}		

 
	

	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
			
		

		
			$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				
					// $id=$item_objects[$x]['Item_ID'];	
		      $name=$item_objects[$x]['name'];
		     
			  $isbn=$item_objects[$x]['isbn'];
			  $barcode=$item_objects[$x]['barcode'];
		      $auth=$item_objects[$x]['auth'];
	          $cond=$item_objects[$x]['returncond'];
              $qty=$item_objects[$x]['quantity'];
              
	
		$sql1 = "INSERT INTO return_lineitemst(return_id,tid,barcode,isbn,name,cond,auth,qty,created_at)
					VALUES ('$id','$sid','$barcode','$isbn','$name','$cond','$auth','$qty','$returndate')";
				//echo "[".$sql."]";				
				if($conn->query($sql1) === TRUE)
				
				{
					  $info="Teacher Name: $fname  Book name: $name   ISBN: $isbn Barcode: $barcode  Qty: $qty";
					
					  $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   } else {
    echo "here Error: " . $sqltr . "<br>" . $conn->error;
}	
    
	
					
					$sql = "UPDATE Warehouse1
							SET instock = instock + $qty
							WHERE isbn=".$item_objects[$x]['isbn'];
									
					if($conn->query($sql) === TRUE)
					{
						if($x==0){
						echo "Process Completed \n";	
						}
						
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
					
					
					$sql1 = "UPDATE Barcode
							SET cond = '$cond'
							WHERE barcode=".$item_objects[$x]['barcode'];
									
					if($conn->query($sql1) === TRUE)
					{
						//echo "Process Completed\n";
					}
					else
					{
						echo "Error while updating barcode: ".$conn->error;
					}
				
				
						$sql1 = "Update checkbook SET return_date='$returndate'
				          WHERE fullname='$fname' AND num_ref=".$item_objects[$x]['barcode'];
				//echo "[".$sql."]";				
				if($conn->query($sql1) === TRUE)
				
				{
					
				}else {
    echo "Error: Inserting into checkbook " . $sql1 . "<br>" . $conn->error;
}
				
				
				
				
				
					
				
				}
				else
				{
					echo "Error while inserting into database:Return_lineitems ".$conn->error;
						$sql ="DELETE  FROM returnbooks WHERE id  ='$id'";
		$result = $conn->query($sql);
					
				}
				


		}

}
	
		
		$conn->close();
	



}










 
/** 
*	@Discription:	Remove the given usage from the usage table along with its line items
*	
*	@param (void)
*
*	@return (void)
*/
function Remove_Usage()
{

$created_at = date("Y-m-d h:i:s");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Remove Usage";
$userid = $_SESSION[$sid]['userid'];

	$sql = "";
	

		
	
	
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
	
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
				
				$location=$row["location"];
				$stock_id=$row["stock_id"];
				$cost=$row["cost"];
                $qty=$row["qty"];
				
				$sql2 = "UPDATE $location SET instock = instock + $qty,cost=cost+$cost WHERE id=$stock_id";
	
	
				if ($conn->query($sql2) === TRUE)
			{
				
			}
		else
		{
			echo "Error updating record: " . $conn->error;
		}
		}
		}
	$sql = "DELETE FROM usage_lineitems WHERE usage_id=".$id;
			
			$sql2 = "DELETE FROM usages WHERE id=".$id;
			
			if ($conn->query($sql) === TRUE)
			{
			echo "Internal PO Deleted \n";	
			$result = $conn->query($sql2);
			}
			else
			{
				echo "Error deleting record: " . $conn->error;
			}

	
	$info="Quantity :$qty  Cost: $cost";
				   
				   
	
	$sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$stock_id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     
   } 				
	


	
	
	
	
	
	
	
	}
	
	
		$conn->close();
	
}

function Del_Usage()
{

$created_at = date("Y-m-d h:i:s");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Delete Usage";
$userid = $_SESSION[$sid]['userid'];

	$sql = "";
	

	
	
		$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
	if(isset($_REQUEST["id"]))
	{
		$id = $_REQUEST["id"];
		$sql3="SELECT * FROM usage_lineitems 
		WHERE id=".$id;
		
		$result= $conn->query($sql3);
		
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				$location=$row["location"];
				$stock_id=$row["stock_id"];
				$cost=$row["cost"];
                $qty=$row["qty"];
				
				$sql2 = "UPDATE $location SET instock = instock + $qty,cost=cost+$cost WHERE id=$stock_id";
	
	
				if ($conn->query($sql2) === TRUE)
			{
				
			}
		else
		{
			echo "Error updating record: " . $conn->error;
		}
		}
		}
	$sql = "DELETE FROM usage_lineitems WHERE id=".$id;
			
	if ($conn->query($sql) === TRUE)
			{
				echo "Item Deleted";
			}
	
	$info="Quantity :$qty  Cost: $cost";
				   
				   
	
	$sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$stock_id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     
   } 				
	


	
	
	
	
	
	
	
	}
	
	
		$conn->close();
	
}




function Del_Usaget()
{

$created_at = date("Y-m-d h:i:s");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Delete Teacher Return Books";
$userid = $_SESSION[$sid]['userid'];

	$sql = "";
	

	
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
	
	if(isset($_REQUEST["id"]))
	{
		$id = $_REQUEST["id"];
		$sql3="SELECT * FROM return_lineitemst 
		WHERE id=".$id;
		
		$result= $conn->query($sql3);
		
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				
				$isbn=$row["isbn"];
				$barcode=$row["barcode"];
                $qty=$row["qty"];
				
				$sql2 = "UPDATE Warehouse1 SET instock = instock - $qty WHERE isbn=$isbn";
	
	
				if ($conn->query($sql2) === TRUE)
			{
				
			}
		else
		{
			echo "Error updating record: " . $conn->error;
		}
		}
		}
	$sql = "DELETE FROM return_lineitemst WHERE id=".$id;
			
	if ($conn->query($sql) === TRUE)
			{
				echo "Item Deleted";
			}
	
	$info="Quantity :$qty  ISBN: $isbn";
				   
				   
	
	$sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$stock_id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     
   } 				
	


	
	
	
	
	
	
	
	}
	
	
		$conn->close();
	
}








/** 
*	
*	
*	@param (void)
*
*	@return (String) JSON ended formatted output
*/

function Basic_rental_info()
{
	
	$sql = "";
	$formatted_result=""; 
	
	

	if(isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
		
		 
			//$sql="SELECT rental.*, rent_lineitems.*
		   // FROM rental
			//INNER JOIN rent_lineitems
			//ON rental.id=rent_lineitems.rent_id
		   // WHERE rent_lineitems.rent_id=".$id;
			
					$sql="SELECT * 
		   FROM rental WHERE rental.id=".$id;
			
			
	}

	
		
	
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
				$json_encoded_out = array('sid' => $row["stu_id"],'name' => $row["name"], 'dob' => $row["dob"], 'grade' => $row["grade"], 'date' =>$row["date"].'');
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


function Basic_rental_teacher_info()
{
	
	$sql = "";
	$formatted_result=""; 
	
	

	if(isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
		
		 
			//$sql="SELECT rental.*, rent_lineitems.*
		   // FROM rental
			//INNER JOIN rent_lineitems
			//ON rental.id=rent_lineitems.rent_id
		   // WHERE rent_lineitems.rent_id=".$id;
			
					$sql="SELECT * 
		   FROM rental_teacher WHERE rental_teacher.id=".$id;
			
			
	}

	
		
	
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
				$json_encoded_out = array('sid' => $row["1"],'name' => $row["name"], 'dob' => $row["tid"], 'grade' => $row["staff_id"], 'date' =>$row["date"].'');
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






function Basic_return_info()
{
	
	$sql = "";
	$formatted_result=""; 
	
	

	if(isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
		
		 
			//$sql="SELECT rental.*, rent_lineitems.*
		   // FROM rental
			//INNER JOIN rent_lineitems
			//ON rental.id=rent_lineitems.rent_id
		   // WHERE rent_lineitems.rent_id=".$id;
			
					$sql="SELECT * 
		   FROM returnbook WHERE returnbook.id=".$id;
			
			
	}

	
		
	
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
				$json_encoded_out = array('sid' => $row["sid"],'name' => $row["name"], 'dob' => $row["dob"], 'grade' => $row["grade"], 'date' =>$row["date"].'');
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




function Basic_returnt_info()
{
	
	$sql = "";
	$formatted_result=""; 
	
	

	if(isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
		
		 
			//$sql="SELECT rental.*, rent_lineitems.*
		   // FROM rental
			//INNER JOIN rent_lineitems
			//ON rental.id=rent_lineitems.rent_id
		   // WHERE rent_lineitems.rent_id=".$id;
			
					$sql="SELECT * 
		   FROM returnbookt WHERE returnbookt.id=".$id;
			
			
	}

	
		
	
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
				$json_encoded_out = array('sid' => $row["sid"],'name' => $row["name"], 'date' =>$row["date"].'');
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







function Basic_checkbook_info()
{
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	$sql = "";
	$formatted_result=""; 
	
	

	if(isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
		
		 
			
		$sql1=" SELECT fullname
		   FROM checkbook WHERE id='$id'";
		   
		    $result = $conn->query($sql1);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$fullname= $row["fullname"];
		//$firstname= $row["first_nanme"];
	//	$middlename= $row["middle_name"];
	  //$lastname= $row["last_name"];
	
	}
}
	
				$sql="SELECT * 
		   FROM checkbook WHERE fullname='$fullname'";
			
			
	}

	
		
	
	
					
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
				$json_encoded_out = array('fullname' => $row["fullname"].'');
				$json_encoded_out = json_encode($json_encoded_out);
				
				$formatted_result=$json_encoded_out;
			}
	
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





function Basic_Usage_info()
{
	
	$sql = "";
	$formatted_result=""; 
	
	

	if(isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
		
		 
			$sql="SELECT usages.*, usage_lineitems.*
		    FROM usages
			INNER JOIN usage_lineitems
			ON usages.id=usage_lineitems.usage_id
		    WHERE usage_lineitems.usage_id=".$id;
			
			
			
	}

	
	
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
				$json_encoded_out = array('ID' => $row["id"],'job_id' => $row["job_id"], 'Invoice_Number' => $row["invoice_number"], 'Usagedate' => ''.$row["usagedate"].'', 'jname' => ''.$row["req_by"].'','location' => ''.$row["location"].'', 'Purpose' => ''.$row["purpose"].'','Req' => ''.$row["req_by"].'', 'Equipment' => ''.$row["equipment_id"].'');
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




/** 
*	@Discription:	Get the the usage inline items from the inline item table and format the output for JSON
*	
*	@param (Integer) $id - The id numbere for the receival
*
*	@return (String) JSON formatted output
*/
function Get_Usage_line_items_JSON()
{
	
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors
	if(isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
	//$job_id=$_REQUEST["job_id"];
	//echo "$invoice";
		
	 $sql = "SELECT usages.*, usage_lineitems.*
		    FROM usages
			INNER JOIN usage_lineitems 
			ON usages.id=usage_lineitems.usage_id
			WHERE usage_lineitems.usage_id=$id";
		
	/* 			
	  $sql = "SELECT usages.*, usage_lineitems.*
		    FROM usage_lineitems
			INNER JOIN usages 
			ON usage_lineitems.invoice=usages.invoice_number
			WHERE usage_lineitems.invoice=".$invoice;
	 */	
	}
					  

	
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
			$line_items = array();
			
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				//$reams=$row["reams"];
				$line_item = array('id' => $row["id"],'item' => $row["items"], 'stock_id' => $row["stock_id"], 'qty' => $row["qty"], 'spoilage' => $row["spoilage"], 'equip' => $row["equip"], 'usage_id' => $row["usage_id"], 'size' => $row["size"]);
				
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



function Get_rental_line_items_JSONt()
{
	
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors
	if(isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
		
		
	//$job_id=$_REQUEST["job_id"];
	//echo "$invoice";
		
	/* $sql = "SELECT rental.*, rent_lineitems.*
		    FROM rental
			INNER JOIN rent_lineitems 
			ON rental.id=rent_lineitems.rent_id
			WHERE rent_lineitems.rent_id=$id";
		
		*/
		$sql = "SELECT rentteacher_lineitems.*,Barcode.barcode,Barcode.isbn AS ISBN
		    FROM rentteacher_lineitems
		    INNER JOIN Barcode
			ON rentteacher_lineitems.barcode=Barcode.barcode
			WHERE rentteacher_lineitems.rent_id=$id";
		 
		
		
		
	}
	

			  $db_servername = "localhost";
		$db_username = "dert1_pembrokehh";
		$db_password = "pembrokehhs";
		$db_name =  "dert1_pembrokehhs";
		
	
	$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);			  


		$result = $conn->query($sql);
			
		if ($result->num_rows > 0)
		{
			$line_items = array();
			
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				//$reams=$row["reams"];
				$line_item = array('rid' => $row["id"],'isbn' => $row["ISBN"],'barcode' => $row["barcode"], 'name' => $row["name"],'qty' => $row["qty"],'cond' => $row["cond"],'auth' => $row["auth"]);
				
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
	

	return $formatted_result;
}




function Get_return_line_items_JSON()
{
	
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors
	if(isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
		
		
	//$job_id=$_REQUEST["job_id"];
	//echo "$invoice";
		
	/* $sql = "SELECT rental.*, rent_lineitems.*
		    FROM rental
			INNER JOIN rent_lineitems 
			ON rental.id=rent_lineitems.rent_id
			WHERE rent_lineitems.rent_id=$id";
		
		*/
		$sql = "SELECT *
		    FROM return_lineitems 
		    WHERE return_lineitems.return_id=$id";
		 
		
		
		
	}
	

			  $db_servername = "localhost";
		$db_username = "dert1_pembrokehh";
		$db_password = "pembrokehhs";
		$db_name =  "dert1_pembrokehhs";
		
	
	$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);			  


		$result = $conn->query($sql);
			
		if ($result->num_rows > 0)
		{
			$line_items = array();
			
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				//$reams=$row["reams"];
				$line_item = array('rid' => $row["id"],'isbn' => $row["isbn"],'barcode' => $row["barcode"], 'name' => $row["name"],'qty' => $row["qty"],'cond' => $row["cond"],'auth' => $row["auth"]);
				
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
	

	return $formatted_result;
}


function Get_return_line_items_JSONt()
{
	
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors
	if(isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
		
		
	//$job_id=$_REQUEST["job_id"];
	//echo "$invoice";
		
	/* $sql = "SELECT rental.*, rent_lineitems.*
		    FROM rental
			INNER JOIN rent_lineitems 
			ON rental.id=rent_lineitems.rent_id
			WHERE rent_lineitems.rent_id=$id";
		
		*/
		$sql = "SELECT *
		    FROM return_lineitemst 
		    WHERE return_lineitemst.return_id=$id";
		 
		
		
		
	}
	

			  $db_servername = "localhost";
		$db_username = "dert1_pembrokehh";
		$db_password = "pembrokehhs";
		$db_name =  "dert1_pembrokehhs";
		
	
	$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);			  


		$result = $conn->query($sql);
			
		if ($result->num_rows > 0)
		{
			$line_items = array();
			
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				//$reams=$row["reams"];
				$line_item = array('rid' => $row["id"],'isbn' => $row["isbn"],'barcode' => $row["barcode"], 'name' => $row["name"],'qty' => $row["qty"],'cond' => $row["cond"],'auth' => $row["auth"]);
				
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
	

	return $formatted_result;
}





function Get_rental_line_items_JSON()
{
	
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors
	if(isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
		
		
	//$job_id=$_REQUEST["job_id"];
	//echo "$invoice";
		
	/* $sql = "SELECT rental.*, rent_lineitems.*
		    FROM rental
			INNER JOIN rent_lineitems 
			ON rental.id=rent_lineitems.rent_id
			WHERE rent_lineitems.rent_id=$id";
		
		*/
		$sql = "SELECT rent_lineitems.*,Barcode.barcode,Barcode.isbn AS ISBN
		    FROM rent_lineitems
		    INNER JOIN Barcode
			ON rent_lineitems.barcode=Barcode.barcode
			WHERE rent_lineitems.rent_id=$id";
		 
		
		
		
	}
	

			  $db_servername = "localhost";
		$db_username = "dert1_pembrokehh";
		$db_password = "pembrokehhs";
		$db_name =  "dert1_pembrokehhs";
		
	
	$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);			  


		$result = $conn->query($sql);
			
		if ($result->num_rows > 0)
		{
			$line_items = array();
			
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				//$reams=$row["reams"];
				$line_item = array('rid' => $row["id"],'isbn' => $row["ISBN"],'barcode' => $row["barcode"], 'name' => $row["name"],'qty' => $row["qty"],'cond' => $row["cond"],'auth' => $row["auth"]);
				
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
	

	return $formatted_result;
}








function Get_checkbook_JSON()
{
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors
	if(isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
		
		
				$sql1="SELECT fullname  
		   FROM checkbook WHERE id='$id'";
		   
		    $result = $conn->query($sql1);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$fullname= $row["fullname"];
	
	
	}
}

		$sql = "SELECT * FROM checkbook WHERE fullname='$fullname'";
		 
		
		
		
	}
		  


		$result = $conn->query($sql);
			
		if ($result->num_rows > 0)
		{
			$line_items = array();
			
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				//$reams=$row["reams"];
				$line_item = array('barcode' => $row["num_ref"],'name' => $row["book_title"],'cond' => $row["cond"],'rentdate' => $row["rent_date"],'rdate' => $row["return_date"]);
				
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
	

	return $formatted_result;
}






/** 
*	@Discription:	Remove the given usage inline item from th usage inline item table
*	
*	@param (void)
*
*	@return (void)
*/
function Remove_Usage_line_item()
{
	
	$sql = "";
	
	

	if(isset($_REQUEST["id"]))
	{
		$id = $_REQUEST["id"];
		$sql = "DELETE FROM usage_lineitems WHERE id=".$id;
		//echo "[".$sql."]";
	}
	
					
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


/** 
*	@Discription:	Update the details of a usage and also its line items, allowing for the adding off new line items in the update
*	
*	@param (void)
*
*	@return (void)
*/
function Update_Usage()
{
	require 'db.php';
$created_at = date("Y-m-d h:i:s");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Update Usage";
$userid = $_SESSION[$sid]['userid'];
	
	
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
	
			
	
	if(isset($_REQUEST["ID"]) && isset($_REQUEST["Invoice_Number"]) && isset($_REQUEST["Usagedate"]) && isset($_REQUEST["Purpose"]) && isset($_REQUEST["Equipment"]) && isset($_REQUEST["Inline_items"]))
	{
		$ID = $_REQUEST["ID"]; 
		$Item_ID = $_REQUEST["Item_ID"]; 
		$Invoice_Number = $_REQUEST["Invoice_Number"];
		$Usagedate = $_REQUEST["Usagedate"];
		$Purpose = $_REQUEST["Purpose"];
		$Equipment = $_REQUEST["Equipment"];
		$location = $_REQUEST["location"];
		$jname = $_REQUEST["jname"];
		$Inline_items = $_REQUEST["Inline_items"];
		$new_Inline_items = $_REQUEST["new_Inline_items"];
		
		
	}
	
	if(isset($_REQUEST["new_Inline_items"])){
		
			$ID = $_REQUEST["ID"]; 

		$Invoice_Number = $_REQUEST["Invoice_Number"];
		$Usagedate = $_REQUEST["Usagedate"];
		$Purpose = $_REQUEST["Purpose"];
		$Equipment = $_REQUEST["Equipment"];
		$location = $_REQUEST["location"];
		$jname = $_REQUEST["jname"];
	
		$add_item=$_REQUEST["new_Inline_items"];
		
		$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
					$item_objects = json_decode($add_item, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				
					// $id=$item_objects[$x]['Item_ID'];	
		      $stock_id=$item_objects[$x]['stock'];
		      $qty=$item_objects[$x]['qty'];
			  $spoil=$item_objects[$x]['spoil'];
		      $type=$item_objects[$x]['type'];
	
			
			     
			      	
						 $sql ="SELECT * FROM $location WHERE id ='$stock_id'";
		
		     $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $instock= $row["instock"];
	  $code= $row["code"];
	  $name=$row["name"];
	  $unitcost=$row["unit_cost"];
	
	}}	
		
	$sql1 ="SELECT * FROM price WHERE code ='$code'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$unit_cost= $row["unit_cost"];
	//$size= $row["size"];
	
	}
}
	


	$cost=$qty*$unitcost;
	$spcost=$spoil*$unitcost;	
		
			
			if($qty<=$instock){
				
				 
              	$item=$name;
              
			   	
				
			
					
	
		$sql1 = "INSERT INTO usage_lineitems(usage_id,req_by,cost,spoilcost,items,stock_id,qty,spoilage,created_at,equip,location)
					VALUES ('$ID','$jname','$cost','$spcost','$item','$stock_id','$qty','$spoil','$created_at','$type','$location')";
				//echo "[".$sql."]";				
				if($conn->query($sql1) === TRUE)
				
				{
					$info="Jobname: $jname Type:$type  Item: $item   spoil: $spoil spcost: $ $spcost  sheets: $qty  cost: $ $cost";
					
					$sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   } else {
    echo "here Error: " . $sqltr . "<br>" . $conn->error;
}	

	
					
					$sql = "UPDATE $location
							SET instock = instock - $qty,cost=cost-$cost
							WHERE id=".$item_objects[$x]['stock'];
									
					if($conn->query($sql) === TRUE)
					{
						echo "Item Added \n";
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
else{
	$amount=$qty-$instock;
	echo "You have exceeded stock amount by: $amount  Instock: $instock";
	
}	



		}
		
		
		
		
		
	}
					
	// Create connection to database
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
			
			$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
				for ($x = 0; $x < $number_of_inline_items; $x++){
				
				
			$id=$item_objects[$x]['Item_ID'];
			$sid=$item_objects[$x]['sid'];
		     $type=$item_objects[$x]['Type'];
			 $qtyB=$item_objects[$x]['Quantity'];
			 $spoilB=$item_objects[$x]['Spoilage'];
			
				
				$stock_id=$item_objects[$x]['Stock_ID'];
		  $sql1 ="SELECT * FROM $location WHERE id ='$stock_id'";
		
		     $result = $conn->query($sql1);

        if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
    
	      $instock=$row["instock"];
	      $code=$row["code"];
		  $unitcost=$row["unit_cost"];
	
	}}	
				$sql2= "SELECT * FROM usage_lineitems
			WHERE id=".$item_objects[$x]['sid'];		
			$result = $conn->query($sql2);
				if ($result->num_rows > 0)
		{	
		
			
	
			while($row = $result->fetch_assoc())
			{
				
				
			 $qtyA=$row["qty"];
			$spoilA=$row["spoilage"];
			}
			
			
		}
			
	   
		
		
if($qtyB<=$qtyA){
	$tamount=$qtyA-$qtyB;
}
			if($qtyB>=$qtyA){
	$tamount=$qtyB-$qtyA;
}
		
				
				
					$sql1 ="SELECT * FROM price WHERE code ='$code'";
		           $result = $conn->query($sql1);

             if ($result->num_rows > 0) {
             // output data of each row
            while($row = $result->fetch_assoc()) {
    
	         $unit_cost= $row["unit_cost"];
	         $size= $row["size"];
	
	}
			
}
				

			if($qtyB<=$qtyA)
						{
						     	$sql1 = "UPDATE usages
				SET invoice_number='$Invoice_Number', usagedate='".$Usagedate."', purpose='".$Purpose."', equipment_id=".$Equipment."
				WHERE id=".$id;
				
			//	echo $sql1;
						
		if($conn->query($sql1) === TRUE)
		{
			
			
			echo "Updated successfully";
		
						$updateqty=$qtyA-$qtyB;
							
							$cost=$updateqty*$unitcost;
							
							$sql1 = "UPDATE $location
						SET instock=instock+$updateqty,cost=cost+$cost
						WHERE id='$stock_id'";
						
								if($conn->query($sql1) === TRUE)
				{
				
					}		
					
								$sql = "UPDATE usage_lineitems
						SET stock_id=".$item_objects[$x]['Stock_ID'].",cost=cost-$cost,req_by='$jname',qty=qty-$updateqty,updated_at= '".$updated_at."'
						WHERE id=".$item_objects[$x]['sid'];
					//echo "[".$sql."]";			
				if($conn->query($sql) === TRUE)
				{
							
						
					}
							
					}
						}
else{
			
		$updateqty=$qtyB-$qtyA;
	if($updateqty<=$instock){
	$cost=$updateqty*$unitcost;	
							
							$sql1 = "UPDATE $location
						SET instock=instock-$updateqty,cost=cost-$cost
						WHERE id=".$stock_id;
						if($conn->query($sql1) === TRUE)
				{
				
					
		
					
								$sql = "UPDATE usage_lineitems
						SET stock_id=".$item_objects[$x]['Stock_ID'].",cost=cost+$cost,qty=qty+$updateqty,updated_at= '".$updated_at."'
						WHERE id=".$item_objects[$x]['sid'];
					//echo "[".$sql."]";			
				if($conn->query($sql) === TRUE)
				{
				echo "Updated successfully\n";
					}		
		}	
		
	}else

			{
				
				echo "Cannot update that Amount: $tamount  Instock: $instock";
			}
							
							
	
}
			
			 
			if($spoilB<=$spoilA)
						{
							
						$updatespoil=$spoilA-$spoilB;
							
							$spcost=$updatespoil*$unitcost;		
					
								$sql = "UPDATE usage_lineitems
						SET spoilcost=spoilcost-$spcost,spoilage=spoilage-$updatespoil, updated_at='$updated_at'
						WHERE id=".$item_objects[$x]['sid'];
					//echo "[".$sql."]";			
				if($conn->query($sql) === TRUE)
				{
					}
							
					}
else{
			
		$updatespoil=$spoilB-$spoilA;
							
							$spcost=$updatespoil*$unit_cost;		
					
								$sql = "UPDATE usage_lineitems
						SET stock_id=".$item_objects[$x]['Stock_ID'].",spoilcost=spoilcost+$spcost,spoilage=spoilage+$updatespoil, updated_at= '".$updated_at."'
						WHERE id=".$item_objects[$x]['sid'];
					//echo "[".$sql."]";			
				if($conn->query($sql) === TRUE)
				{
					}	
	
}
				

				
					 $info="Quantity: $tamount Cost:$  $cost Spoilage: $updatespoil Spoilcost: $spcost ";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$stock_id','$info','$created_at')";
			
         if ($conn->query($sqltr) === TRUE) {
         	$uid = mysqli_insert_id($conn);
           //$mess="Trace user  ";
	       //echo "$mess $username  $userid";
           } else 
           {
              echo "Error1: " . $sqltr . "<br>" . $conn->error;
           }
					
			
			
			
		
		}		
		
		}}



function Update_rental()
{
	require 'db.php';
$created_at = date("Y-m-d h:i:s");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Update Student Rental";
$userid = $_SESSION[$sid]['userid'];
	
	
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
	
			
	
	if(isset($_REQUEST["id"]) && isset($_REQUEST["name"]) && isset($_REQUEST["date"]) && isset($_REQUEST["grade"]) && isset($_REQUEST["Inline_items"]))
	{
		$id = $_REQUEST["id"]; 
		$fname = $_REQUEST["name"]; 
		$date = $_REQUEST["date"];
		$grade= $_REQUEST["grade"];
	
		$Inline_items = $_REQUEST["Inline_items"];
		$new_Inline_items = $_REQUEST["new_Inline_items"];
		
		
	}
	
	if(isset($_REQUEST["new_Inline_items"])){
		
		
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);	
		
			$id = $_REQUEST["id"]; 
		$fname = $_REQUEST["name"]; 
		$date = $_REQUEST["date"];
		$grade= $_REQUEST["grade"];
		
		
		$sql ="SELECT * FROM rental WHERE id='$id'";
		    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $sid= $row["stu_id"];
	
	
	}}	
		
	$sql ="SELECT * FROM Students WHERE id='$sid'";
		    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $firstname= $row["firstname"];
	 $middlename= $row["middlename"];
	   $lastname= $row["lastname"];
	
	}}	
			
		
		
		
	
	
		$add_item=$_REQUEST["new_Inline_items"];
		
		$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
					$item_objects = json_decode($add_item, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				
					// $id=$item_objects[$x]['Item_ID'];	
		      $rid=$item_objects[$x]['rid'];
		      $isbn=$item_objects[$x]['isbn'];
			  $barcode=$item_objects[$x]['barcode'];
		      $name=$item_objects[$x]['name'];
			  $cond=$item_objects[$x]['cond'];
	           $auth=$item_objects[$x]['auth'];
			    $qty=$item_objects[$x]['qty'];
			
			     
			      	
						 $sql ="SELECT * FROM Warehouse1 WHERE isbn ='$isbn'";
		
		     $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $instock= $row["instock"];
	
	
	}}	
		


		
			
			if($qty<=$instock){
				
		
					
	
		$sql1 = "INSERT INTO rent_lineitems(rent_id,stu_id,barcode,isbn,name,cond,auth,qty,created_at)
					VALUES ('$id','$sid','$barcode','$isbn','$name','$cond','$auth','$qty','$created_at')";
				if($conn->query($sql1) === TRUE)
				
				{
					$info="Title: $name isbn:isbn  Barcode: $barcode   auth: $auth qty: $qty";
					
					$sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   } else {
    echo "here Error: " . $sqltr . "<br>" . $conn->error;
}	

	
					
					$sql = "UPDATE Warehouse1
							SET instock = instock - $qty
							WHERE isbn=".$item_objects[$x]['isbn'];
									
					if($conn->query($sql) === TRUE)
					{
						echo "Book Added \n";
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
						$return="";
					$sql1 = "INSERT INTO checkbook(fullname,first_name,middle_name,last_name,num_ref,book_title,cond,rent_date,return_date)
					VALUES ('$fname','$firstname','$middlename','$lastname','$barcode','$name','$cond','$Usagedate','$return')";
				//echo "[".$sql."]";				
				if($conn->query($sql1) === TRUE)
				
				{
					
				}else {
    echo "Error: Inserting into checkbook " . $sql1 . "<br>" . $conn->error;
}
			
				
				
				
				
				
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
						
				}
				
	
		
				

	
			

}
else{
	$amount=$qty-$instock;
	echo "You have exceeded stock amount by: $amount  Instock: $instock\n";
	echo "Book: $name  \n";
	echo "ISBN: $isbn \n";
	
}	


		}
		
		
		
		
		
	}
					
	// Create connection to database
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	}





function Update_return()
{
	require 'db.php';
$created_at = date("Y-m-d h:i:s");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Update Student Return";
$userid = $_SESSION[$sid]['userid'];
	
	
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
	
			
	
	if(isset($_REQUEST["id"]) && isset($_REQUEST["name"]) && isset($_REQUEST["date"]) && isset($_REQUEST["grade"]) && isset($_REQUEST["Inline_items"]))
	{
		$id = $_REQUEST["id"]; 
		$fname = $_REQUEST["name"]; 
		$date = $_REQUEST["date"];
		$grade= $_REQUEST["grade"];
	
		$Inline_items = $_REQUEST["Inline_items"];
		$new_Inline_items = $_REQUEST["new_Inline_items"];
		
		
	}
	
	if(isset($_REQUEST["new_Inline_items"])){
		
		
		
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
		
		
		
			$id = $_REQUEST["id"]; 
		$fname = $_REQUEST["name"]; 
		$date = $_REQUEST["date"];
		$grade= $_REQUEST["grade"];
		
		
		
		
		$sql ="SELECT * FROM rental WHERE id='$id'";
		    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $sid= $row["stu_id"];
	
	
	}}	
		
	$sql ="SELECT * FROM Students WHERE id='$sid'";
		    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $firstname= $row["firstname"];
	 $middlename= $row["middlename"];
	   $lastname= $row["lastname"];
	
	}}	
			
		
		
		
		
		
	
	
		$add_item=$_REQUEST["new_Inline_items"];
		
		$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
					$item_objects = json_decode($add_item, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				
					// $id=$item_objects[$x]['Item_ID'];	
		      $rid=$item_objects[$x]['rid'];
		      $isbn=$item_objects[$x]['isbn'];
			  $barcode=$item_objects[$x]['barcode'];
		      $name=$item_objects[$x]['name'];
			  $cond=$item_objects[$x]['cond'];
	           $auth=$item_objects[$x]['auth'];
			    $qty=$item_objects[$x]['qty'];
			$returncond=$item_objects[$x]['returncond'];
		
					
	
		$sql1 = "INSERT INTO return_lineitems(return_id,stu_id,barcode,isbn,name,cond,auth,qty,created_at)
					VALUES ('$id','$sid','$barcode','$isbn','$name','$returncond','$auth','$qty','$created_at')";
				if($conn->query($sql1) === TRUE)
				
				{
					$info="Title: $name isbn:isbn  Barcode: $barcode   auth: $auth qty: $qty";
					
					$sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   } else {
    echo "here Error: " . $sqltr . "<br>" . $conn->error;
}	

	
					
					$sql = "UPDATE Warehouse1
							SET instock = instock + $qty
							WHERE isbn=".$item_objects[$x]['isbn'];
									
					if($conn->query($sql) === TRUE)
					{
						echo "Book Return \n";
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
				}
					
					
					
				$sql1 = "UPDATE Barcode
							SET cond = '$returncond'
							WHERE barcode=".$item_objects[$x]['barcode'];
									
					if($conn->query($sql1) === TRUE)
					{
						//echo "Process Completed\n";
					}
					else
					{
						echo "Error while updating barcode: ".$conn->error;
					}
				
				
						$sql1 = "Update checkbook SET return_date='$updated_at'
				          WHERE fullname='$fname' AND num_ref=".$item_objects[$x]['barcode'];
				//echo "[".$sql."]";				
				if($conn->query($sql1) === TRUE)
				
				{
					
				}else {
    echo "Error: Inserting into checkbook " . $sql1 . "<br>" . $conn->error;
}
				
					
					
					
					
					
					
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
						
				}




		}
		
		
		
		
		
	}
					
	}






function Update_returnt()
{
	require 'db.php';
$created_at = date("Y-m-d h:i:s");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Update teacher Return";
$userid = $_SESSION[$sid]['userid'];
	
	
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
	
			
	
	if(isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["date"]) && isset($_POST["Inline_items"]))
	{
		$id = $_POST["id"]; 
		$fname = $_POST["name"]; 
		$date = $_POST["date"];
		
	
		$Inline_items = $_POST["Inline_items"];
		//$new_Inline_items = $_POST["new_Inline_items"];
		
		
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
		
		
		
					$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				
					// $id=$item_objects[$x]['Item_ID'];	
		      $rid=$item_objects[$x]['rid'];
		      $isbn=$item_objects[$x]['isbn'];
			  $barcode=$item_objects[$x]['barcode'];
		      $name=$item_objects[$x]['name'];
			  $cond=$item_objects[$x]['cond'];
	           $auth=$item_objects[$x]['auth'];
			    $qty=$item_objects[$x]['qty'];
	
					
					
				$sql1 = "UPDATE Barcode
							SET cond = '$cond'
							WHERE barcode='$barcode'";
									
					if($conn->query($sql1) === TRUE)
					{
						//echo "Process Completed\n";
					}
					else
					{
						echo "Error while updating barcode: ".$conn->error;
					}
				
				$sql1 = "UPDATE return_lineitemst
							SET cond = '$cond'
							WHERE barcode='$barcode'";
									
					if($conn->query($sql1) === TRUE)
					{
						if($x==0){
						echo " Process Completed\n ";
						}
						
					}
					else
					{
						echo "Error while updating return: ".$conn->error;
					}
				
				
				}
				
		
		
	}
	
	if(isset($_POST["new_Inline_items"])){
		
		
		
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
		
		
		
			$id = $_POST["id"]; 
		$fname = $_POST["name"]; 
		$date = $_POST["date"];
	
		
		
		
		
		$sql ="SELECT * FROM returnbookt WHERE id='$id'";
		    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $sid= $row["tid"];
	
	
	}}	
		
	$sql ="SELECT * FROM Teachers WHERE id='$sid'";
		    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $name= $row["fullname"];

	
	}}	
			
		
		
		
		
		
	
	
		$add_item=$_REQUEST["new_Inline_items"];
		
		$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
					$item_objects = json_decode($add_item, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				
					// $id=$item_objects[$x]['Item_ID'];	
		      $rid=$item_objects[$x]['rid'];
		      $isbn=$item_objects[$x]['isbn'];
			  $barcode=$item_objects[$x]['barcode'];
		      $name=$item_objects[$x]['name'];
			  $cond=$item_objects[$x]['cond'];
	           $auth=$item_objects[$x]['auth'];
			    $qty=$item_objects[$x]['qty'];
			$returncond=$item_objects[$x]['returncond'];
		
					
	
		$sql1 = "INSERT INTO return_lineitemst(return_id,tid,barcode,isbn,name,cond,auth,qty,created_at)
					VALUES ('$id','$sid','$barcode','$isbn','$name','$returncond','$auth','$qty','$created_at')";
				if($conn->query($sql1) === TRUE)
				
				{
					$info="Title: $name isbn:isbn  Barcode: $barcode   auth: $auth qty: $qty";
					
					$sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   } else {
    echo "here Error: " . $sqltr . "<br>" . $conn->error;
}	

	
					
					$sql = "UPDATE Warehouse1
							SET instock = instock + $qty
							WHERE isbn=".$item_objects[$x]['isbn'];
									
					if($conn->query($sql) === TRUE)
					{
						echo "Book Return \n";
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
				}
					
					
					
				$sql1 = "UPDATE Barcode
							SET cond = '$returncond'
							WHERE barcode=".$item_objects[$x]['barcode'];
									
					if($conn->query($sql1) === TRUE)
					{
						//echo "Process Completed\n";
					}
					else
					{
						echo "Error while updating barcode: ".$conn->error;
					}
				
				
						$sql1 = "Update checkbook SET return_date='$updated_at'
				          WHERE fullname='$fname' AND num_ref=".$item_objects[$x]['barcode'];
				//echo "[".$sql."]";				
				if($conn->query($sql1) === TRUE)
				
				{
					
				}else {
    echo "Error: Inserting into checkbook " . $sql1 . "<br>" . $conn->error;
}
				
					
					
					
					
					
					
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
						
				}




		}
		
		
		
		
		
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
	
			
	//Checking for the presents of the required variables  -Imani Syerling|| 2018
	if(isset($_POST["type"]))
	{
		$box = $_POST["box"]; 
		$reams = $_POST["reams"]; 
		$singles = $_POST["singles"];
		$name = $_POST["name"];

	}

	// Create connection to database
	//$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);								
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










/** -Imani Syerling|| 2018
*	@Discription:	Requets from the server the default formated infromation in the Inventory table
*	
*	@param none
*
*	@return (String) HTML formatted table containing the results of the receival table
*/
function Generate_Inventory_table()
{  
	//Create SQL string -Imani Syerling|| 2018
	$sql = "SELECT stocks.id, fields.name as type, stocks.name, stocks.p1, stocks.p2, stocks.p3, stocks.small,stocks.large,stocks.papersize,stocks.sheet1,stocks.sheet2, stocks.instock, stocks.reorderlevel, stocks.cost
		    FROM stocks
			INNER JOIN fields
			ON stocks.field_id=fields.id ";

	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Imani Sterling|| 2018
	
	
	//If the individual is searching for specific vendors  -Imani Sterling|| 2018
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
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
					
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
												<td>'.$row["large"].  ' &nbsp &nbsp'.$row["papersize"].'</td>
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



/** -Imani Sterling|| 2018
*	@Discription:	Remove the given stock itm from the stocks
*	
*	@param (void)
*
*	@return (void)
*/
function Remove_Stock()
{
	//Create SQL string -Imani Sterling|| 2018
	$sql = "";
	$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Delete Students";
$userid = $_SESSION[$sid]['userid'];
$created_at = date("Y-m-d h:i:s");
	
	//Get the id of the usage being deleted  -Imani Sterling|| 2018
	if(isset($_REQUEST["id"]))
	{
		
		
		$id = $_REQUEST["id"];
		$location = $_REQUEST["location"];
		
		
			
		
		$sql = "DELETE FROM $location WHERE id=".$id;
		//echo "[".$sql."]";
	}
	
		$sql1="SELECT * FROM $location  WHERE id='$id'"; 		
		
		$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		
				$result = $conn->query($sql1);
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
			                                  
                                                $id=$row["id"];
										     
										       $name=$row["fullname"];
											   $dob=$row["dob"];
											   
											   $grade=$row["grade"];
											   $pic=$row["pic"];
										
			    }
}
		        $purpose="Students name: $name D.O.B: $dob Grade: $grade Image path: $pic";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$id','$purpose','$created_at')";
			  
			  	 if ($conn->query($sqltr) === TRUE) {
  
} else {
    echo "Error3: " . $sqltr . "<br>" . $conn->error;
}	
			
		
						
		if ($conn->query($sql) === TRUE)
		{
			echo "Record deleted\n";
		}
		else
		{
			echo "Error deleting record: " . $conn->error;
		}
		$conn->close();
	}
}



function Remove_barcode()
{
	//Create SQL string -Imani Sterling|| 2018
	$sql = "";
	$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Delete Students Barcode";
$userid = $_SESSION[$sid]['userid'];
$created_at = date("Y-m-d h:i:s");
	
	//Get the id of the usage being deleted  -Imani Sterling|| 2018
	if(isset($_REQUEST["id"]))
	{
		
		
		$id = $_REQUEST["id"];
		$location = $_REQUEST["location"];
		
		
			
		
		$sql = "DELETE FROM $location WHERE stu_id=".$id;
		//echo "[".$sql."]";
	}
	
		$sql1="SELECT * FROM $location  WHERE stu_id='$id'"; 		
		
		$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		
				$result = $conn->query($sql1);
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
			                                  
                                                $id=$row["stu_id"];
										     
										       $name=$row["student_name"];
											   $dob=$row["dob"];
											   $barcode=$row["barcode"];
										
											
										
			    }
}
		        $purpose="Students name: $name D.O.B: $dob Barcode: $barcode";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$id','$purpose','$created_at')";
			  
			  	 if ($conn->query($sqltr) === TRUE) {
  
} else {
    echo "Error3: " . $sqltr . "<br>" . $conn->error;
}	
			
		
						
		if ($conn->query($sql) === TRUE)
		{
			echo "Barcode deleted\n";
			
			
			$sql1="Update Students set bstatus='No',stu_barcode='' Where id=".$id;
			
					  	 if ($conn->query($sql1) === TRUE) {
  
} else {
    echo "Error Updating: " . $sql1. "<br>" . $conn->error;
}	
	
			
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
			$item = Generate_Stock_in_Types();
			echo $item;
			break;
			
		case "Add_Recieval":
			Add_Recieval();
			break;
			
			
			
			case "Assign_barcode":
			Assign_barcode();
			break;
			
		
		
		case "update_barcode":
			update_barcode();
			break;
			
		
			
			case "add_lunch":
			add_lunch();
			break;
			
			
			
			
		case "Add_price":
			Add_price();
			break;
				
		
				
		case "Basic_Receival_info":
		$response_table = Basic_Receival_info();
			echo $response_table;
			break;
			
			case "Remove_price":
			Remove_price();
			break;
			
		case "Basic_Receival_price":
			$response_table = Basic_Receival_price();
			echo $response_table;
			break;
			
				
		case "Basic_warehouse":
			$response_table = Basic_warehouse();
			echo $response_table;
			break;
			
				case "Basic_":
			$response_table = Basic_warehouse();
			echo $response_table;
			break;
			
			case "Basic_student":
			$response_table = Basic_student();
			echo $response_table;
			break;
			
			
				case "Basic_teacher":
			$response_table = Basic_teacher();
			echo $response_table;
			break;
			
			
			
			
				case "Basic_barcode":
			$response_table = Basic_barcode();
			echo $response_table;
			break;
			
			
			
			
				case "Basic_barcode_check":
			$response_table = Basic_barcode_check();
			echo $response_table;
			break;
			
			
			case "Add_barcode":
			$response_table = Add_barcode();
			echo $response_table;
			break;
			
			
		case "Add_barcode1":
			$response_table = Add_barcode1();
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
			
			case "Del_Receival":
			Del_Receival();
			break;
			
			case "Remove_Receival":
			Remove_Receival();
			break;
			
		case "Update_Recieval":
			Update_Recieval();
			break;
			
			case "Update_price":
			Update_price();
			break;
			
			case "Update_warehouse":
			//Update_all();
				Update_warehouse();
			break;
			
		case "Add_Usage":
			Add_Usage();
			break;
		
		case "Add_rental":
			Add_rental();
			break;	
	
	
	
	
		case "Add_rental_teacher":
			Add_rental_teacher();
			break;	
			
	
			
		
			case "Add_book":
			Add_book();
			break;	
				
	case "Add_student":
			Add_student();
			break;	
					
					
					
					case "Add_pic":
			Add_pic();
			break;	
							
			
						case "Add_pic1":
			Add_pic1();
			break;	
			
			
			
			case "Add_return":
			Add_return();
			break;	
			
			
			
			
			case "Add_returnt":
			Add_returnt();
			break;	
			
		
		case "Remove_Usage":
			Remove_Usage();
			break;
			
			case "Del_Usage":
			Del_Usage();
			break;
			
			
				case "Del_Usaget":
			Del_Usaget();
			break;
			
			
			
			
			
		case "Basic_Usage_info":
			$response_table = Basic_Usage_info();
			echo $response_table;
			break;
			
		case "Basic_rental_info":
			$response_table = Basic_rental_info();
			echo $response_table;
			break;
			
			
				case "Basic_rental_teacher_info":
			$response_table = Basic_rental_teacher_info();
			echo $response_table;
			break;
			
			
			case "Basic_return_info":
			$response_table = Basic_return_info();
			echo $response_table;
			break;		
			
			
			
			
						case "Basic_returnt_info":
			$response_table = Basic_returnt_info();
			echo $response_table;
			break;		
			
			
			
			
			
			case "Basic_checkbook_info":
			$response_table = Basic_checkbook_info();
			echo $response_table;
			break;
				
			
			
		case "Get_Usage_line_items_JSON":
			$response_table = Get_Usage_line_items_JSON();
			echo $response_table;
			break;
			
			case "Get_rental_line_items_JSON":
			$response_table = Get_rental_line_items_JSON();
			echo $response_table;
			break;
			
			
				case "Get_rental_line_items_JSONt":
			$response_table = Get_rental_line_items_JSONt();
			echo $response_table;
			break;
			
			
			

	case "Get_return_line_items_JSON":
			$response_table = Get_return_line_items_JSON();
			echo $response_table;
			break;
						
			
	
	
	
	case "Get_return_line_items_JSONt":
			$response_table = Get_return_line_items_JSONt();
			echo $response_table;
			break;
						
	
	
			
						
			
			case "Get_checkbook_JSON":
			$response_table = Get_checkbook_JSON();
			echo $response_table;
			break;
			
			
			
			
		case "Remove_Usage_line_item":
			Remove_Usage_line_item();
			break;
			
		case "Update_Usage":
			Update_Usage();
			break;
			
			case "Update_rental":
			Update_rental();
			break;
				
		case "Update_return":
			Update_return();
			break;
						
			
			
							
		case "Update_returnt":
			Update_returnt();
			break;
			
			
			
			
		case "Inventory_default":
			$response_table = Generate_Inventory_table();
			echo $response_table;
			break;
			
		case "Remove_Stock":
			Remove_Stock();
			break;
			
			case "Remove_barcode":
			Remove_barcode();
			break;
			
			

		default:
			echo "No such query could be found";
	}
}

//echo "<br/>STOP - Server running";
?>
