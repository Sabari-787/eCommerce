<?php
session_start(); // Start session to store cart items

// Establish database connection
$conn = new mysqli('localhost', 'root', '', 'auth');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if item_id is provided (assuming you will pass it via GET or POST)
if (isset($_GET['id'])) {
    $item_id = $_GET['id']; // Get item ID from query parameter
    $user_id = 1; // Replace with actual user ID when implementing user authentication
    $quantity = 1; // Default quantity

    // Prepare SQL statement to insert into addcart table
    $stmt = $conn->prepare("INSERT INTO addcart (item_id, user_id, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $item_id, $user_id, $quantity);

    // Execute the statement
    if ($stmt->execute()) {
        // Item successfully added to cart
        echo "Item added to cart.";
    } else {
        // Error in execution
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // Handle case where item_id is not provided
    echo "Item ID not provided.";
}

// Close database connection
$conn->close();
?>
