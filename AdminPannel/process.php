<?php
$conn = new mysqli('localhost', 'root', '', 'auth');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['submit'])) {
    $category = $_POST['type'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $status = "Active"; // Default status



    $file_name=$_FILES['image']['name'];
    $tempname=$_FILES['image']['tmp_name'];

    $folder='Images/'.$file_name;
    
    // Adjust the status value as per your requirement
if(move_uploaded_file($tempname,$folder)){
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO food (item, type, price,status,images) VALUES (?, ?, ?,?,?)");
    $stmt->bind_param("sssss", $name, $category, $price,$status,$folder);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('New record created successfully')</script>";
        header("Location: success.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
}
// Close the connection
$conn->close();
?>
