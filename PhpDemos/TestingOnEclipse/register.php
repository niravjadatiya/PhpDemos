
<html>
<script>
console.log("gone in register.php");
console.log(firstname + lastname + mobileno + emailid + reemailid + password + confirmPassword + birthDate );
</script>
</html>

<?php
session_start ();
print_r ( $_POST );
$connection = mysql_connect ( "localhost", "root", "root" ); // Establishing connection with server..
if (! $connection) {
	die ( 'Could not connect: ' . mysql_error () );
}
echo 'Connected successfully';

// mysql_close ( $link );

$db = mysql_select_db ( "phpDataBase", $connection ); // Selecting Database.
$firstname = $_POST ['firstname1']; // Fetching Values from URL.
$lastname = $_POST ['lastname1'];
$mobileno = $_POST ['mobileno1'];
$email = $_POST ['email1'];
$password = sha1 ( $_POST ['password1'] ); // Password Encryption, If you like you can also leave sha1.
$birthDate = $_POST ['birthDate1'];
// Check if e-mail address syntax is valid or not

$email = filter_var ( $email, FILTER_SANITIZE_EMAIL ); // Sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
if (! filter_var ( $email, FILTER_VALIDATE_EMAIL )) {
	echo "Invalid Email.......";
} else {
	$result = mysql_query ( "SELECT * FROM registration WHERE email='$email'" );
	$data = mysql_num_rows ( $result );
	
	if (($data) == 0) {
		$query = mysql_query ( "insert into registration(firstname,lastname,mobileno,email,password,birthDate) values ('$firstname','$lastname' '$mobileno','$email','$password','$birthDate')" ); // Insert query
		
		if ($query) {
			echo "You have Successfully Registered.....";
		} else {
			echo "Error....!!";
		}
	} else {
		echo "This email is already registered, Please try another email...";
	}
}
mysql_close ( $connection );
?>