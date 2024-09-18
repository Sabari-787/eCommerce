<?php
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cart</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center border rounded bg-light my-5">
            <h1>MY Cart</h1>
        </div>
        <div class="col-lg-9">
            <table class="table text-center">
                <thead class="text-center">
                    <tr>
                        <th scope="col">Serial No.</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    if (isset($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $key => $value) {
                            $sr = $key + 1;
                            $total += $value['Price'];
                            echo "
                            <tr>
                                <td>$sr</td>
                                <td>$value[Item_name]</td>
                                <td>$value[Price]</td>
                                <td><input type='number' class='text-center' value='$value[Quantity]' min='1' max='10'></td>
                                <td>
                                    <form action='manage_cart.php' method='POST'>
                                        <button name='Remove_item' class='btn btn-sm btn-danger'>Remove</button>
                                        <input type='hidden' name='Item_name' value='$value[Item_name]'>
                                    </form>
                                </td>
                            </tr>
                            ";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-3">
            <div class="border bg-light rounded">
                <h4>Total:</h4>
                <h6><?php echo $total ?></h6>
                <form action="">
                    <div class="form-check">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioCheckedDisabled" checked disabled>
                            <label class="form-check-label" for="flexRadioCheckedDisabled">
                                Cash on Delivery
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block">
                        Make Purchase
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
