
<?php
    include 'Config.php';
    session_start();
    // print_r($_POST);
    // print_r("this is post");

    // Check connection
    if (!$conn) {
        die('Connection failed: '.mysqli_connect_error());
    }
    $firstname = $_POST['firstname']; // Fetching Values from URL.
    $lastname = $_POST['lastname'];
    $userName = $_POST['username'];
    $mobileno = $_POST['mobileno'];
    $email = $_POST['emailid'];
    $password = sha1($_POST['password']); // Password Encryption, If you like you can also leave sha1.
    $birthDate = $_POST['birthDate'];
    str_replace('-', '', $birthDate);

    $sql = "INSERT INTO registration (firstname, lastname,username, mobileno,email,password,birthDate)
    VALUES ('$firstname', '$lastname','$userName','$mobileno','$email','$password','$birthDate')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data submit successfully please verifying your email address');
        window.location.href='Form.php';</script>";
    } else {
        echo 'Error: '.$sql.'<br>'.mysqli_error($conn);
    }
      mysqli_close($conn);
      session_unset();
      session_destroy();
?>
