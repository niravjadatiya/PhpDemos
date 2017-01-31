<!DOCTYPE html>
<html>
<head>
  <title>View Data</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>

</style>
</head>
<body>

<?php
      $servername = "localhost";
      $username = "root";
      $password = "root";
      $dbname = "phpDataBase";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      $tbl_name = 'registration'
      // get all data from server
      $query = "SELECT COUNT(*) as num FROM $tbl_name";
      $sql = "SELECT * FROM registration";

      $result = $conn->query($sql);

      //number of total row
      $total_row = $result->num_rows;
          printf("Result set has %d rows.\n", $total_row);

      //how many rows needed per page
      $row_per_page = 10;

      //finding figure of total pages
      $total_pages = ceil( $total_row / $row_per_page );
        printf("number of pages %d \n", $total_pages);

        if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
           // cast var as int
           $currentpage = (int) $_GET['currentpage'];
        } else {
           // default page num
           $currentpage = 1;
        } // end if

        // $sql = "SELECT id, firstname, lastname, username, mobileno, email, birthDate FROM registration LIMIT 10";

      if ($result->num_rows >0) {
          echo "<div class='container'>";
          echo "<h2>Here is the list of registerd user</h2>";
          echo "<table class='table table-inverse table-hover table-bordered table-responsive'> <tr class='success'> <th>ID</th> <th>Name</th> <th>User Name</th> <th>Mobile No</th> <th>Email Id</th> <th> Birth Date</th><th>Delete</th> </tr>";
           // output data of each row
           while ($row = $result->fetch_assoc()) {
               echo "<tr><td>" . $row["id"]. "</td><td>" . $row["firstname"]. " " . $row["lastname"]. "</td> <td>" . $row["username"] ."</td><td>" . $row["mobileno"] ."</td><td>" . $row["email"] ."</td><td>" . $row["birthDate"] ."</td> <td class='tablecell'>" ."</td></tr>";
           }

          echo "<script> var button = $('<button>Delete</button>'); button.click(function() {alert('do u really want to delete me');}); button.appendTo('.tablecell');</script>";
          echo "</table>";
          echo "</div>";
      } else {
          echo "0 results";
      }

      $conn->close();
?>

</body>
</html>
