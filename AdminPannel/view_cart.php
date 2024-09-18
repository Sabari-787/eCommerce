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

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM cart WHERE user_id = $user_id";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$grandTotal = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>View Cart</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Your Cart</h1>
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <?php $total = $row['price'] * $row['quantity']; ?>
                        <?php $grandTotal += $total; ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($total); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <h3 class="text-center">Grand Total: <?php echo htmlspecialchars($grandTotal); ?></h3>
            <div class="text-center">
                <a href="homeindex.php" class="btn btn-primary">Continue Shopping</a>
                <form action="checkout.php" method="POST" class="d-inline">
                    <button type="submit" class="btn btn-success">Proceed to Checkout</button>
                </form>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">Your cart is empty!</div>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
$conn->close();
?>
