<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
include 'Config.php';
session_start();

        $columns = array('id', 'firstname', 'username', 'email', 'mobileno', 'position');

        $table = 'registration';

        // Input method (use $_GET, $_POST or $_REQUEST)
        $input = &$_GET;

        //this is used for fast and accurate table cardinality
        //gives total length of data
        $TotalDataLength = 'id';

        // Database table name
        $table = 'registration';
            if (mysqli_connect_error()) {
                die('Error connecting to MySQL server ('.mysqli_connect_errno().') '.mysqli_connect_error());
            }
      //rows per page
      // decides how much recods to show per page
      $limit = '';
          if (isset($input['start']) && $input['length'] != '-1') {
              $limit = ' LIMIT '.intval($input['start']).', '.intval($input['length']);
            // echo $limit;
          }

      // Ordering
      $orderBy = array();
          if (isset($input['order'])) {

            //sorted by how much columns
            $totalColumns = intval(count($input['order']));

              for ($i = 0; $i < $totalColumns; ++$i) {
                  //echo $totalColumns;
$orderBy[] = '`'.$columns[ intval($input['order'][$i]['column']) ].'` '.($input['order'][$i]['dir'] === 'asc' ? 'asc' : 'desc');
                  // print_r($orderBy);
              }
          }

          if (!empty($orderBy)) {
              // global $orderBy;
              $order = ' ORDER BY '.implode(', ', $orderBy);
              // print_r($order);
          } else {
              $order = '';
          }

          $totalColumns = count($columns);

          if ($input['search']['value'] != '') {
              // echo $input['search']['value'];
            $search = array();
              for ($i = 0; $i < $totalColumns; ++$i) {
                  if ($input['columns'][$i]['searchable'] == 'true') {
                      $search[] = '`'.$columns[$i]."` LIKE '%".$db->real_escape_string($input['search']['value'])."%'";
                  }
              }
              if (!empty($search)) {
                  //append with search if not empty
                $search = array('('.implode(' OR ', $search).')');
                // print_r($search);
              }
          }
          // Individual column filtering
          for ($i = 0; $i < $totalColumns; ++$i) {
              if (($input['columns'][$i]['search']['value'])) {
                // echo $input['columns'][$i]['search']['value'];
                  $search[] = '`'.$columns[$i]."` LIKE '%".$db->real_escape_string($input['columns'][$i]['search']['value'])."%'";
                  // print_r($search);
              }
          }
          // //////////////////////////////////////////////
          if ($input['extra_search']) {
              $where  = ' WHERE position='. '"'.$input['extra_search'] .'" ';
              // echo $extra_search;
          }
          ////////////////////////////////////////////

          // search every columns with LIKE OR
          if (!empty($search)) {
              $where .= ' AND '.implode(' AND ', $search);
            // echo $where;
          }
          // else {
          //     $where = '';
          // }



          //get list of columns to display with sql
          $columnsList = array();
          foreach ($columns as $col) {
              if ($col != ' ') {
                  $columnsList[] = $col;
              }
            // print_r($columnsList);
          }

          $sql = 'SELECT SQL_CALC_FOUND_ROWS `'.implode('`, `', $columnsList).'`FROM `'.$table.'`'.$where.$order.$limit;
          // echo $sql;
          $result = $db->query($sql) or die($db->error);

          // get total length of data after search
          $sql = 'SELECT FOUND_ROWS()';

          $resultFilterTotal = $db->query($sql) or die($db->error);
          list($recordsFiltered) = $resultFilterTotal->fetch_row();

          // Total data set length
          $sql = 'SELECT COUNT(`'.$TotalDataLength.'`) FROM `'.$table.'`';

          $RecordsTotal = $db->query($sql) or die($db->error);
          list($recordsTotal) = $RecordsTotal->fetch_row();

          // parameters to print with output
          $output = array(
            'draw' => intval($input['draw']),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => array(),
          );

          while ($Row = $result->fetch_assoc()) {
              $row = array();
              for ($i = 0; $i < $totalColumns; ++$i) {
                  if ($columns[$i] != ' ') {
                      // General output
                $row[] = $Row[ $columns[$i] ];
                // print_r( $row[$i] ." \n");
                  }
              }
              $output['data'][] = $row;
          }

          // Jsone encoding here
          echo json_encode($output);
