<?php
session_start();
include("../Db/dbregister.php");

$search = "";
$category = "";

/* Fetch categories */
$catResult = mysqli_query($conn, "SELECT * FROM categories");

/* Search + Category filter */
$query = "SELECT * FROM books WHERE 1";

if (isset($_GET['search']) && $_GET['search'] != "") {
    $search = $_GET['search'];
    $query .= " AND (title LIKE '%$search%' OR author LIKE '%$search%')";
}

if (isset($_GET['category']) && $_GET['category'] != "") {
    $category = $_GET['category'];
    $query .= " AND category_id = '$category'";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book List - BookZone</title>
    <link rel="stylesheet" href="../Css/booklist.css">
</head>
<body>

<h2 class="page-title">Browse Books</h2>

<!-- SEARCH -->
<form method="get" class="search-section">
    <div class="search-container">
        <input type="text" name="search" class="search-bar"
               placeholder="Search books..."
               value="<?php echo $search; ?>">
        <button type="submit" class="search-btn">
            <img src="../Picture/search.png">
        </button>
    </div>
</form>

<!-- CATEGORY SECTION -->
<div class="category-section">
    <a href="booklist.php" class="category-btn">All</a>

    <?php while ($cat = mysqli_fetch_assoc($catResult)) { ?>
        <a href="booklist.php?category=<?php echo $cat['id']; ?>"
           class="category-btn">
            <?php echo $cat['name']; ?>
        </a>
    <?php } ?>
</div>

<!--BOOK LIST-->
<div class="book-grid">
<?php while ($book = mysqli_fetch_assoc($result)) { ?>
    <div class="book">
        <img src="../Picture/<?php echo $book['image']; ?>">

        <h3><?php echo $book['title']; ?></h3>
        <p><b>Author:</b> <?php echo $book['author']; ?></p>
        <p class="price">৳<?php echo $book['final_price']; ?></p>
        <p class="status"><?php echo $book['status']; ?></p>

        <form method="post" action="add_to_cart.php">
            <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
            <input type="hidden" name="title" value="<?php echo $book['title']; ?>">
            <input type="hidden" name="price" value="<?php echo $book['final_price']; ?>">
            <button type="submit" class="cart-btn">Add to Cart</button>
        </form>
    </div>
<?php } ?>
</div>

</body>
</html>
