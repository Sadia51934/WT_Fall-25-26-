<?php
$loggedUser = "";

if (isset($_GET['user'])) {
    $loggedUser = $_GET['user'];
}

session_start();

$loggedUser = "";

if (isset($_SESSION["username"])) {
    $loggedUser = $_SESSION["username"];
} elseif (isset($_COOKIE["username"])) {
    $loggedUser = $_COOKIE["username"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bookstore Management System</title>
    <link rel="stylesheet" href="../Css/dashboard.css">
</head>
<body>

<!-- Header Start -->
<header class="header">
    <div class="logo">
        <img src="../Picture/logo.jpg" alt="BookZone Logo">
        <span>BookZone</span>
    </div>

    <?php if (!empty($loggedUser)) { ?>
        <h2 class="welcome-text">
            Welcome, <?php echo $loggedUser; ?>!!
        </h2>
    <?php } ?>

    <nav class="nav">
        <a href="../php/index.php">Home</a>
        <a href="../php/booklist.php">Books</a>

        <?php if (empty($loggedUser)) { ?>
            <!-- If no user logged in, show Login -->
            <a href="../php/login.php">Login</a>
        <?php } else { ?>
            <!-- If user is logged in, show Logout -->
            <a href="../php/logout.php">Logout</a>
        <?php } ?>

        <a href="#footer">Contact</a>
    </nav>
</header>
<!-- Header End -->

<!-- Main Start -->
<main>

 <section class="banner">
    <div class="banner-content">
        <h1>Discover Your Next Favorite Book</h1>
        <p>Explore new arrivals and special discounts every week!</p>
        <a href="../php/booklist.php" id="buyNowBtn" class="banner-btn">Buy Now</a>
    </div>
</section>

<!-- Search Bar -->
<section class="search-section">
    <div class="search-container">
        <input type="text" placeholder="Search Books" class="search-bar">
        <button class="search-btn">
            <img src="../Picture/search.png" alt="Search" class="search-icon">
        </button>
    </div>
</section>

<section id="arrival-section"></section>
<section class="popular-books-section"></section>
<section class="discount-section"></section>

</main>
<!-- Main End -->

<!-- Footer Start -->
<footer id="footer">
    <div class="footer-content">

        <div class="footer-section">
            <h3>BookMart</h3>
            <p>© 2025 BookMart</p>
            <p>All Rights Reserved</p>
        </div>

        <div class="footer-section">
            <h4>Contact Info</h4>
            <p>Email: <a href="mailto:info@bookmart.com">info@bookmart.com</a></p>
            <p>Phone: +880 1234-567890</p>
            <p>Address: Dhaka, Bangladesh</p>
        </div>

        <div class="footer-section">
            <h4>Quick Links</h4>
            <p><a href="#">Privacy Policy</a></p>
            <p><a href="#">Terms & Conditions</a></p>
        </div>

    </div>
</footer>
<!-- Footer End -->

<script src="../Javascript/dashboard.js"></script>

</body>
</html>
