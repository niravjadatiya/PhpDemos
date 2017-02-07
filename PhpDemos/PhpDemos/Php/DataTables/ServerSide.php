<?php

$columns = array('id', 'firstname', 'username', 'email', 'mobileno', 'birthDate');

// Indexed column (used for fast and accurate table cardinality)
$sIndexColumn = 'id';

// DB table to use
$table = 'registration';

// Database connection information
$gaSql['user'] = 'root';
$gaSql['password'] = 'root';
$gaSql['db'] = 'phpDataBase';
$gaSql['server'] = 'localhost';
$gaSql['port'] = 3306; // 3306 is the default MySQL port

  // Input method (use $_GET, $_POST or $_REQUEST)
  $input = &$_GET;
  // Character set to use for the MySQL connection.
  // MySQL will return all strings in this charset to PHP (if the data is stored correctly in the database).
  $gaSql['charset'] = 'utf8';

 // MySQL connection
$db = new mysqli($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db'], $gaSql['port']);
if (mysqli_connect_error()) {
    die('Error connecting to MySQL server ('.mysqli_connect_errno().') '.mysqli_connect_error());
}
if (!$db->set_charset($gaSql['charset'])) {
    die('Error loading character set "'.$gaSql['charset'].'": '.$db->error);
}

//rows per page
$limit = '';
if (isset($input['start']) && $input['length'] != '-1') {
    $limit = ' LIMIT '.intval($input['start']).', '.intval($input['length']);
    // echo $limit;
}

 // Ordering
// $array = $input['order'];

// print_r (count($input['order']));
$aOrderingRules = array();
// this loop gives colums and values
// foreach ($input['columns'] as $key) {
//     foreach ($key as $key => $value) {
//         print_r($key ." " . $value . "\n");
//     }
// }

if (isset($input['order'])) {
    $iSortingCols = intval(count($input['order']));

      // foreach($input['order'] as $array){
      //     //  if (isset($value["orderable"]) ){
      //             foreach ($array as $key => $value) {
      //               print_r($key ." " . $value . "\n\n\n");
      //             }
      //     //  }
      // }

      // $col =array($input['columns']);
      // print_r($col);
      // foreach ($col as $key => $value) {
      //   print_r($key ."  ".$value[$key]);
      // }
      // $orderable = ;
      // print_r();

    for ($i = 0; $i < $iSortingCols; ++$i) {
        {
            $aOrderingRules[] =
                '`'.$columns[ intval($input['order'][$i]['column']) ].'` '
                .($input['order'][$i]['dir'] === 'asc' ? 'asc' : 'desc');
        }
    }
    // print_r($aOrderingRules);
}

if (!empty($aOrderingRules)) {
    $sOrder = ' ORDER BY '.implode(', ', $aOrderingRules);
} else {
    $sOrder = '';
}

$iColumnCount = count($columns);

if (isset($input['search']) && $input['search']['value'] != '') {

  // echo $input['search']['value'];
    $aFilteringRules = array();
    for ($i = 0; $i < $iColumnCount; ++$i) {
        if (isset($input['columns'][$i]['searchable']) && $input['columns'][$i]['searchable'] == 'true') {
            $aFilteringRules[] = '`'.$columns[$i]."` LIKE '%".$db->real_escape_string($input['search']['value'])."%'";
        }
    }
    if (!empty($aFilteringRules)) {
        $aFilteringRules = array('('.implode(' OR ', $aFilteringRules).')');
    }
}

// Individual column filtering
// for ($i = 0; $i < $iColumnCount; ++$i) {
//     if (isset($input['bSearchable_'.$i]) && $input['bSearchable_'.$i] == 'true' && $input['sSearch_'.$i] != '') {
//         $aFilteringRules[] = '`'.$columns[$i]."` LIKE '%".$db->real_escape_string($input['sSearch_'.$i])."%'";
//     }
// }

// search every columns with LIKE OR
if (!empty($aFilteringRules)) {
    $sWhere = ' WHERE '.implode(' AND ', $aFilteringRules);
    // echo $sWhere;
} else {
    $sWhere = '';
}

 // SQL queries  Get data to display.
$aQueryColumns = array();
foreach ($columns as $col) {
    if ($col != ' ') {
        $aQueryColumns[] = $col;
    }
}

$sQuery = 'SELECT SQL_CALC_FOUND_ROWS `'.implode('`, `', $aQueryColumns).'`FROM `'.$table.'`'.$sWhere.$sOrder.$limit;

$rResult = $db->query($sQuery) or die($db->error);

// Data set length after filtering
$sQuery = 'SELECT FOUND_ROWS()';
$rResultFilterTotal = $db->query($sQuery) or die($db->error);
list($iFilteredTotal) = $rResultFilterTotal->fetch_row();

// Total data set length
$sQuery = 'SELECT COUNT(`'.$sIndexColumn.'`) FROM `'.$table.'`';

$rResultTotal = $db->query($sQuery) or die($db->error);
list($iTotal) = $rResultTotal->fetch_row();

// parameters to print
$output = array(
    'draw' => intval($input['draw']),
    'recordsTotal' => $iTotal,
    'recordsFiltered' => $iFilteredTotal,
    'data' => array(),
);

  while ($Row = $rResult->fetch_assoc()) {
      $row = array();

      for ($i = 0; $i < $iColumnCount; ++$i) {
          if ($columns[$i] == 'version') {
              // Special output formatting for 'version' column
            $row[] = ($Row[ $columns[$i] ] == '0') ? '-' : $Row[ $columns[$i] ];
          } elseif ($columns[$i] != ' ') {
              // General output
            $row[] = $Row[ $columns[$i] ];
            // print_r( $row[$i] ." \n");
          }
      }
      $output['data'][] = $row;
  }

echo json_encode($output);
