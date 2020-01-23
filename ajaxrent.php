
<?php

require 'db.php';
//session_start();
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
    	

<!-- DataTables -->
        <link href="../plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

                   	
                     <script type="text/javascript">
            $(document).ready(function() {
            	
            	  
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "../plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
               // var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
      
            TableManageButtons.init();

              
            } );
           

        </script>                     	
  
    	

<!-- DataTables -->
        <link href="../plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />


  
                            <div class="col-sm-12">
                               

                                    <h4 class="m-t-0 header-title"><b>Type</b></h4>
                                 <div id="Receival_listing_Message" style="padding: 10px; text-align: center">
			</div>

                                    <table id="datatable-fixed-header9" class="table table table-hover m-0 ">
                                       
                                       
                                              <thead>
                                            <tr>
                                                
                                                <th style="display:block">Student #</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Last Name</th>
                                                <th>DOB</th>
                                                <th>Grade</th>
                                              
                                                
      <?php	if($GLOBALS['role']>0 && $GLOBALS['role']<2)
				{
				  echo "<th>Action</th>";	
                     }
?>
                                                
                                            </tr>
                                        </thead>
<tbody id="" style="" >

  
                                        	
                                       <?php
require 'db.php';
	if(isset($_POST["activity"]))
	{
		$activity = $_POST["activity"]; 
		
	}
	if($activity=="Students")
	{
		$location="Students";
	}
	$sql = "SELECT * FROM $location 
	";
	
	 
					
					
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
										       $lastname=$row["lastname"];
										       $firstname=$row["firstname"];
											   $middlename=$row["middlename"];
											   $dob=$row["dob"];
											   $grade=$row["grade"];
											  
			                                   
			                               //   $name1=wordwrap($name,20, '<br>');	
										//	  $auth1=wordwrap($auth,20, '<br>');
											  $pub1=wordwrap($pub,20, '<br>');		
								
										if($middlename=="")
									{$middlename="-";
									}	
											
										if($dob=="")
									{$dob="-";
									}	
										
										echo"
												
											<tr id='Listing_row_$id' class='text-black '>
											<td style='display:block'><b>$id</b></td>
											<td><b>$firstname</b></td>
											<td><b>$middlename</b></td>
											<td><b>$lastname</b></td>
											
											<td><b>$dob</b></td>
											<td><b>$grade</b></td>";
			
				  echo "<td><a class='btn btn-primary btn-md button_style_addon' href='#' onClick='showDiv3($id);' style='border-radius: 5px;'>Edit <span class='glyphicon glyphicon-edit'></span> </a></td></tr>";
				
					
												}	
		}


}
?> 	
              
    <script type="text/javascript">
              

            jQuery(document).ready(function($) {
      
            	
            	var oTable = null;
		 oTable = $('#datatable-fixed-header9').dataTable( {
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


                                        	
                                            
                                            
                              	</tbody>
                                    </table>
                                </div>
                          
                        </div></div>