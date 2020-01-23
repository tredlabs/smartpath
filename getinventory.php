<?php  

require 'db.php';
$output='';
$sql = "SELECT * FROM stocks ORDER BY id DESC";
$result = $mysqli->query($sql);

$output .= '<div class="table-responsive">
         <table class="table table-bordered"> 
          <tr>
          <th width="10%">ID</th>
          <th width="10%">Name</th>
          <th width="10%">Part No</th>
            <th width="10%">Instock</th>
		    <th width="10%">Reorder Level</th>
		        <th width="10%">Reorder Level</th>
		  </tr>';
 if(mysqli_num_rows($result) > 0)  
 {  
      while($row = 

mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td>'.$row["id"].'</td>  
                     <td>'.$row["name"].'</td>  
                      <td>'.$row["p1"].'</td>  
                     <td>'.$row["instock"].'</td>   
                     <td>'.$row["reorderlevel"].'</td>  
                     <td>'.$row["price"].'</td>';  
      }  
 }  
 else  
 {  
      $output .= '<tr>  
                          <td colspan="4">Data not Found</td>  
                     </tr>';  
 }  
 $output .= '</table>  


      </div>';  
 echo $output;  
 ?>
                    