<?php  

require 'db.php';

 $output = '';  
 $sql = "SELECT * FROM receivals ORDER BY id DESC";  
$result = $mysqli->query($sql);
$output .= '<div class="table-responsive">
         <table class="table table-bordered"> 
          <tr>
           <th width="5%" >ID</th>
          <th width="10%" >Invoice number</th>
          <th width="13%" >Recdate</th>
          <th width="17%" >Created at</th>
             <th width="10%" >Actions</th>
         
		  </tr>
		  <tr>
		         <td></td> <td></td>  
                <td id="in" ></td>  
                <td id="rc" ></td>
                <td id="ca" ></td>  
                
 </tr>';
 if(mysqli_num_rows($result) > 0)  
 {  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                    <td>'.$row["id"].'</td>  
                     <td class="invoice_number" data-id1="'.$row["id"].'" >'.$row["invoice_number"].'</td>  
                     <td class="recdate" data-id2="'.$row["id"].'" >'.$row["recdate"].'</td>  
                     <td class="created_at" data-id3="'.$row["id"].'">'.$row["created_at"].'</td>  
                    
                     <td><button type="button" name="btn_delete1" id="btn_delete1" data-id3="'.$row["id"].'" class="btn btn-xs btn-danger btn_delete1">Delete</button></td>
                     
                </tr>  
           ';  
      }  
      $output .= '  
           <tr>  
                <td ></td>  
                <td id="invoice_number"  contenteditable></td>  
                <td id="recdate" contenteditable></td>
                <td id="created_at" contenteditable></td>  
       
            
                <td><button type="button" name="btn_addr" id="btn_addr" class="btn btn-xs btn-success">Add</button></td>  
           </tr>  
      ';  
 }  
 else  
 {  
      $output .= '<tr>  
                          <td colspan="4">Data not Found</td>  
                          <td><button type="button" name="btn_addr" id="btn_addr" class="btn btn-xs btn-success">Add</button></td>  
                     </tr>';  
 }  
 $output .= '</table>  
      </div>';  
 echo $output;  
 ?>