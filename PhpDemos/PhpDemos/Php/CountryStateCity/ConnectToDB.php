<?php
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
    include 'Config.php';
    session_start();
 ?>
 <?php

 $countryId = isset($_POST['countryId']) ? $_POST['countryId'] : '';
 $statesId = isset($_POST['statesId']) ? $_POST['statesId'] : '';

 if ($countryId) {
     $sql = 'SELECT * FROM `states` WHERE `country_id` ='.$countryId;
     connection($sql);
    //  $countryId = '';
 }

 if ($statesId) {
     $sql = 'SELECT * FROM `cities` WHERE `state_id` ='.$statesId;
     connection($sql);
 }

 function connection($sql) {
     global $conn;
     $result = $conn->query($sql);
     if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
             $Id = $row['id'];
             $Name = $row['name'];
             echo '<option id='.$Id.'>'.$Name.'</option>';
             
         }
     }
 }
  ?>
