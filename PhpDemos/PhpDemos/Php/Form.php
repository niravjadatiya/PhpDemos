<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
// error_reporting(E_ALL ^ E_NOTICE);
include("Config.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $myUserName = mysqli_real_escape_string($conn,$_POST['username']);
    $myPassword = mysqli_real_escape_string($conn,$_POST['password']);

    $sql = "SELECT * FROM registration WHERE `username` ='".$myUserName."' and `password` = '".$myPassword."'";
    echo $sql;

    $result = mysqli_query($conn,$sql);

    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    // $active = $row['active'];
    //if result true we check that table row must be one
    $count = mysqli_num_rows($result);
    if ($count == 1) {
      // session_register("myUserName");
      // session_register($myUserName);
      $_SESSION['login_user'] = $myUserName;
      header('Location:Welcome.php');
    }else {
      $error = "Your Login Name or Password is InCorrect Please Try Again";
    }

}

?>

<!DOCTYPE html>
<html>
  <head>
      <title>Logistic Infotech</title>
    <meta charset="utf-8">
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
      <script src="bootstrap-datepicker.min.js"></script>

      <script type="text/javascript">

      $(document).ready(function(){

        jQuery.validator.addMethod("noSpace", function(value, element) {
          return value.indexOf(" ") < 0 && value !== "";
        }, "No space please and don't leave it empty");

        $(".animate").fadeIn(2000);

        $('#form').validate({
          rules: {
            firstname: {required:true,minlength:2},
            lastname:{required:true,minlength:2},
            username: {required:true,minlength:2,noSpace:true},
            mobileno:{number:true,required:true,minlength:10,maxlength:13},
            emailid:{required:true,email:true},
            reemailid:{required:true,equalTo:'#emailid'},
            password:{required:true,minlength:8},
            confirmPassword:{required:true,equalTo:"#password"},
            birthDate:{date:true,required:true},
            gender:{required: true}
          },
          messages: {
            // firstname:"Please enter your firstname",
            // lastname:"Please enter your lastname",
            // username:,
            // mobileno:"",
            // emailid:"",
            // reemailid:"",
            // password:"",
            // confirmPassword:"",
            // birthDate:"",
            // gender:"",
          },
          highlight: function (element) {
            $(element).addClass('err');
        },
        unhighlight: function (element) {
            $(element).removeClass('err');
        }
        });
          $('#sandbox-container input').datepicker({
            // format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true
            });
    });

    </script>

    <style media="screen">
      .error::before {

        float: left;
        content:url(cancel.png);

      }
      .err {
        border-color: red;
      }
      .modal-header,h4, .close {
        background-color: green;
        color: white !important;
        text-align: center;
        font-size: 30px;
      }
      .modal-footer {
        background-color: lightgrey;
      }
      .gray-bg {
        background-color: #f3f3f4;
      }
    </style>
  </head>

  <body class="gray-bg">
    <div id="animate" class="animate container col-sm-offset-4 col-sm-4" style="display:none;">
    <img src="liLogo.png" class=" col-sm-offset-3" alt="logo" />

  <form class="form-horizontal" action="" method="post">

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="text" name="username" class="form-control" id="email" placeholder="Enter Email">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">
        <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter Password">
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox">Remember me</label>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="col-sm-5 btn btn-primary btn-lg">Submit</button>
        <button type="button" class="col-sm-offset-2 col-sm-5 btn btn-info btn-lg" data-toggle="modal" data-target="#SingUpModel" >Sing Up</button>
      </div>
    </div>
  </form>
</div>
<!-- bootstrap model singup form -->
  <!-- making model -->
  <div class="modal fade" id="SingUpModel" role="dialog">
    <div class="modal-dialog">
      <!-- modal content -->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sing Up to Logistic Infotech</h4>
        </div>
          <div class="modal-body" style="padding:40px 50px;">
            <!-- making form -->
            <form  action="register.php" id="form" role="form" method="post">
              <div class="form-group">

                <label for="firstname">Your Name</label>
                <div class="row">
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter Your Firstname">
                  </div>
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Your Lastname">
                  </div>
                </div>
                <label for="username">User Name</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="firstname_lastname">
                <br>
                <label for="mobNumber">Mobile No.</label>
                <input type="text" class="form-control" id="mobileno" name="mobileno" placeholder="911234567890">
                <br>
                <label for="emailid">Email Id</label>
                <input type="email" class="form-control" id="emailid" name="emailid" placeholder="name@domain.com">
                <br>
                <label for="reemailid">Re Enter Email Id</label>
                <input type="email" class="form-control" id="reemailid" name="reemailid" placeholder="name@domain.com">
                <br>
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your Password">
                <br>
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Re Enter Password">
                <br>
                <label for="birthDate">Birth Date</label>
                <div id="sandbox-container">
                  <input type="text" class="form-control" name="birthDate" id="birthDate" placeholder="mm/dd/yyyy">
                </div>
                <br>
                <label class="radio-inline"><input type="radio" name="gender" id="female">Female</label>
                <label class="radio-inline"><input type="radio" id="gender" name="gender">Male</label>
              </div>
              <button type="submit" id="register" class="btn btn-warning btn-block ">Create an Account</button>
            </form>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>
    </div>
  </div>


</body>
</html>
