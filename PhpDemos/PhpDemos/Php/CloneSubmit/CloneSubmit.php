<?php
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
    include 'Config.php';
    session_start();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Clone with Submit</title>
  </head>
  <body>
    <div class="container">
      <br>
      <button type="button" name="button" id="btnAdd" onclick="Cloner();" class="btn btn-primary btn-sm btnAdd" onclick="onSubmit();">Add</button>
      <br>
      <br>
      <form class="" id="myForm" action="SubmitTextBox.php" method="post">
        <?php

          $sql = 'SELECT * FROM `SubmitTextBox`';
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  $id = $row['id'];
                  $firstname = $row['firstname'];
                  $lastname = $row['lastname']; ?>
      <div class="form-group hiddenDiv" id="hiddenDiv">
         <input type="hidden" name="delId" class="delId" value="">
         <input type="hidden" name="id[]" class="reply-id" value="<?= $id ?>">

         <div class="col-xs-4">
            <input type="text" class="form-control" name="firstname[]" value="<?= $firstname ?>" placeholder="firstname">
         </div>

         <div class="col-xs-4">
            <input type="text" class="form-control" name="lastname[]" value="<?= $lastname ?>" placeholder="lastname">
         </div>

         <div class="col-xs-2">
             <button class=" btn btn-primary" name="btnRemove" onclick="remove(this);">Remove</button>
         </div> <br><br>
      </div>
      <?php

              }
          } ?>
      </form>
      <!-- <button class="btn btn-success btn-sm" onclick= 'onSubmit();' name="submit">Submit</button> -->
      <input type="submit" class="btn btn-success btn-sm" onclick="document.forms[0].submit();"value="Submit">
    </div>
  </body>
  <script type="text/javascript">
  $(document).ready(function() {

    });

  var z = 0;
  function Cloner() {
      var clone = $("#hiddenDiv1").clone(true);
      $(clone).css({"display": "block"});

      $(clone).attr('id', ($(clone).attr('id') + z));
      console.log($(clone).attr('id'));

      $(clone).appendTo("form");
      z++;
  }
  var delId = '0';
  function remove(ele) {
    delId += "," +$(ele).parents('#hiddenDiv').children('.reply-id').val();
    $('.delId').val(delId);
    // delId += ",";
    console.log(delId);
    $(ele).parents().closest('.hiddenDiv').remove();

  }


  // $('#myForm').submit(function() {
  //
  //   // get all the inputs into an array.
  //   var $inputs = $('#myForm :input[type="text"]');
  //
  //   // get an associative array of just the values.
  //   var values = {};
  //   var isFirstName = false;
  //   var isLastName = false;
  //   var firstNameVal = '';
  //   var lastNameVal = '';
  //   var id = '';
  //
  //   $inputs.each(function() {
  //
  //     id = $(this).parents('#hiddenDiv').children('input[type="hidden"]').val();
  //     console.log(id);
  //
  //     if ($(this).attr('name') == 'firstname') {
  //       if($(this).val() !== '') {
  //         isFirstName = true;
  //         firstNameVal = $(this).val();
  //         }
  //       // console.log('isFirstName: ' + isFirstName);
  //     }
  //
  //     if ($(this).attr('name') == 'lastname') {
  //         if($(this).val() !== '') {
  //             isLastName = true;
  //             lastNameVal = $(this).val();
  //       }
  //       // console.log('isLastName: ' +isLastName);
  //     }
  //
  //     if (isFirstName && isLastName) {
  //       values[this.name] = $(this).val();
  //       // console.log($(this).attr('name')+" " + $(this).val());
  //       // console.log("firstNameVal : " + firstNameVal +' &' + ' lastNameVal : ' + lastNameVal );
  //     var dataString;
  //     //here i am deciding what to do update or insert
  //     if (id) {
  //       dataString = "id=" + id + "&firstname=" + firstNameVal +"&lastname=" + lastNameVal
  //     }
  //     else {
  //       dataString = "&firstname=" + firstNameVal +"&lastname=" + lastNameVal
  //     }
  //
  //     if (delId !== '0,') {
  //       dataString = dataString + "&delId="+delId;
  //       console.log(dataString);
  //     }
  //     $('#myForm').submit();
  //         // $.ajax({
  //         //     type: "POST",
  //         //     url: "SubmitTextBox.php?",
  //         //     data: dataString,
  //         //     beforeSend: function(){
  //         //
  //         //     },
  //         //     complete: function(){
  //         //
  //         //     },
  //         //     success: function(result){
  //         //       console.log("success");
  //         //       console.log(dataString);
  //         //       // alert('Data Submitted');
  //         //     }
  //         // });
  //       isFirstName = isLastName = false;
  //         // onSubmit();
  //     }
  //   });
  //
  // });
  function onSubmit() {
        $('#myForm').submit();
  }

</script>

<div class="form-group hiddenDiv" id="hiddenDiv1" style="display:none" >
        <input type="hidden" name="id[]" class="reply-id" value="">
    <div class="col-xs-4">
        <input type="text" class="form-control" name="firstname[]" value="" placeholder="firstname">
    </div>
    <div class="col-xs-4">
        <input type="text" class="form-control" name="lastname[]" value="" placeholder="lastname">
    </div>
    <div class="col-xs-2">
        <button class=" btn btn-primary" name="btnRemove" onclick="remove(this);">Remove</button>
    </div> <br><br>
</div>

</html>
