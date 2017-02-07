<?php
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
    include 'Config.php';
    session_start();
 ?>
<?php

  if (!$conn) {
      die('Connection failed: '.mysqli_connect_error());
  }

  $delId = (isset($_POST['delId'])) ? $_POST['delId'] : '';
  $id = (isset($_POST['id'])) ? $_POST['id'] : '';
  $firstname = (isset($_POST['firstname'])) ? $_POST['firstname'] : '';
  $lastname = (isset($_POST['lastname'])) ? $_POST['lastname'] : '';

  if ($id !== '') {
      $sql = "UPDATE `SubmitTextBox` SET `firstname`='".$firstname."',`lastname`='".$lastname."' WHERE `id`=".$id;
      echo $sql;
  } else {
      $sql = 'INSERT INTO `SubmitTextBox`(`firstname`, `lastname`) VALUES ("'.$firstname.'","'.$lastname.'");';
  }
  if (mysqli_query($conn, $sql)) {
      // echo "<script>alert('Data submit successfully please verifying your email address');</script>";
  } else {
      echo 'Error: '.$sql.'<br>'.mysqli_error($conn);
  }

  if ($delId) {
      $sqlDel = "DELETE FROM `SubmitTextBox` WHERE id IN (".$delId.")";
      if (mysqli_query($conn, $sqlDel)) {
          echo "<script>alert('Data submit successfully please verifying your email address');</script>";
      } else {
          echo 'Error: '.$sql.'<br>'.mysqli_error($conn);
      }
  }
    mysqli_close($conn);
    session_unset();
    session_destroy();
?>
