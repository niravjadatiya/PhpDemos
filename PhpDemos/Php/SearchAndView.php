<?php
$searchQuery = "'%".$_GET['searchQuery']."%'";
$sql = "SELECT * FROM registration WHERE `id` LIKE ".$searchQuery." OR `username` LIKE ".$searchQuery."
          OR `email` LIKE ".$searchQuery."
          OR `mobileno` LIKE ".$searchQuery;

          // echo "SELECT * FROM registration WHERE `id` LIKE '%nirav%' OR `username` LIKE '%nirav%' OR `email` LIKE '%nirav%' OR `mobileno` LIKE '%nirav%' "
          echo $sql;
 ?>
