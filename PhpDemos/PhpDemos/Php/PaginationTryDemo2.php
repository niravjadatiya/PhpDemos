<!DOCTYPE html><html>
<head>
<title>PHP Pagination</title>
</head>

<body>
    <?php
    // Establish Connection to the Database
    $con =new mysqli('localhost','root','root','phpDataBase');

    //Records per page
    $per_page =10;

    if (isset($_GET["page"])) {
    $page = $_GET["page"];
    }
    else {
    $page = 1;
    }

    // Page will start from 0 and Multiple by Per Page
    $start_from = ($page-1) * $per_page;

    //Selecting the data from table but with limit
    $query = "SELECT * FROM registration LIMIT $start_from, $per_page";
    $result = mysqli_query ($con, $query);

    ?>

    <table align="center" border="2″ cellpadding="3″>
    <tr><th>Name</th><th>Phone</th><th>Country</th></tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr align="center">
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['firstname']; ?></td>
    </tr>
    <?php
    };
    ?>
    </table>

    <div>
    <?php

    //Now select all from table
    $query = "SELECT * FROM registration";
    $result = mysqli_query($con, $query);

    // Count the total records
    $total_records = mysqli_num_rows($result);

    //Using ceil function to divide the total records on per page
    $total_pages = ceil($total_records / $per_page);

    //Going to first page
    if($_GET['page'] != 1) {
    echo "<center><a href='PaginationTryDemo2.php?page=1'>".'First Page'."</a>";
    } else echo "<center>";

    echo "<a href='PaginationTryDemo2.php?page=" . ($_GET['page']+1) . "'>Next Page</a>";

    for ($i=1; $i<=$total_pages; $i++) {

    echo "<a href='PaginationTryDemo2.php?page=".$i."'>".$i."</a> ";
    };

    echo "<a href='PaginationTryDemo2.php?page=" . ($_GET['page']-1) . "'>Previous Page</a>";

    // Going to last page
    if($_GET['page'] != $total_pages) {
    echo "<a href='PaginationTryDemo2.php?page=$total_pages'>".'Last Page'."</a></center> ";
    } else echo "</center>";
    ?>

</div>

</body>
</html>
