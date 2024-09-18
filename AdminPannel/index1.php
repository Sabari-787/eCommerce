<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
   
    <div class="container">
        <div class="row ">
            <div class="col-md-12 col-md-offset-5 " align="center">
                <form action="login.php" method ="POST">
                    <input type="text" name="username" class="form-control"><br>
                    <input type="password" name="password" class="form-control"><br /> 
                    <input type="submit" value="login" class="btn btn-success ">
                </form>

            </div>
        </div>
    </div>
</body>
</html>