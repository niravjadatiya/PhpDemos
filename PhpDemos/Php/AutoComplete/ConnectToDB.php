<?php
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
    include 'Config.php';
    session_start();
 ?>
 <?php
 $term = $_GET[ 'term' ];

 if ($term) {
     $sql = 'SELECT * FROM `countries` WHERE `name` LIKE "%'.$term.'%" OR `id` LIKE "%'.$term.'%" OR `alpha_2` LIKE "%'.$term.'%"';
     connection($sql);
 }

 function connection($sql)
 {
     global $conn;
     $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $data[] = array('id' => $row['alpha_2'], 'label' => $row['name'], 'value' => $row['name']);
    }
     echo json_encode($data);
 }
  ?>
