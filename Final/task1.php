<html>
<head>
    <title>PHP Form Validation</title>
</head>

<body>
<h1>PHP Form Validation</h1>

<?php

$name = $email = $dob = "";
$nameerror = $emailerror = $doberror = $ageerror = $checkboxerror = $radioerror = $degreeerror = $bloodgrouperror = "";
$gender = $degree = $bloodgroup = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) {
        $nameerror = "Name is required.";
    } else {
        $name = text_input($_POST["name"]);

        if (!preg_match("/^[a-zA-Z]/", $name)) {
            $nameerror = "Name must start with a letter.";
        } elseif (!preg_match("/^[a-zA-Z .-]+$/", $name)) {
            $nameerror = "Name can only contain letters, spaces, periods, and dashes.";
        } elseif (str_word_count($name) < 2) {
            $nameerror = "Name must contain at least two words.";
        }
    }

    if (empty($_POST["email"])) {
        $emailerror = "Email is required.";
    } else {
        $email = text_input($_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailerror = "Please enter a valid email address.";
        }
    }

    if (empty($_POST["dob"])) {
        $doberror = "Date of birth is required.";
    } else {
        $dob = text_input($_POST["dob"]);

        $date_parts = explode('-', $dob);
        if (count($date_parts) != 3) {
            $doberror = "Invalid date format. Use dd-mm-yyyy.";
        } else {
            list($day, $month, $year) = $date_parts;
            if ($year < 1953 || $year > 1998) {
                $doberror = "Year must be between 1953 and 1998.";
            } elseif ($month < 1 || $month > 12) {
                $doberror = "Month must be between 1 and 12.";
            } elseif ($day < 1 || $day > 31) {
                $doberror = "Day must be between 1 and 31.";
            }
        }
    }

    if (empty($_POST["degree"]) || count($_POST["degree"]) < 2) {
        $degreeerror = "Please select at least two degrees.";
    } else {
        $degree = $_POST["degree"];
    }

    if (empty($_POST["bloodgroup"])) {
        $bloodgrouperror = "Please select a blood group.";
    } else {
        $bloodgroup = $_POST["bloodgroup"];
    }

    if (empty($_POST["gender"])) {
        $radioerror = "Please select a gender.";
    } else {
        $gender = $_POST["gender"];
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

    Email:
    <input type="email" name="email" value="<?php echo $email; ?>">
    <span style="color:red"><?php echo $emailerror; ?></span>
    <br><br>

    Date of Birth (dd-mm-yyyy):
    <input type="text" name="dob" value="<?php echo $dob; ?>">
    <span style="color:red"><?php echo $doberror; ?></span>
    <br><br>

    Gender:
    <input type="radio" name="gender" value="Male" <?php echo ($gender == "Male" ? "checked" : ""); ?>> Male
    <input type="radio" name="gender" value="Female" <?php echo ($gender == "Female" ? "checked" : ""); ?>> Female
    <input type="radio" name="gender" value="Other" <?php echo ($gender == "Other" ? "checked" : ""); ?>> Other
    <span style="color:red"><?php echo $radioerror; ?></span>
    <br><br>

    Degree (Select at least two):
    <input type="checkbox" name="degree[]" value="SSC" <?php echo (in_array("SSC", $degree) ? "checked" : ""); ?>> SSC
    <input type="checkbox" name="degree[]" value="HSC" <?php echo (in_array("HSC", $degree) ? "checked" : ""); ?>> HSC
    <input type="checkbox" name="degree[]" value="BSc" <?php echo (in_array("BSc", $degree) ? "checked" : ""); ?>> BSc
    <input type="checkbox" name="degree[]" value="MSc" <?php echo (in_array("MSc", $degree) ? "checked" : ""); ?>> MSc
    <span style="color:red"><?php echo $degreeerror; ?></span>
    <br><br>

    Blood Group:
    <select name="bloodgroup">
        <option value=""> </option>
        <option value="A+" <?php echo ($bloodgroup == "A+" ? "selected" : ""); ?>>A+</option>
        <option value="B+" <?php echo ($bloodgroup == "B+" ? "selected" : ""); ?>>B+</option>
        <option value="O+" <?php echo ($bloodgroup == "O+" ? "selected" : ""); ?>>O+</option>
        <option value="AB+" <?php echo ($bloodgroup == "AB+" ? "selected" : ""); ?>>AB+</option>
        <option value="A-" <?php echo ($bloodgroup == "A-" ? "selected" : ""); ?>>A-</option>
        <option value="B-" <?php echo ($bloodgroup == "B-" ? "selected" : ""); ?>>B-</option>
        <option value="O-" <?php echo ($bloodgroup == "O-" ? "selected" : ""); ?>>O-</option>
        <option value="AB-" <?php echo ($bloodgroup == "AB-" ? "selected" : ""); ?>>AB-</option>
    </select>
    <span style="color:red"><?php echo $bloodgrouperror; ?></span>
    <br><br>

    <input type="submit" value="Submit">
</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($nameerror) && empty($emailerror) && empty($doberror) && empty($degreeerror) && empty($bloodgrouperror) && empty($radioerror)) {
    echo "<br>The Name is: " . $name;
    echo "<br>The Email is: " . $email;
    echo "<br>The Date of Birth is: " . $dob;
    echo "<br>Gender: " . $gender;
    echo "<br>Degrees: " . implode(", ", $degree);
    echo "<br>Blood Group: " . $bloodgroup;
}
?>

</body>
</html>
