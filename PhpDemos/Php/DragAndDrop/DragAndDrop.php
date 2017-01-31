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
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <title>Drag And Drop Category Item</title>
</head>
<style>
    #UnAssignedItems,
    #AssignedItems {
        border: 1px solid #eee;
        width: 100%;
        min-height: 20px;
        list-style-type: none;
        margin: 0;
        padding: 5px 0 0 0;
        float: left;
        margin-right: 10px;
    }

    #AssignedItems li,
    #UnAssignedItems li {
        margin: 0 5px 5px 5px;
        padding: 5px;
        font-size: 1.2em;
        width: 100% auto;
    }
    .ui-state-highlight {
      border: 1px solid black;
      background: lightgrey;

    }
    .UnAssignedItems, .AssignedItems {
      height: 500px;
      border: 1px solid black;
    }
    .deleteImage {
      background-image: url('/Php/default.gif');
      background-repeat: no-repeat;
      background-position: center;
    }
</style>

<body>
    <div class="container">
        <label for="category">Category</label>
        <select class="Category form-control" name="category" id="category">
            <option class="form-control" id="optnPlease">Please Select Category..</option>
            <?php
            $sql = 'SELECT * FROM `category`';
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $categoryId = $row['c_id'];
                    $categoryName = $row['category']; ?>

                <option id=<?= $categoryId ?>  ><?= $categoryName ?></option>
    <?php

                }
            } ?>
        </select>
        <br />
        <br />
        <center>
          <div class="col-sm-5">
            <label for="UnAssignedItems">Un-Assigned Items</label>

            <ul class="connectedSortable UnAssignedItems" id="UnAssignedItems">
                    <?php
                    $sql = 'SELECT * FROM `item` ';
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $itemId = $row['id'];
                            $itemName = $row['name']; ?>
              <li id= <?= $itemId ?> class="ui-state-highlight"><?= $itemName ?></li>
                    <?php

                        }
                    } ?>
            </ul>

          </div>
          <div class="col-sm-offset-2 col-sm-5">
            <label for="AssignedItems">Assigned Items</label>
            <ul class="connectedSortable AssignedItems" id="AssignedItems">

            </ul>
          </div>

        </center>
    </div>
</body>
<script>
var categoryName = '';
var categoryId = '';
  $(document).ready(function(){
    // on category change
    $('#category').on('change', function() {
    // function for connecting both unorderd list
      $(function() {
          $("#UnAssignedItems, #AssignedItems").sortable({
              connectWith: ".connectedSortable"
          }).disableSelection();
      });
      //here i am remvoing "Please Select Category" from option list
      $('#optnPlease').remove();
      //here i am removing previouse options and append new with ajaxCall
      $("#AssignedItems li").remove();
      categoryName = $('#category').val();
      categoryId = $('#category').children('option:selected').attr('id');
      console.log(categoryId + " " + categoryName);
      ajaxCall('categoryId',categoryId,'#AssignedItems');
    });

      // AssignedItems on receive and on remove events
      $( ".AssignedItems" ).sortable({
          receive: function( event, ui ) {
            var id = ui.item.attr("id");
            var val = ui.item.text();
            console.log("received :" + id + " " + val);
            Insert(val,categoryId,'category_items');
          },
          remove: function( event, ui ) {
            var id = ui.item.attr("id");
            var val = ui.item.text();
            console.log("remove :" +id + " " + val);
            Delete(id,'category_items');
          }
        });

      // UnAssignedItems on receive and on remove events
        $( ".UnAssignedItems" ).sortable({
            receive: function( event, ui ) {
              var id = ui.item.attr("id");
              var val = ui.item.text();
              console.log("received :" + id + " " + val);
              Insert(val,categoryId,'item');
            },
            remove: function( event, ui ) {
              var id = ui.item.attr("id");
              var val = ui.item.text();
              console.log("remove :" +id + " " + val);
              Delete(id,'item');
            }
          });



  });
    function Insert(eleValue,categoryId,tableName) {
      var dataString = 'eleValue=' + eleValue + '&c_id=' + categoryId + '&Insert=true' + '&tableName=' +tableName;
      $.ajax({
        type:'POST',
        url:'GetData.php',
        data: dataString,

      });
    }

    function Delete(eleId,tableName) {
      var dataString = 'eleId=' + eleId + '&Delete=true' + '&tableName=' + tableName;
      $.ajax({
        type:'POST',
        url: 'GetData.php',
        data: dataString,
      });
    }

    function ajaxCall(typeString,typeId,string) {
      if (typeString == 'categoryId') {
        var dataString = 'categoryId='+ typeId;
      }
        if (typeId) {
        $.ajax({
          type:'POST',
          url:'GetData.php',
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
              },5);
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
           $(id).append($('<li>', {class:'ui-state-highlight', id:listId, text:listName}));
       }
    }
</script>
</html>
