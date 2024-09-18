<?php
session_start(); // Start session to access cart items

// Check if cart exists in session and retrieve cart items
$cart_items = [];
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Establish database connection
    $conn = new mysqli('localhost', 'root', '', 'auth');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare array of item IDs from session cart
    $item_ids = array_keys($_SESSION['cart']);

    // Prepare placeholders for item IDs
    $placeholders = implode(',', array_fill(0, count($item_ids), '?'));

    // Prepare SQL statement to fetch cart items
    $sql = "SELECT f.item, f.price, ac.quantity, ac.created_at, ac.item_id
            FROM food f
            JOIN addcart ac ON f.id = ac.item_id
            WHERE ac.item_id IN ($placeholders)";

    // Prepare and bind parameters for item IDs
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat('i', count($item_ids)), ...$item_ids); // 'i' for integer

    // Execute SQL query
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        // Fetch data and store in cart_items array
        while ($row = $result->fetch_assoc()) {
            $item_id = $row['item_id']; // Ensure 'item_id' is selected in the SQL query
            if (isset($_SESSION['cart'][$item_id])) {
                $cart_items[] = [
                    'item' => $row['item'],
                    'price' => $row['price'],
                    'quantity' => $_SESSION['cart'][$item_id]['quantity'],
                    'total' => $row['price'] * $_SESSION['cart'][$item_id]['quantity'],
                    'created_at' => $row['created_at']
                ];
            }
        }
    } else {
        echo "Error executing SQL query: " . $stmt->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
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
        <h1 class="text-center my-4">Cart Items</h1>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <?php if (!empty($cart_items)): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Added On</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart_items as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['item']); ?></td>
                                <td>$<?php echo number_format($item['price'], 2); ?></td>
                                <td><?php echo $item['quantity']; ?></td>
                                <td>$<?php echo number_format($item['total'], 2); ?></td>
                                <td><?php echo date('Y-m-d H:i:s', strtotime($item['created_at'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <p class="text-center">Your cart is empty.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
