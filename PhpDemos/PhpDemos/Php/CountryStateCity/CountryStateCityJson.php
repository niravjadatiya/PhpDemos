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
    <title>Country State City</title>
  </head>
  <style media="screen">
  .deleteImage {
    background-image: url('/Php/default.gif');
    background-repeat: no-repeat;
    background-position: center;
    /*width: 66px;*/
    /*height: 34px;*/

  }
  </style>
  <body>
    <div class="container">

      <label for="Country">Country</label>
      <select class="Country form-control" name="slctCountry" id="Country">
        <option>Please Select Country</option>
        <?php
        $sql = 'SELECT * FROM `countries`';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $countryId = $row['id'];
                $countryName = $row['name']; ?>

            <option id=<?= $countryId ?> ><?= $countryName ?></option>
<?php

            }
        } ?>
      </select>

      <br>
      <label for="States">States</label>
      <select class="States form-control " name="slctStates" id="States">
        <option>Please Select Country First</option>
      </select>
      <br>

      <label for="City">City</label>
      <select class="City form-control " name="slctCity" id="City">
        <option>Please Select State First</option>
      </select>

    </div>
  </body>
  <script type="text/javascript">
  $(document).ready(function() {
    $('#Country').on('change', function() {
      $("#States option").remove();
      var countryName = $('#Country').val();
      var countryId = $('#Country').children('option:selected').attr('id');
      ajaxCall('countryId',countryId,'#States');

    });
    $('#States').on('change', function() {
      $("#City option").remove();
      var statesName = $('#States').val();
      var statesId = $('#States').children('option:selected').attr('id');
      ajaxCall('statesId',statesId,'#City');
      });
    });

    function ajaxCall(typeString,typeId,string) {
      if (typeString == 'countryId') {
        var dataString = 'countryId='+ typeId;
      }

      if (typeString == 'statesId') {
        var dataString = 'statesId=' + typeId ;
      }

      if (typeId) {
        $.ajax({
          type:'POST',
          url:'MakeJson.php',
          data: dataString,
          beforeSend: function(){
              $(string).addClass('deleteImage');
          },
          complete:function(){

          },
          success:function(Result) {
              setTimeout(function(){
                  $(string).removeClass('deleteImage');
                  parse(Result,string)
              },5000);
          }
        });
      }
    }

    function parse(Result,id) {
      var list = $.parseJSON(Result);
      for(i=0;i<list.length;i++) {
          //  var countryId = countryList[i].country_id;
           var listId = list[i].id;
           var listName = list[i].name;
           $(id).append($('<option>', {id:listId, text:listName}));
       }
    }
  </script>
</html>
