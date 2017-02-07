<?php
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
    session_start();
 ?>
 <?php
 // connecting to server
 $servername = 'localhost';
 $username = 'root';
 $password = 'root';
 $dbname = 'phpDataBase';

 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
  ?>
 <?php
 $term = $_GET['term'];

 $search = isset($_GET['search']) ? $_GET['search'] : '';
 $except = '';
 if ($search) {
    // echo $search;
    // $except = "SELECT * FROM `countries` WHERE `alpha_2` NOT IN (".$search.")";
    $except = "AND (`id` NOT IN (".$search."));";
 } if ($term) {
     $sql = 'SELECT * FROM `countries` WHERE (`name` LIKE "%'.$term.'%" OR `id` LIKE "%'.$term.'%" OR `alpha_2` LIKE "%'.$term.'%")'.$except.'';
    //  echo $sql;
     connection($sql);
    //  echo $sql;
 }

 function connection($sql)
 {

  global $conn;
     $result = $conn->query($sql);
    //  $data = array();
     while ($row = $result->fetch_assoc()) {
        //  $data[] = array('id' => $row['alpha_2'], 'label' => $row['name'], 'value' => $row['name']);
         $data[] = ['id' => $row['id'], 'text' => $row['name']];
     }
     echo json_encode($data);
 }
  ?>
