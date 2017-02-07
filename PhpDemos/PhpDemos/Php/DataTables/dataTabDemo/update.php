<?php
$db=mysql_connect("localhost", "root", "123456") or die('Could not connect');
mysql_select_db("database1", $db) or die('');
$table="table1";

  if(isset($_GET["delData"])) {
    $dataValue = $_GET["delData"];
    mysql_query("delete from $table where id in($dataValue)");
  }

  if(isset($_GET["update"]))
  {
    $id=$_GET["update"];
    $name=$_GET["name"];
    $mobile=$_GET["mobile"];
    $email=$_GET["email"];

    $res=mysql_query("select * from $table where id=$id");
    $row=mysql_fetch_array($res);

    if($row['fname']!=$name)
    mysql_query("update $table set fname='$name' where id=$id");

    if($row['mobile']!=$mobile)
    mysql_query("update $table set mobile=$mobile where id=$id");

    if($row['email']!=$email)
    mysql_query("update $table set email='$email' where id=$id");

  }

 ?>
