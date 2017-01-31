<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
// error_reporting(E_ALL ^ E_NOTICE);
include 'Config.php';
session_start();
?>
 <!DOCTYPE html>
<html>
    <head>
        <title>View Data</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="ForViewData.js"></script>
        <style>
        .deleteImage {
          background-image: url('default.gif');
          background-repeat: no-repeat;
          background-position: center;
          width: 66px;
          height: 34px;

        }
        .home {
          float: left;
          width: 96px;
          margin-top:12px;
        }
        input[type=text] {
            width: 130px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 7px;
            font-size: 20px;
            background-color: white;
            background-image: url('searchicon.png');
            background-position: 8px 8px;
            background-repeat: no-repeat;
            padding: 3px 10px 10px 40px;
            -webkit-transition: width 0.4s ease-in-out;
            transition: width 0.4s ease-in-out;
            float: inherit;
            margin-top:14px;
            outline: none;
        }

        input[type=text]:focus {
            float: left;
            width: calc(100% - 55%);
        }
        h2 {
          width: 330px;
          float: left;
        }
        .btnSearch {
          float:right;
          width: 96px;
          margin-top:12px;
          /*margin-right: 30px;*/
        }
        .selectRowOption {
          float: left;
          width: 90px;
          height: 40px;
          margin-right: 10px;
          margin-top: 15px;
          font-size: 20px;
          border: 2px solid #ccc;
          border-radius: 7px;
          background-color: white;
          outline: none;

        }

        .fixed:hover {
          opacity: 1;

        }
        .fixed {
          position: fixed;
          top: 90%;
          border: 1px solid black;
          left: 5%;
          text-align: center;
          opacity: 0.4;
        }

        </style>

    </head>
    <body>

<?php


        // Check connection
        if ($conn->connect_error) {
            die('Connection failed: '.$conn->connect_error);
        }

        // setting page or default page 1
        $_PHP_SELF = $_SERVER['PHP_SELF'];
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $row_per_page = isset($_GET['rows']) ? $_GET['rows'] : 10;

        // Page will start from 0 th record and Multiple by Per Page
        //we use it as offset in sql query
        $start_from = ($page - 1) * $row_per_page;
        $field = (isset($_GET['field'])) ? $_GET['field'] : 'id';
        $sort = (isset($_GET['sorting'])) ? $_GET['sorting'] : 'ASC';

        function iconSetter($fieldis, $sortby)
        {
            global $field,$sort;
            echo ($field !== $fieldis) ? '▲▼' : (($field == $fieldis && $sort == 'ASC') ? '▲' : '▼');
        }
        //getting data from server in limit of rows per page with offset of start from
        $where = '';
        if (isset($_GET['searchQuery'])) {
            $searchQuery = "'%".$_GET['searchQuery']."%'";
            $where = 'WHERE `id` LIKE '.$searchQuery.' OR `username` LIKE '.$searchQuery.'
                    OR `email` LIKE '.$searchQuery.'
                    OR `mobileno` LIKE '.$searchQuery;
        }
        $sql = "SELECT * FROM registration $where ORDER BY $field $sort LIMIT $start_from,$row_per_page";
        $result = $conn->query($sql);
        $searchQuery = (isset($_GET['searchQuery'])) ? $_GET['searchQuery'] : '';

        if ($result->num_rows > 0) {
            // php code over here
?>
            <div class='container'>
              <a href="ViewData.php" class="btn btn-primary btn-lg home"><span class="glyphicon glyphicon-home"></a>
                <h2>&nbsp;List of Registered Users</h2>
                <form action="" method="GET">
                <select name="rows" id="single" onchange="onRowClick(this)"class="form-control selectRowOption" title="10">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                </select>
                </form>
            <input class="glyphicon glyphicons-search txtSearch" type="text" name="search" placeholder="Search id, UserName, EmailId, Mobile..">
            <a class="btn btn-primary btn-lg btnSearch">Search</a>

          <table class='table table-inverse table-hover table-bordered table-responsive' ><tr class='success'>
            <!-- style="min-height: 570px;" -->
          <th><input type='checkbox' id='selectall' value=''></th>
          <th id='ID'>
            <a href="javascript:void(0)" onclick="onSortClick('id')">ID<?php $fieldis = 'id';
            iconSetter($fieldis, $sort); ?>
          <span class='ID sortIcon'></span>
          </th>

          <th>
            <a href="javascript:void(0)" onclick="onSortClick('firstname')">Name<?php $fieldis = 'firstname';
            iconSetter($fieldis, $sort); ?>
          <span class='firstname sortIcon'></span>
          </th>

          <th>
            <a href="javascript:void(0)" onclick="onSortClick('username')">User Name<?php $fieldis = 'username';
            iconSetter($fieldis, $sort); ?>
          <span class='username sortIcon'></span>
          </th>

          <th>
            <a href="javascript:void(0)" onclick="onSortClick('mobileno')">Mobile No<?php $fieldis = 'mobileno';
            iconSetter($fieldis, $sort); ?>
          <span class='mobileno sortIcon'></span></th>

          <th>
            <a href="javascript:void(0)" onclick="onSortClick('email')">Email Id<?php $fieldis = 'email';
            iconSetter($fieldis, $sort); ?>
          <span class='email sortIcon'></span>
          </th>

          <th>
            <a href="javascript:void(0)" onclick="onSortClick('birthDate')">Birth Date<?php $fieldis = 'birthDate';
            iconSetter($fieldis, $sort); ?>
          <span class='birthDate sortIcon'></span>
          </th>
          <!-- <script>$('.sortIcon').text('▲▼');</script> -->

          <th>
            <a class='btn btn-danger btnDeleteAll'>Delete</th>
          </tr>
          <?php
            // output data of each row
            $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $name = $row['firstname'].' '.$row['position'];
                $username = $row['username'];
                $mobileno = $row['mobileno'];
                $email = $row['email'];
                $birthDate = $row['birthDate']; ?>
                  <tr id="row<?= $id ?>">
                  <td><input type="checkbox" class="case" name="case" value= <?= $id ?> ></td>
                  <td>  <?= $id ?>  </td>
                  <td>  <?= $name ?>  </td>
                  <td>  <?= $username ?>  </td>
                  <td>  <?= $mobileno ?>  </td>
                  <td>  <?= $email ?> </td>
                  <td>  <?= $birthDate ?> </td>
                  <td class="tablecell">
                    <!-- <a class="btn btn-danger" href="javascript:void(0)" onclick="onDeleteClick(<?= $id ?>)">  Delete  </a> -->
                    <a class="btn btn-danger btnDelete" href="javascript:void(0)" id="btn<?= $id ?>"name="<?= $id ?> ">  Delete  </a>

                  </td>
                  </tr>

          <?php

            } ?>
              </table>
          <?php

        } else {
            //we also can use 404 page not found link here
            // here we start from default page
            $homepage = '/Php/ViewData.php';
            $currentpage = $_SERVER['PHP_SELF'];
            if ($currentpage !== $homepage) {
                // here i am solving to many redirects
                header('Location:'.$homepage);
            }
            echo '0 results'; // echo $currentpage ."\n"; echo "\n" . $homepage;
        }
        $sql = 'SELECT * FROM registration '.$where;
        $result = mysqli_query($conn, $sql);
        $total_records = mysqli_num_rows($result);
        $total_pages = ceil($total_records / $row_per_page);
        $commonLink = $_PHP_SELF.'?sorting='.$sort.'&field='.$field.'&rows='.$row_per_page.'&searchQuery='.$searchQuery;
?>
      <center>
      <ul class='pagination  pagination-md fixed '>

      <li class="<?= ($page != 1 && $page != $_PHP_SELF) ? '' : 'disabled'; ?>">
        <a href="javascript:void(0)" onclick='<?= ($page != 1 && $page != $_PHP_SELF) ? 'onClickPage(1)' : ''; ?>'>First Page</a>
      </li>

          <li class="<?= ($page == $total_pages) ? 'disabled' : ''; ?>">
          <a href="javascript:void(0)" onclick='<?= ($page == $total_pages) ? '' : "onClickPage($page + 1)"; ?>'> Next Page </a>
          </li>
<?php
        // looping to get echo of total_pages link
        for ($i = 1; $i <= $total_pages; ++$i) {
            ?>
        <li class="<?= ($page == $i) ? 'active' : ''; ?>">
        <a href="javascript:void(0)" onclick="onClickPage(<?= $i?>)"><?= $i?></a>
        </li>
<?php

        }
            ?>
        <li class="<?= ($page != 1 && $page != $_PHP_SELF) ? '' : 'disabled'; ?>">
        <a href="javascript:void(0)" onclick='<?= ($page != 1 && $page != $_PHP_SELF) ? "onClickPage(($page - 1))" : ''; ?>'>Previous Page</a>
        </li>

        <li class="<?= ($page == $total_pages) ? 'disabled' : ''; ?>">
          <a href="javascript:void(0)" onclick='<?= ($page == $total_pages) ? '' : "onClickPage($total_pages)"; ?>'>Last Page</a>
        </li>
        </ul>
      </center>

    </div>
      <script type="text/javascript">

              var page = "<?= $page ?>";
              var sorting = "<?= $sort ?>";
              var field = "<?= $field ?>";
              var rows = "<?= $row_per_page ?>";
              var searchQuery = "<?= $searchQuery ?>";

        function makeUrl() {
        if (searchQuery) {
          var link = "<?= $_PHP_SELF ?>?page="+page+"&sorting="+sorting+"&field="+field+"&rows="+rows+"&searchQuery="+searchQuery;
          }else {
          var link = "<?= $_PHP_SELF ?>?page="+page+"&sorting="+sorting+"&field="+field+"&rows="+rows;
          }
          window.location = link;
        }

        function onClickPage(p) {
           page = p;
           makeUrl();
         }

        function onRowClick(ele) {
            rows = ele.value;
            makeUrl();
        }
        document.getElementById('single').value = rows;

        function onSortClick(f) {
            if(field == f) {
              if(sorting == "ASC") {
                sorting = "DESC";
              } else {
                sorting = "ASC";
              }
            } else {
              sorting = "ASC";
              field = f;
            }
            makeUrl();
         }

         $(document).ready(function() {
           $('.btnDelete').click(function(e) {
             e.stopPropagation();
             var deleteID = $(this).attr('name');
             var row = deleteID;
            $.ajax({
                type: "GET",
                url: "Delete.php?id=" + deleteID,
                data: "deleteID="+ deleteID,
                beforeSend: function(){
                    $('#btn'+row).addClass('deleteImage');
                    $('#btn'+row).removeClass('btn-danger');
                    $('#btn'+row).text('');
                },
                complete: function(){
                    $('#btn'+row).text('');
                },
                success: function(result){
                    $('#row'+row).hide(500);
                }
            });
        });
});
      </script>
    </body>
</html>
