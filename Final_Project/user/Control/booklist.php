<?php
// booklist.php
include "../Model/dbcon.php"; // adjust path if needed

// Fetch all books
$result = mysqli_query($conn, "SELECT * FROM books");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
            <a href="bookdetails.php?id=<?php echo $book['id']; ?>" style="text-decoration:none; color:black;">
                <?php echo $book['title']; ?>
            </a>
        </h3>
        <p><strong>Author:</strong> <?php echo $book['author']; ?></p>
        <p><strong>Price:</strong> $<?php echo $book['final_price']; ?></p>
        <p><strong>Status:</strong> <?php echo $book['status']; ?></p>
        <button class="btn cart" onclick="addToCart('<?php echo $book['title']; ?>')">Add to Cart</button>
        <button class="btn wishlist" onclick="addToWishlist('<?php echo $book['title']; ?>')">Wishlist</button>
    </div>
<?php } ?>
</div>

<script>
function addToCart(bookName) {
    alert(bookName + " added to cart (demo)");
}

function addToWishlist(bookName) {
    alert(bookName + " added to wishlist (demo)");
}
</script>

</body>
</html>
