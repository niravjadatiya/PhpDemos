<?php
$columns = array('id','fname','mobile','email' );
//$columns = array(0 =>'id',1=> 'fname',2=> 'mobile',3=> 'email' );
	//$columns = array(1 =>'id',2=> 'fname',3=> 'mobile',4=> 'email' );
  $extracol=1;
  $indexon = "id";


  $db=mysql_connect("localhost", "root", "123456") or die('Could not connect');
  mysql_select_db("database1", $db) or die('');

  $table="table1";

// ===========paging
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
  		$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
	}

	//  ===============Ordering
  $sOrder="";
  if ( isset( $_GET['iSortCol_0'] ) )
	{
  		$sOrder = "ORDER BY  ";
  		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
  		{
      			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
      			{
      				    $sOrder .= $columns[ intval( $_GET['iSortCol_'.$i] )-1 ]."
      				 	      ".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
      			}
  		}
  		$sOrder = substr_replace( $sOrder, "", -2 );
  		if ( $sOrder == "ORDER BY" )
  		{
  			    $sOrder = "";
  		}
	}

// ===============Searching
	$sWhere = "";
	if ( $_GET['sSearch'] != "" )
	{
    		$sWhere = "WHERE (";
    		for ( $i=0 ; $i<count($columns) ; $i++ )
    		{
    			   $sWhere .= $columns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
    		}
    		$sWhere = substr_replace( $sWhere, "", -3 );
    		$sWhere .= ')';
	}
	/* Individual column filtering */
	for ( $i=0 ; $i<count($columns) ; $i++ )
	{
    		if ( $_GET['bSearchable_'.($i+1)] == "true" && $_GET['sSearch_'.$i] != '' )
    		{
        			if ( $sWhere == "" )
        			{
        				    $sWhere = "WHERE ";
        			}
        			else
        			{
        				    $sWhere .= " AND ";
        			}
              // echo "<br>";
              // echo
                      		 $sWhere .= $columns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
    		}
	}
  // echo "<br>";
  // echo $sWhere;
  // echo "<br>";

// =============query
  $cols=join(",",$columns);
  //echo "SELECT $cols FROM $table $sWhere $sOrder  $sLimit  <br>";
  $result = mysql_query("SELECT $cols FROM $table $sWhere $sOrder  $sLimit  ") or die(mysql_error());
  $disp = mysql_query("SELECT  $cols FROM $table $sWhere $sOrder") or die(mysql_error());
	$qry = mysql_query("SELECT $cols FROM  $table") or die(mysql_error());
  $counttotal=mysql_num_rows($qry);
  $countdisplay=mysql_num_rows($disp);

  $output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $counttotal,
		"iTotalDisplayRecords" => $countdisplay,
		"aaData" => array()
	);

	while ( $row = mysql_fetch_assoc( $result ) )
	{
     //array_unshift($row," ");
    //  print_r ($row);
     $output['aaData'][]=$row;
	}

	echo json_encode( $output );
?>
