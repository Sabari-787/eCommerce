    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Success</title>
        <link rel="stylesheet" href="style.css">

        <style>
            .container{
                margin-top:150px;
            }
        </style>
    </head>
    <body>
    <div class="container text-white text-center">
        <h1 align="center">Admin Pannel</h1>
        <div class="row ">
            <div class="col-md-4 offset-md-4">
                <form action="process.php" enctype="multipart/form-data" method="POST">
                    <label class="adminpanneinputs my-2">category</label>
                    <select name="type" id=""class="adminpanneinputs my-2">
                        <option value="veg">veg</option>
                        <option value="non veg">non veg</option>
                    </select></br>
                    <label class="adminpanneinputs my-2">food name</label>
                    <input type="text" name="name" class="adminpanneinputs my-2"></br>

                    <label class="adminpanneinputs my-2">Price</label>
                    <input type="number" name="price" class="adminpanneinputs my-2"></br>

                    <label class="adminpanneinputs my-2">Image</label>
                    <input type="file" name="image"accept="image/*" class="adminpanneinputs my-2"><br>


                    <input type="submit" value="submit" name="submit" class=" btn btn-success adminpanneinputs my-2">
                </form>
            </div>
        </div>
    </div>

    <?php 
    include 'C:\xampp\htdocs\AdminPannel\table.php';

    
    ?>
    </body>
    </html>