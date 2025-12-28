<html>
<head>
    <title>PHP Code</title>
</head>
 
<body>
<h1>This is PHP Class</h1>
 
<?php
$name = "";
$age = "";
$nameerror = "";
$ageerror = "";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if (empty($_POST["name"])) {
        $nameerror = "Enter your Name";
    } else {
        $name = text_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameerror = "Please enter a valid name";
        }
    }
 
 
    if (empty($_POST["age"])) {
        $ageerror = "Enter your Age";
    } else {
        $age = text_input($_POST["age"]);
        if (!is_numeric($age) || $age <= 0) {
            $ageerror = "Please enter a valid age";
        }
    }
}
 
function text_input($data)
{
    return trim($data);
}
?>
 
<form method="post" action="">
    Name:
    <input type="text" name="name" value="<?php echo $name; ?>">
    <span style="color:red"><?php echo $nameerror; ?></span>
    <br><br>
 
    Age:
    <input type="text" name="age" value="<?php echo $age; ?>">
    <span style="color:red"><?php echo $ageerror; ?></span>
    <br><br>
 
    <input type="submit" value="Submit">
</form>
 
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($nameerror) && empty($ageerror)) {
    echo "<br>The Name is : " . $name;
    echo "<br>The Age is : " . $age;
}
?>
 
</body>
</html>