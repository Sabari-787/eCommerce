<?php
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login Page</title>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-3">
            <form action="manage_cart.php" method="POST">
                <div class="card">
                    <img src="Images/Building a React Advice App with API Integration _ Learn React Hooks and Fetch Datal _ Day - 08(480P)_thumb.jpg" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">Food</h5>
                        <p class="card-text">Price: 450</p>
                        <button type='submit' name='Add_To_Cart' class="btn btn-info">Add to Cart</button>
                        <input type="hidden" name="Item_name" value="food 1">
                        <input type="hidden" name="price" value="450">
                    </div>
                </div>
            </form>
        </div>
        <!-- Repeat the above div for each product with unique name and price values -->
    </div>
</div>
</body>
</html>
