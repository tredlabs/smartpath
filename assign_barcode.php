<?php


require 'db.php';
  

 $db_servername = "localhost";
		$db_username = "dert1_path";
		$db_password = "smartpath2000";
		$db_name =  "dert1_smartpath";

$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);



/*$sql1=" SELECT * FROM Students ";
		   
		    $result = $conn->query($sql1);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$fullname= $row["fullname"];
		$stu_id= $row["id"];
		
   
   $sql = "UPDATE Barcode SET student_name = '$fullname' WHERE stu_id=".$stu_id;
									
					if($conn->query($sql) === TRUE)
					{
					echo " Updated\n";
					}
	
	}
}
	*/




		$sql1=" SELECT * FROM Barcode ";
		   
		    $result = $conn->query($sql1);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$barcode= $row["barcode"];
		$stu_id= $row["stu_id"];
		
   
   $sql = "UPDATE Students SET stu_barcode = '$barcode',bstatus='Yes' WHERE id=".$stu_id;
									
					if($conn->query($sql) === TRUE)
					{
					echo " Updated\n";
					}
	
	}
}
	
	
	
	
		//  FROM usages
		//	INNER JOIN usage_lineitems
			//ON usages.id=usage_lineitems.usage_id
		   // WHERE usage_lineitems.usage_id=".$id;
			






?>
     <table id="datatable-fixed-header" class="table table table-hover m-0"style="white-space:nowrap;">
                                       
                                       
                                        <thead>
                                            <tr>
                                                
                                                <th style="display: none">ID</th>
                                                <th>Student Name</th>
                                                <th>D.O/B</th>
                                              
                                              
                                                
      <?php	if($GLOBALS['role']>0 && $GLOBALS['role']<2)
				{
				  echo "<th>Action</th>";	
                     }
?>
                                                
                                            </tr>
                                        </thead>
<tbody id="" style="">

                                      
                                        	
                                       <?php
require 'db.php';

$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		
		
		$sql = "SELECT * FROM Students"; 				
		
		$result = $conn->query($sql);
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
						
										       $id=$row["id"];
										       $fname=$row["firstname"];
										       $lname=$row["lastname"];
											   $mname=$row["middlename"];
											   $dob=$row["dob"];
										
											   $name=$fname.' '.$lname;
			                                   
			                                  $name1=wordwrap($name,40, '<br>');	
											 
								
										if($name=="")
									{$name="-";
									}	
											
										
										
										echo"
												
											<tr id='Listing_row_$id' class='text-black '>
											<td style='display:none'><b>$id</b></td>
											<td><b>$name1</b></td>
											<td><b>$dob</b></td>";
								            
				if($GLOBALS['role']>0 && $GLOBALS['role']<3)
				{
				  echo "<td><a class='btn btn-success btn-md button_style_addon' href='#' onClick='Show_Receival($id);stocks($sid)'; style='border-radius: 5px;'>Barcode <span class='glyphicon glyphicon-barcode'></span> </a> 
				  <!--<a href='#' class='btn btn-danger btn-md button_style_addon' style='border-radius: 5px;' onClick='Remove_Usage($id);'><span class='glyphicon glyphicon-remove'></span> Del</a></td></tr>-->";
				}
					
												}									
												
			}
		}



?> 	
                                       	
                                        	
                                        	
                                            
                                            
                              	</tbody>
                                    </table>


