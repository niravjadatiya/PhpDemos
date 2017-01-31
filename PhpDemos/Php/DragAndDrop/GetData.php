<?php
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
    include 'Config.php';
    session_start();
 ?>
 <?php

 $categoryId = isset($_POST['categoryId']) ? $_POST['categoryId'] : '';
 $eleValue = isset($_POST['eleValue']) ? $_POST['eleValue'] : '';
 $c_id = isset($_POST['c_id']) ? $_POST['c_id'] : '';
 $Insert = isset($_POST['Insert']) ? $_POST['Insert'] : '';

 $Delete = isset($_POST['Delete']) ? $_POST['Delete'] : '';
 $tableName = isset($_POST['tableName']) ? $_POST['tableName'] : '';
 $eleId = isset($_POST['eleId']) ? $_POST['eleId'] : '';

 if ($categoryId) {
     $sql = 'SELECT * FROM `category_items` WHERE `c_id` ='.$categoryId;
     connection($sql);
 }

 if ($Insert && $tableName) {
    $sql = 'INSERT INTO `'.$tableName.'`(`name`, `c_id`) VALUES ("'.$eleValue.'","'.$c_id.'")';
    echo $sql;
    InsertDelete($sql);
 }

 if ($Delete && $tableName) {
   $sql ='DELETE FROM `'.$tableName.'` WHERE  ID ='.$eleId;
   echo $sql;
   InsertDelete($sql);
 }

 function connection($sql)
 {
     global $conn;
     $result = $conn->query($sql);
    //create an array
    $emparray = array();
     while ($row = mysqli_fetch_assoc($result)) {
         $emparray[] = $row;
     }
     echo  json_encode($emparray);
 }

 function InsertDelete($sql) {
   global $conn;
   if (mysqli_query($conn, $sql)) {
       // echo "<script>alert('Data submit successfully please verifying your email address');</script>";
   } else {
       echo 'Error: '.$sql.'<br>'.mysqli_error($conn);
   }
 }
 mysqli_close($conn);
  ?>
