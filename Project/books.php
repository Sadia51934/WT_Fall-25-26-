<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Book Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2> Available Books</h2>

<div class="book-container">
<?php
$result = $conn->query("SELECT * FROM books");
while ($row = $result->fetch_assoc()) {
?>
    <div class="book-card">
        <img src="images/<?php echo $row['image']; ?>">
        <h3><?php echo $row['title']; ?></h3>
        <p>Author: <?php echo $row['author']; ?></p>
        <p>Price: $<?php echo $row['price']; ?></p>
        <p>Rating: <?php echo $row['rating']; ?></p>

        <a href="book_details.php?id=<?php echo $row['book_id']; ?>">
            <button>View Details</button>
        </a>

        <button onclick="addToWishlist(<?php echo $row['book_id']; ?>)">
        </button>
    </div>
<?php } ?>
</div>

<script src="script.js"></script>
</body>
</html>
