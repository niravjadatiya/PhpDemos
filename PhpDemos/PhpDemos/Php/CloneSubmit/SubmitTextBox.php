<?php
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
    include 'Config.php';
    session_start();
 ?>


<?php
  function Delete() {

  }
  function Insert($firstname,$lastname) {
    $sql = 'INSERT INTO `SubmitTextBox`(`firstname`, `lastname`) VALUES ("'.$firstname.'","'.$lastname.'");';
    Connection($sql);
    // echo "GoneInsert";
    // echo "firstname=> " .$firstname;
    // echo " lastname=> " .$lastname."\n";

  }
  function Update($id,$firstname,$lastname) {
    $sql = "UPDATE `SubmitTextBox` SET `firstname`='".$firstname."',`lastname`='".$lastname."' WHERE `id`=".$id;
    Connection($sql);
    // echo "id=> ".$id ;
    // echo " firstname=> " .$firstname;
    // echo " lastname=> " .$lastname."\n";
  }

  if (!$conn) {
      die('Connection failed: '.mysqli_connect_error());
  }
// echo "\ndelId ";
// print_r($_POST['delID']);
// echo "\nid ";
// print_r($_POST['id']);
// echo "\nfistname ";
// print_r($_POST['firstname']);
// echo "\nlastname ";
// print_r($_POST['lastname']);


$arrayId = $_POST['id'];
$arrayFirstname = $_POST['firstname'];
$arrayLastname = $_POST['lastname'];

foreach( $arrayId as $key => $n) {
  $id = $n;
  $firstname = $arrayFirstname[$key];
  $lastname = $arrayLastname[$key];
  // print "The id is ".$n.", firstname is ".$firstname[$key].", lastname is ".$lastname[$key]."\n";
  if (!$id) {
    if ($firstname) {
      if ($lastname) {
        Insert($firstname,$lastname);
      }
    }
  }
  if($id) {
    Update($id,$firstname,$lastname);
  }
}

  $delId = (isset($_POST['delId'])) ? $_POST['delId'] : '';
  
  if ($delId) {
        $sql = "DELETE FROM `SubmitTextBox` WHERE id IN (".$delId.")";
        Connection($sql);
    }

  function Connection($sql) {
    global $conn;
  if (mysqli_query($conn, $sql)) {
      // echo "<script>alert('Data submit successfully please verifying your email address');</script>";
  } else {
      echo 'Error: '.$sql.'<br>'.mysqli_error($conn);
  }
}

    mysqli_close($conn);
    session_unset();
    session_destroy();
?>
