<?php
session_start();
include("../Db/dbregister.php");

/* Check if book id exists */
if (!isset($_GET['id'])) {
    header("Location: ../php/booklist.php");
    exit();
}

$id = $_GET['id'];

/* Fetch book details */
$result = mysqli_query($conn, "SELECT * FROM books WHERE id='$id'");
$book = mysqli_fetch_assoc($result);

if (!$book) {
    echo "Book not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $book['title']; ?> - Details</title>
    <link rel="stylesheet" href="../Css/bookdetails.css">
</head>
<body>

<a href="booklist.php" class="back-link">← Back to Book List</a>

<div class="details-container">

    <div class="book-image">
        <img src="../Picture/<?php echo $book['image']; ?>" alt="<?php echo $book['title']; ?>">
    </div>

    <div class="book-info">
        <h2><?php echo $book['title']; ?></h2>

        <p><b>Author:</b> <?php echo $book['author']; ?></p>
        <p><b>Price:</b> ৳<?php echo $book['price']; ?></p>

        <?php if ($book['discount'] > 0) { ?>
            <p><b>Discount:</b> <?php echo $book['discount']; ?>%</p>
            <p class="final-price">৳<?php echo $book['final_price']; ?></p>
        <?php } ?>

        <p><b>Status:</b> <?php echo $book['status']; ?></p>

        <p class="description">
            <b>Description:</b><br>
            <?php echo $book['description']; ?>
        </p>

        <!-- ADD TO CART -->
        <form method="post" action="add_to_cart.php">
            <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
            <input type="hidden" name="title" value="<?php echo $book['title']; ?>">
            <input type="hidden" name="price" value="<?php echo $book['final_price']; ?>">
            <button type="submit" class="cart-btn">Add to Cart</button>
        </form>

    </div>
</div>

</body>
</html>
