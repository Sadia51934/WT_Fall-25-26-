<html>
<head>
    <title>PHP Form Validation</title>
</head>

<body>
<h1>PHP Form Validation</h1>

<?php

$name = $email = $dob = $age = "";
$nameerror = $emailerror = $doberror = $ageerror = $checkboxerror = $radioerror = "";
$hobbies = $activities = "";

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

    if (empty($_POST["hobbies"])) {
        $checkboxerror = "At least one hobby must be selected.";
    } else {
        $hobbies = $_POST["hobbies"];
    }

    if (empty($_POST["activities"]) || count($_POST["activities"]) < 2) {
        $checkboxerror = "At least two activities must be selected.";
    } else {
        $activities = $_POST["activities"];
    }

    if (empty($_POST["gender"])) {
        $radioerror = "Gender must be selected.";
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

    Select Hobbies (at least one):
    <br>
    <input type="checkbox" name="hobbies[]" value="Reading"> Reading
    <input type="checkbox" name="hobbies[]" value="Traveling"> Traveling
    <input type="checkbox" name="hobbies[]" value="Gaming"> Gaming
    <span style="color:red"><?php echo $checkboxerror; ?></span>
    <br><br>

    Select Activities (at least two):
    <br>
    <input type="checkbox" name="activities[]" value="Football"> Football
    <input type="checkbox" name="activities[]" value="Basketball"> Basketball
    <input type="checkbox" name="activities[]" value="Swimming"> Swimming
    <span style="color:red"><?php echo $checkboxerror; ?></span>
    <br><br>

    Gender:
    <input type="radio" name="gender" value="Male"> Male
    <input type="radio" name="gender" value="Female"> Female
    <input type="radio" name="gender" value="Other"> Other
    <span style="color:red"><?php echo $radioerror; ?></span>
    <br><br>

    <input type="submit" value="Submit">
</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($nameerror) && empty($emailerror) && empty($doberror) && empty($checkboxerror) && empty($radioerror)) {
    echo "<br>The Name is: " . $name;
    echo "<br>The Email is: " . $email;
    echo "<br>The Date of Birth is: " . $dob;
    echo "<br>Selected Hobbies: " . implode(", ", $hobbies);
    echo "<br>Selected Activities: " . implode(", ", $activities);
    echo "<br>Gender: " . $gender;
}
?>

</body>
</html>