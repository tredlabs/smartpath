<?php


	
$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name =  "ssjlinve_inventorysystem";




	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
	$query=mysqli_query($conn,"select count(id) from `rec_lineitems`");
	$row = mysqli_fetch_row($query);

	$rows = $row[0];
	
	$page_rows = 30;

	$last = ceil($rows/$page_rows);

	if($last < 1){
		$last = 1;
	}

	$pagenum = 1;

	if(isset($_GET['pn'])){
		$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
	}

	if ($pagenum < 1) { 
		$pagenum = 1; 
	} 
	else if ($pagenum > $last) { 
		$pagenum = $last; 
	}

	$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
	
	$nquery=mysqli_query($conn,$sql = "SELECT receivals.*,rec_lineitems.*,stocks.name,stocks.p1
	FROM receivals INNER JOIN rec_lineitems 
	ON receivals.id=rec_lineitems.receival_id LEFT JOIN stocks ON rec_lineitems.stock_id=stocks.id  $limit");

	$paginationCtrls = '';

	if($last != 1){
		
	if ($pagenum > 1) {
        $previous = $pagenum - 1;
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'" class="btn btn-default">Previous</a> &nbsp; &nbsp; ';
		
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-default">'.$i.'</a> &nbsp; ';
			}
	    }
    }
	
	$paginationCtrls .= ''.$pagenum.' &nbsp; ';
	
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-default">'.$i.'</a> &nbsp; ';
		if($i >= $pagenum+4){
			break;
		}
	}

    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'" class="btn btn-default">Next</a> ';
    }
	}

?>