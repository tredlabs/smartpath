<?php session_start();	
require 'db.php';


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
	$location=$_POST["location"];
	

?>

 
             



  
                            <div class="col-sm-12">
                               

                            
                                    <table id="usetable1" class="table table table-hover m-0 " style="white-space:nowrap;">
                                       
                                       
                                        <thead>
                                            <tr>
                                                
                                                 <th style="display: none">ID</th>
                                                <th>Student Name</th>
                                                <th>D.O/B</th>
                                                <th>Barcode</th>
                                                
    
                                                
                                            </tr>
                                        </thead>
<tbody id="" style="">

                                      
                                        <?php


$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		
		
		$sql = "SELECT * FROM Students where  bstatus='No'"; 				
		
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
										
											   $name=$fname.' '.$mname.' '.$lname;
			                                   
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
        
    <script type="text/javascript">
              

            jQuery(document).ready(function($) {
            	
            	
            	
            	var oTable = null;
		 oTable = $('#usetable1').dataTable( {
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
                          
                      
                       