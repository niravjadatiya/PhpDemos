<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>First php</title>
</head>
<body>
	<h1>This is my first Php Page</h1>

<?php
// This is a single-line comment
// This is also a single-line comment
/*
 * This is a multiple-lines comment block
 * that spans over multiple
 * lines
 */
// You can also use comments to leave out parts of a code line
$x = 5  + 15 ;
$y = 5;
$z = $x+$y;
echo $z , "<br> ";

echo "Hello World!<br>";
echo "Hello World!<br>";
echo "Hello World!<br>";

$color = "red";
        echo "My Car is " . $color . "<br>";
        echo "My house is " . $COLOR . "<br>";
        echo "My boat is " .$coLoR . "<br>";

$txt = "Logisticinfotech.com";
        echo "<h1>I love $txt </h1>";

        function myTest($x)
        {
            global $y;//accessing global variable to function
            echo "<p>this is x inside function $x $y</p>";
            $GLOBALS['z'] = $GLOBALS['y']+$GLOBALS['y']+$GLOBALS['y'];
        }
        myTest($x);

        echo "<p>this is z out side function $z </p>";
        function staticCheck()
        {
            static $a = 0;
            echo("<h1> $a </h1>");
            print $a + $a;
            var_dump($a);
            $a++;
            "<br>";
        }

        var_dump($color). "<br>";
        $carArray = array("volvo","bmw","toyota");
        var_dump($carArray). "<br>";
        staticCheck();
        staticCheck();
        staticCheck();

class Car
{
    public function Car()
    {
        "<br>";
        $this->model = "Tata Nano";
    }
}
$model  = new Car();
echo "<br><br>";
echo $model->model;
echo "<br><br>";
$null = null;
var_dump($null);
echo "<br><br>";
echo strlen("Hello world!");
echo "<br>";
echo str_word_count("Hello World this is test");
echo "<br>";
echo strrev("hello world");
echo "<br>";
echo strpos("Hello World", "H");
echo "<br>";
echo str_replace("world", "dolly", "Hellow world");
echo "<br>";
define("Greetings", "Welcome to W3Schools", true);
echo greetings;
echo "<br>";
$colors = array("red", "green", "blue", "yellow","orange","white","black","coffee");

foreach ($colors as $value) {
    echo "$value <br>";
}

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Name: <input type="text" name="fname">
  <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = $_POST['fname'];
    if (empty($name)) {
        echo "Name is empty";
    } else {
        echo $name;
    }
}
?>
</body>
</html>
