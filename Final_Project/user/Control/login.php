<?php
session_start();

if (isset($_SESSION["username"])) {
    header("Location: ../php/index.php");
    exit();
}

include "../Db/dbcon.php";

$username = "";
$usernameError = $passwordError = "";
$successMessage = $errorMessage = "";

function test_input($data) {
    return trim($data);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["username"])) {
        $usernameError = "Username is required";
    } else {
        $username = test_input($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        $passwordError = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    }

    if (empty($usernameError) && empty($passwordError)) {

        $sql = "SELECT * FROM registereduser WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {

                $_SESSION["username"] = $username;
                setcookie("username", $username, time() + 86400, "/");

                $successMessage = "Login successful! Redirecting to dashboard...";

                // JavaScript redirect after 2 seconds
                echo "<script>
                    setTimeout(function() {
                        window.location.href = '../php/index.php';
                    }, 2000);
                </script>";

            } else {
                $errorMessage = "Invalid password";
            }
        } else {
            $errorMessage = "Username not found";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../Css/login.css">
</head>
<body>

<div class="container">
    <h1>Login</h1>

    <form method="post" action="">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
            <span class="error"><?php echo $usernameError; ?></span>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password">
            <span class="error"><?php echo $passwordError; ?></span>
        </div>

        <button type="submit">Login</button>
    </form>

    <?php
    if (!empty($successMessage)) {
        echo "<p class='successmsg'>$successMessage</p>";
    }

    if (!empty($errorMessage)) {
        echo "<p class='errormsg'>$errorMessage</p>";
    }
    ?>

    <p class="register-text">
        Not registered yet? <a href="../php/register.php">Register here</a>
    </p>
</div>

</body>
</html>
