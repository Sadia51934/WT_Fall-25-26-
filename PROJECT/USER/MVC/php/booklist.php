<?php
session_start();
include("../Model/dbcon.php");

$result = mysqli_query($conn, "SELECT * FROM books");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book List - BookZone</title>
    <link rel="stylesheet" href="../Css/booklist.css">
</head>
<body>

<h2>Book List</h2>

<div class="book-grid">
<?php while($book = mysqli_fetch_assoc($result)) { ?>
    <div class="book">
        <img src="../Picture/<?php echo $book['image']; ?>" alt="<?php echo $book['title']; ?>">

        <h3>
            <a href="bookdetails.php?id=<?php echo $book['id']; ?>">
                <?php echo $book['title']; ?>
            </a>
        </h3>

        <p><b>Author:</b> <?php echo $book['author']; ?></p>
        <p><b>Price:</b> ৳<?php echo $book['final_price']; ?></p>
        <p><b>Status:</b> <?php echo $book['status']; ?></p>

        <!-- ADD TO CART FORM -->
        <form method="post" action="add_to_cart.php">
            <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
            <input type="hidden" name="title" value="<?php echo $book['title']; ?>">
            <input type="hidden" name="price" value="<?php echo $book['final_price']; ?>">
            <input type="submit" name="add_cart" value="Add to Cart">
        </form>
    </div>
<?php } ?>
</div>

</body>
</html>
