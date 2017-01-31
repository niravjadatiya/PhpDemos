<?php
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
    include 'Config.php';
    session_start();
 ?>
 <?php

$sql = 'SELECT * FROM `registration`';
connection($sql);
 function connection($sql)
 {
     global $conn;
     $result = $conn->query($sql);
    //create an array
    $emparray = array();
     while ($row = mysqli_fetch_assoc($result)) {
         $emparray[] = array('id' => $row['id'], 'username' => $row['username'], 'email' => array($row['email'],$row['email']), 'firstname' => $row['firstname'], 'mobileno' => $row['mobileno'], 'birthDate' => $row['birthDate']);
        //  $emparray[] = $row;
     }

     $finalArray = array('data' => ($emparray));
     echo json_encode($finalArray);
 }
 mysqli_close($conn);
  ?>
