<!DOCTYPE html>
<html>
<head>
    <title>PHP Form Validation</title>
</head>
<body>

<h1>PHP Form Validation</h1>

<?php
$name = $email = "";
$dd = $mm = $yyyy = "";
$gender = $bloodgroup = "";
$degree = [];

$nameerror = $emailerror = $doberror = "";
$gendererror = $degreeerror = $bloodgrouperror = "";

function clean($data) {
    return trim($data);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* NAME */
    if (empty($_POST["name"])) {
        $nameerror = "Name is required";
    } else {
        $name = clean($_POST["name"]);
        if (!preg_match("/^[A-Za-z]/", $name)) {
            $nameerror = "Must start with a letter";
        } elseif (!preg_match("/^[A-Za-z .-]+$/", $name)) {
            $nameerror = "Only letters, dot and dash allowed";
        } elseif (str_word_count($name) < 2) {
            $nameerror = "Must contain at least two words";
        }
    }

    /* EMAIL */
    if (empty($_POST["email"])) {
        $emailerror = "Email is required";
    } else {
        $email = clean($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailerror = "Invalid email format";
        }
    }
    
    $dd = clean($_POST["dd"]);
    $mm = clean($_POST["mm"]);
    $yyyy = clean($_POST["yyyy"]);

    if ($dd == "" || $mm == "" || $yyyy == "") {
        $doberror = "Date of birth is required";
    } elseif ($dd < 1 || $dd > 31 || $mm < 1 || $mm > 12 || $yyyy < 1953 || $yyyy > 1998) {
        $doberror = "Invalid date values";
    }

    /* GENDER */
    if (empty($_POST["gender"])) {
        $gendererror = "Select a gender";
    } else {
        $gender = $_POST["gender"];
    }

    /* DEGREE */
    if (empty($_POST["degree"]) || count($_POST["degree"]) < 2) {
        $degreeerror = "Select at least two degrees";
    } else {
        $degree = $_POST["degree"];
    }

    /* BLOOD GROUP */
    if (empty($_POST["bloodgroup"])) {
        $bloodgrouperror = "Select blood group";
    } else {
        $bloodgroup = $_POST["bloodgroup"];
    }
}
?>

<form method="post">

    <b>Name</b><br>
    <input type="text" name="name" value="<?php echo $name; ?>">
    <span style="color:red"><?php echo $nameerror; ?></span>
    <br><br>

    <b>Email</b><br>
    <input type="text" name="email" value="<?php echo $email; ?>">
    <span style="color:red"><?php echo $emailerror; ?></span>
    <br><br>

    <b>Date of Birth</b><br>
    <input type="text" name="dd" size="2" placeholder="dd" value="<?php echo $dd; ?>"> /
    <input type="text" name="mm" size="2" placeholder="mm" value="<?php echo $mm; ?>"> /
    <input type="text" name="yyyy" size="4" placeholder="yyyy" value="<?php echo $yyyy; ?>">
    <span style="color:red"><?php echo $doberror; ?></span>
    <br><br>

    <b>Gender</b><br>
    <input type="radio" name="gender" value="Male" <?php if($gender=="Male") echo "checked"; ?>> Male
    <input type="radio" name="gender" value="Female" <?php if($gender=="Female") echo "checked"; ?>> Female
    <input type="radio" name="gender" value="Other" <?php if($gender=="Other") echo "checked"; ?>> Other
    <span style="color:red"><?php echo $gendererror; ?></span>
    <br><br>

    <b>Degree</b><br>
    <input type="checkbox" name="degree[]" value="SSC"> SSC
    <input type="checkbox" name="degree[]" value="HSC"> HSC
    <input type="checkbox" name="degree[]" value="BSc"> BSc
    <input type="checkbox" name="degree[]" value="MSc"> MSc
    <span style="color:red"><?php echo $degreeerror; ?></span>
    <br><br>

    <b>Blood Group</b><br>
    <select name="bloodgroup">
        <option value=""></option>
        <option>A+</option><option>B+</option><option>O+</option><option>AB+</option>
        <option>A-</option><option>B-</option><option>O-</option><option>AB-</option>
    </select>
    <span style="color:red"><?php echo $bloodgrouperror; ?></span>
    <br><br>

    <input type="submit" value="Submit">

</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    empty($nameerror) && empty($emailerror) && empty($doberror) &&
    empty($gendererror) && empty($degreeerror) && empty($bloodgrouperror)) {

    echo "<h3>Submitted Data</h3>";
    echo "Name: $name<br>";
    echo "Email: $email<br>";
    echo "DOB: $dd-$mm-$yyyy<br>";
    echo "Gender: $gender<br>";
    echo "Degree: ".implode(", ", $degree)."<br>";
    echo "Blood Group: $bloodgroup";
}
?>

</body>
</html>
