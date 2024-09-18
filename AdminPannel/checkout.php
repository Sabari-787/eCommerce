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
while ($row = $result->fetch_assoc()) {
    $grandTotal += $row['price'] * $row['quantity'];
}

$order_success = false;
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['address'])) {
    $address = $conn->real_escape_string($_POST['address']);

    // Insert new address into user table
    $address_query = "UPDATE users SET address='$address' WHERE id=$user_id";
    if ($conn->query($address_query) === TRUE) {
        // Insert new order into orders table
        $order_query = "INSERT INTO orders (user_id, total) VALUES ($user_id, $grandTotal)";
        if ($conn->query($order_query) === TRUE) {
            $order_id = $conn->insert_id;
            $result->data_seek(0); // Reset the result pointer to fetch items again
            while ($item = $result->fetch_assoc()) {
                $food_id = $item['food_id'];
                $quantity = $item['quantity'];
                $item_query = "INSERT INTO order_items (order_id, food_id, quantity) VALUES ($order_id, $food_id, $quantity)";
                $conn->query($item_query);
            }
            $conn->query("DELETE FROM cart WHERE user_id = $user_id");
            $order_success = true;
        } else {
            $order_success = false;
            $error_message = "Error: " . $order_query . "<br>" . $conn->error;
        }
    } else {
        $order_success = false;
        $error_message = "Error: " . $address_query . "<br>" . $conn->error;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['address'])) {
    $error_message = "Please enter your address.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Checkout</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Checkout</h1>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $order_success): ?>
            <div class="alert alert-success text-center">Order placed successfully!</div>
            <div class="text-center">
                <h3>Order Summary</h3>
                <p>Name: [Customer Name]</p>
                <p>Address: <?php echo htmlspecialchars($_POST['address']); ?></p>
                <p>Total: $<?php echo number_format($grandTotal, 2); ?></p>
                <!-- You might want to add details of ordered items here -->
            </div>
        <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <div class="alert alert-danger text-center">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        <?php if ($_SERVER["REQUEST_METHOD"] != "POST" || !$order_success): ?>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
            </form>
        <?php endif; ?>
        <div class="text-center mt-3">
            <a href="homeindex.php" class="btn btn-secondary">Continue Shopping</a>
        </div>
    </div>
</body>
</html>
