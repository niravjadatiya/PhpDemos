<?php

$id = $_GET['id'];
// print_r($id);
$flag = false;
$MultiId = $_GET['MultiId'];
print_r($MultiId);

if (isset($id)) {
    echo 'test test test test';
    $flag = true;
    delete($id);
} elseif (isset($MultiId)) {
    $sizeOfArray = sizeof($MultiId);
    // print_r($sizeOfArray);

    for ($i = 0; $i < $sizeOfArray - 1; ++$i) {
        if ($i == $sizeOfArray - 2) {
            $flag = true;
        }
        delete($MultiId[$i]);
    }

    // print_r("is true or false  ->" . gettype($flag) ." ");
}

function delete($id)
{
    global $flag;
    $conn = mysqli_connect('localhost', 'root', 'root', 'phpDataBase') or die('Connection error!');
    $query = 'DELETE FROM registration WHERE id= '.$id;
    print_r("\n query=".$query);
    $result = mysqli_query($conn, $query) or die('Database error!');
    echo  var_dump($flag).' '.$id." \n ";
    print_r('is true or false  ->'.gettype($flag).' ');
    if ($flag == true) {
        print_r($flag."\n is true of false \n");
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
}
?>
