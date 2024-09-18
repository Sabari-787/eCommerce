<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: loginuser.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'auth');



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Add_To_Cart'])) {
    $user_id = $_SESSION['user_id'];
    $item_name = $_POST['Item_name'];
    $food_id = $_POST['food_id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Check if the item already exists in the cart
    $check_query = "SELECT * FROM cart WHERE user_id = ? AND food_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ii", $user_id, $food_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If the item exists, update the quantity
        $update_query = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND food_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("iii", $quantity, $user_id, $food_id);
        if ($stmt->execute()) {
            header("Location: view_cart.php");
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        // If the item does not exist, insert a new row
        $insert_query = "INSERT INTO cart (user_id, item_name, food_id, price, quantity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("isidi", $user_id, $item_name, $food_id, $price, $quantity);
        if ($stmt->execute()) {
            header("Location: view_cart.php");
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}

$conn->close();
?>
