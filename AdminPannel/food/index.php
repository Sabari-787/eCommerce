<!DOCTYPE html>
<html>
<head>
    <title>Food Selection</title>
</head>
<body>
    <form action="process.php" method="post">
        <label for="category">Food Category:</label>
        <select name="category" id="category">
            <option value="veg">Veg</option>
            <option value="non-veg">Non-Veg</option>
        </select>
        <br><br>
        
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        
        <label for="food">Food Item:</label>
        <input type="text" id="food" name="food" required>
        <br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
