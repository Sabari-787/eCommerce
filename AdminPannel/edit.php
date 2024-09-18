<?php
$conn = new mysqli('localhost', 'root', '', 'auth');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $item = $_POST['item'];
    $type = $_POST['type'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE food SET item=?, type=?, status=? WHERE id=?");
    $stmt->bind_param("sssi", $item, $type, $status, $id);

    if ($stmt->execute()) {
        header("Location: success.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM food WHERE id=$id");
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Food Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
     rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <div class="container text-white">
        <div class="row">
            <div class="col-md-4 offset-md-4">
            <form method="POST" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label class="adminpanneinputs my-2">Item:</label><input class="adminpanneinputs my-2" type="text" name="item" value="<?php echo $row['item']; ?>"><br>
        <label class="adminpanneinputs my-2">Type:</label><input class="adminpanneinputs my-2" type="text" name="type" value="<?php echo $row['type']; ?>"><br>
        <label class="adminpanneinputs my-2">Status:</label><br>
        <select name="status" class="adminpanneinputs my-2" class="adminpanneinputs my-2">
            <option value="Active" <?php if ($row['status'] == 'Active') echo 'selected'; ?>>Active</option>
            <option value="non Active" <?php if ($row['status'] == 'non active') echo 'selected'; ?>>non Active</option>
        </select>

        <input type="submit" name="submit" value="Update" class="adminpanneinputs my-2">
        
    </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
