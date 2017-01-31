<?php
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

        <script type="text/javascript">


        </script>
        <style>
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
            width: calc(100% - 590px);
        }
        h2 {
          width: 390px;
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
        </style>

    </head>
    <body>

        <?php
        // for debugging php
        ini_set('display_startup_errors', 1);
        ini_set('display_errors', 1);
        error_reporting(-1);
        error_reporting(E_ALL ^ E_NOTICE);

        // connecting to server
        $servername = 'localhost';
        $username = 'root';
        $password = 'root';
        $dbname = 'phpDataBase';
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die('Connection failed: '.$conn->connect_error);
        }

        // setting page or default page 1
        $field = 'id';
        $sort = 'ASC';

        // $page = (isset($_GET['page'])) ? $_GET['page'] : $_GET['page'] = 1;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        //how many rows needed per page
        if (isset($_GET['Rows'])) {
              $row_per_page = $_GET['Rows'];
          }   else {
                $row_per_page = 10;
            }

        // $row_per_page = 10;
        if (isset($_POST['submit'])) {
            $row_per_page = $_POST['Rows'];  // Storing Selected Value In Variable
        echo 'You have selected :'.$row_per_page;  // Displaying Selected Value
        }

        // Page will start from 0 th record and Multiple by Per Page
        //we use it as offset in sql query
        $start_from = ($page - 1) * $row_per_page;

        // $field = (isset($_GET['field'])) ? $_GET['field'] : $_GET['field'] = 'id';
        if ($_GET['field'] == 'id') {
            $field = 'id';
        } elseif ($_GET['field'] == 'firstname') {
            $field = 'firstname';
        } elseif ($_GET['field'] == 'username') {
            $field = 'username';
        } elseif ($_GET['field'] == 'mobileno') {
            $field = 'mobileno';
        } elseif ($_GET['field'] == 'email') {
            $field = 'email';
        } elseif ($_GET['field'] == 'birthDate') {
            $field = 'birthDate';
        }

        // $sort = (isset($_GET['sorting'])) ? $_GET['sorting'] : 'ASC';

        if (isset($_GET['sorting'])) {
            if ($_GET['sorting'] == 'ASC') {
                $sort = 'DESC';
            } else {
                $sort = 'ASC';
            }
        }

        //getting data from server in limit of rows per page with offset of start from
        if (isset($_GET['searchQuery'])) {
            $searchQuery = "'%".$_GET['searchQuery']."%'";
            $sql = 'SELECT * FROM registration WHERE `id` LIKE '.$searchQuery.' OR `username` LIKE '.$searchQuery.'
                    OR `email` LIKE '.$searchQuery.'
                    OR `mobileno` LIKE '.$searchQuery;
        } else {
            $sql = "SELECT * FROM registration  ORDER BY $field $sort LIMIT $start_from,$row_per_page";
        }
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // php code over here
            ?>
            <div class='container'>
                <h2>List of Registerd User</h2>
                <form action="" method="GET">
                <select type="submit" name="Rows" id="single" class="form-control selectRowOption" title="10">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <!-- <input type="submit" name="submit" value="Rows" /> -->
                </select>
                </form>
            <input class="glyphicon glyphicons-search txtSearch" type="text" name="search" placeholder="Search id, UserName, EmailId, Mobile..">
            <a class="btn btn-primary btn-lg btnSearch">Search</a>


            <?php
            echo "<table class='table table-inverse table-hover table-bordered table-responsive'><tr class='success'>
          <th><input type='checkbox' id='selectall' value=''></th>
          <th id='ID'><a href='ViewData.php?sorting=" .$sort."&Rows=".$row_per_page."&field=id'>ID<span class=' ID sortIcon'></span></th>
          <th><a href='ViewData.php?sorting=" .$sort."&Rows=".$row_per_page."&field=firstname'>Name <span class=' firstname sortIcon'></span></th>

          <th><a href='ViewData.php?sorting=" .$sort."&Rows=".$row_per_page."&field=username'>User Name <span class=' username sortIcon'></span></th>

          <th><a href='ViewData.php?sorting=" .$sort."&Rows=".$row_per_page."&field=mobileno'>Mobile No <span class='  mobileno sortIcon'></span></th>

          <th><a href='ViewData.php?sorting=" .$sort."&Rows=".$row_per_page."&field=email'>Email Id <span class=' email sortIcon'></span></th>

          <th><a href='ViewData.php?sorting=" .$sort."&Rows=".$row_per_page."&field=birthDate'>Birth Date <span class=' birthDate sortIcon'></span></th>

          <th><a class='btn btn-danger btnDeleteAll'>Delete</th>
          </tr>";
          // output data of each row
          $actual_link = 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];
            while ($row = $result->fetch_assoc()) {
                echo
                '<tr>
                <td><input type="checkbox" class="case" name="case" value='.$row[id].'></td>
                <td>'.$row['id'].'</td>
                <td>'.$row['firstname'].' '.$row['lastname'].'</td>
                <td>'.$row['username'].'</td>
                <td>'.$row['mobileno'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['birthDate']."</td>
                <td class='tablecell '><a class='btn btn-danger' href=Delete.php?id=".$row['id'].'&rlocation='.$actual_link.'>Delete</a>'.'</td>
                </tr>';
            }
            echo '</table>';
            echo '</div>';
        } else {
            //we also can use 404 page not found link here
            // here we start from default page
            $homepage = '/ViewData.php';
            $currentpage = $_SERVER['PHP_SELF'];
            if (!$currentpage == '/Php/ViewData.php') {
                // here i am solving to many redirects
                header('Location:'.$_SERVER['PHP_SELF']);
            }
            echo '0 results';
        }

        $sql = 'SELECT * FROM registration ';
        $result = mysqli_query($conn, $sql);
        $total_records = mysqli_num_rows($result);

        $total_pages = ceil($total_records / $row_per_page);
        $_PHP_SELF = $_SERVER['PHP_SELF'];
        // echo "$_PHP_SELF";
        echo "<center><ul class='pagination  pagination-md'>";

        if ($_GET['page'] != 1 && $_GET['page'] != $_PHP_SELF) {
            echo '<li><a href='.$_PHP_SELF.'?sorting='.($_GET['sorting']).'&field='.$field.'&Rows='.$row_per_page.'&page=1>First Page</a></li>';
        } else {
            echo '<li class="disabled"><a href='.$_PHP_SELF.'?sorting='.($_GET['sorting']).'&Rows='.$row_per_page.'&field='.$field.'&page=1>First Page</a></li>';
        }

        if ($_GET['page'] != $total_pages) {
            echo '<li><a href='.$_PHP_SELF.'?sorting='.($_GET['sorting']).'&field='.$field.'&Rows='.$row_per_page.'&page='.($_GET['page'] + 1).'> Next Page </a></li>';
        } else {
            echo '<li class="disabled"><a href='.$_PHP_SELF.'?sorting='.($_GET['sorting']).'&Rows='.$row_per_page.'&field='.$field.'&page='.($_GET['page'] + 1).'> Next Page </a></li>';
        }

        // looping to get echo of total_pages link
        for ($i = 1; $i <= $total_pages; ++$i) {
            if ($page == $i) {
                // echo "$sort";
                echo '<li class="active"><a href='.$_PHP_SELF.'?sorting='.($_GET['sorting']).'&Rows='.$row_per_page.'&field='.$field.'&page='.$i.'>'.$i.'</a></li>';
            } else {
                echo '<li><a href='.$_PHP_SELF.'?sorting='.($_GET['sorting']).'&Rows='.$row_per_page.'&field='.$field.'&page='.$i.'>'.$i.'</a></li>';
            }
        }

        if ($_GET['page'] != 1 && $_GET['page'] != $_PHP_SELF) {
            echo '<li><a href='.$_PHP_SELF.'?sorting='.($_GET['sorting']).'&Rows='.$row_per_page.'&field='.$field.'&page='.($_GET['page'] - 1).'>Previous Page</a></li>';
        } else {
            echo '<li class="disabled"><a href='.$_PHP_SELF.'?sorting='.($_GET['sorting']).'&Rows='.$row_per_page.'&field='.$field.'&page='.($_GET['page'] - 1).'>Previous Page</a></li>';
        }

        // Going to last page
        if ($_GET['page'] != $total_pages) {
            echo '<li><a href='.$_PHP_SELF.'?sorting='.($_GET['sorting']).'&Rows='.$row_per_page.'&field='.$field.'&page='.$total_pages.'>Last Page</a></li>';
        } else {
            echo '<li class="disabled"><a href='.$_PHP_SELF.'?sorting='.($_GET['sorting']).'&Rows='.$row_per_page.'&field='.$field.'&page='.$total_pages.'>Last Page</a></li>';
        }

        // echo $_SESSION[$row_per_page] = $row_per_page;
        // php over here
        echo "<script>console.log($('#single').val());</script>";

        ?>

        </ul></center>
        </div>


    </body>
</html>
