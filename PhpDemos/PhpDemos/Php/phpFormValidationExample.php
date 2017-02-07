<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Php Form Validation Example</title>
  </head>
  <body>
    <?php

    echo "Today is " . date("d/m/Y") . "<br>";
    echo "Today is " . date("d.m.Y") . "<br>";
    echo "Today is " . date("d-m-Y") . "<br>";
    echo "Today is " . date("l");


    // define variables and set to empty values
    $name = $email = $gender = $comment = $website = "";
    $nameErr = $emailErr = $genderErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is Required";
        } else {
            $name = test_input($_POST["name"]);

            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }
        if (empty($_POST["email"])) {
            $emailErr = "email is Required";
        } else {
            $email = test_input($_POST["email"]);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid Email Id";
            }
        }
        if (empty($_POST["gender"])) {
            $genderErr = "Gender is Required";
        } else {
            $gender = test_input($_POST["gender"]);
        }
        if (empty($_POST["comment"])) {
            $comment = "";
        } else {
            $comment = test_input($_POST["comment"]);
        }
        if (empty($_POST["website"])) {
            $website = "";
        } else {
            $website = test_input($_POST["website"]);
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
                $websiteErr = "Invalid URL";
            }
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

     ?>

     <h2>PHP Form Validation Example</h2>
     <form class="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

       Name : <input type="text" name="name" value="<?php echo $name; ?>">
       <span class="error">* <?php echo $nameErr ?></span>

       <br><br>

       Email: <input type="text" name="email" value=" <?php echo $email; ?> ">
       <span class="error"> * <?php echo $emailErr ?></span>

       <br><br>

       Website: <input type="text" name="website" value="<?php echo $website; ?>">
       <span class="error"> * <?php echo $websiteErr ?></span>

       <br><br>

       Comment: <textarea name="comment" rows="5" cols="40" value="<?php echo $comment; ?>"> </textarea>

       <br><br>

       Gender :
       <input type="radio" name="gender"
       <?php if (isset($gender) && $gender=="male") {
         echo "checked";
     }?>value="Male">Male

      <input type="radio" name="gender"
       <?php if (isset($gender) && $gender=="female") {
         echo "checked";
     }?> value="Female">Female

      <span class="error">* <?php echo $genderErr ?></span>

       <br><br>

       <input type="submit" name="submit" value="Submit">

     </form>

     <?php
     echo "Your Input :";
     echo "<br>";
     echo $name;
     echo "<br>";
     echo $email;
     echo "<br>";
     echo $website;
     echo "<br>";
     echo $comment;
     echo "<br>";
     echo $gender;

     echo"<br>";
     $d=strtotime("10:30pm April 15 2014");

     echo "<br>";
     echo "created date is ". date("d-m-Y h:i:sa", $d);

     date_default_timezone_set("India/Gujarat");
     echo "The time is " . date("h:i:sa");
     echo "<br>";

     $d=strtotime("tomorrow");
     echo date("d-m-Y h:i:sa", $d) . "  - tommorrow<br><br>";

     $d=strtotime("next Saturday");
     echo date("d-m-Y h:i:sa", $d) . "  - next saturday<br><br> ";

     $d=strtotime("+3 Months");
     echo date("d-m-Y h:i:sa", $d) . "  - +3 month<br><br>";
      ?>
      <!-- copyright symbol with 2010 to current year - dont have to change it manually -->
      &copy; 2010-<?php echo date("Y");?>


  </body>
  <style media="screen">
    .error {
      color: red;
    }
  </style>
</html>
