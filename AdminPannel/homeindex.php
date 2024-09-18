<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: loginuser.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'auth');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category = isset($_GET['type']) ? $_GET['type'] : 'veg';

// Fetch items from the database based on the selected category
$query = "SELECT id, item, type, price, images FROM food WHERE type = '$category'";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Food Items</title>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container">
        <h1 class="text-center my-4">Food Items</h1>
        <div class="text-center mb-4">
            <a href="homeindex.php?type=veg" class="btn btn-success">Veg</a>
            <a href="homeindex.php?type=non+veg" class="btn btn-danger">Non Veg</a>
            <a href="view_cart.php" class="btn btn-info">View Cart</a> <!-- Link to view cart -->
        </div>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <form action="manage_cart.php" method="POST">
                        <div class="card">
                            <img src="<?php echo htmlspecialchars($row['images']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['item']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['item']); ?></h5>
                                <p class="card-text">Type: <?php echo htmlspecialchars($row['type']); ?></p>
                                <p class="card-text">Price: <?php echo htmlspecialchars($row['price']); ?></p>
                                <input type="number" name="quantity" value="1" min="1" class="form-control mb-2">
                                <button type="submit" name="Add_To_Cart" class="btn btn-info">Add to Cart</button>
                                <input type="hidden" name="Item_name" value="<?php echo htmlspecialchars($row['item']); ?>">
                                <input type="hidden" name="food_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <input type="hidden" name="price" value="<?php echo htmlspecialchars($row['price']); ?>">
                            </div>
                        </div>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
<?php
$conn->close();
?>
