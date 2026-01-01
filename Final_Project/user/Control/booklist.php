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
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        h2 { text-align: center; margin-bottom: 20px; }
        .book-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; }
        .book { background: white; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
        .book img { width: 120px; height: 160px; object-fit: cover; margin-bottom: 10px; }
        .book h3 { margin: 10px 0 5px; font-size: 18px; }
        .book p { margin: 5px 0; font-size: 14px; }
        .btn { padding: 8px 12px; border: none; border-radius: 5px; cursor: pointer; margin: 3px; }
        .btn.cart { background-color: #3498db; color: white; }
        .btn.wishlist { background-color: #e67e22; color: white; }
        .btn:hover { opacity: 0.85; }
    </style>
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
