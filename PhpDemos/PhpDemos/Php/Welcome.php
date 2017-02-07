<?php
include('Session.php');
$login_user = $_SESSION['login_user'];
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Welcome to Logistic</title>
   </head>
   <body>
     <h1>Welcome <?= $login_user; ?></h1>
     <h2><a href="LogOut.php">Sign Out</a></h2>
   </body>
 </html>
