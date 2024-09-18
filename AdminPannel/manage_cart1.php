<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['Add_To_Cart'])) {
        if (isset($_SESSION['cart'])) {
            $myitems = array_column($_SESSION['cart'], 'Item_name');
            if (in_array($_POST['Item_name'], $myitems)) {
                echo '<script>alert("Item already added"); window.location.href="indexcart.php";</script>';
            } else {
                $count = count($_SESSION['cart']);
                $_SESSION['cart'][$count] = array('Item_name' => $_POST['Item_name'], 'Price' => $_POST['price'], 'Quantity' => 1);
                echo '<script>alert("Item added"); window.location.href="indexcart.php";</script>';
            }
        } else {
            // Add new item to cart
            $_SESSION['cart'][0] = array('Item_name' => $_POST['Item_name'], 'Price' => $_POST['price'], 'Quantity' => 1);
            echo '<script>alert("Item added"); window.location.href="indexcart.php";</script>';
        }
    }
    if (isset($_POST['Remove_item'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['Item_name'] == $_POST['Item_name']) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                echo '<script>alert("Item removed"); window.location.href="mycart.php";</script>';
            }
        }
    }
}
?>
