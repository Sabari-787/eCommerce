<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    $name = $_POST['name'];
    $food = $_POST['food'];

    $conn = new mysqli('localhost', 'root', '', 'Demo');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

  //  $stmt = $conn->prepare("INSERT INTO food (item, foods, person_name) VALUES (?, ?, ?)");
   // $stmt->bind_param("sss", $category, $food, $name);
   
    $sql = "INSERT INTO food (item, foods, person_name) VALUES ('$category', '$food', '$name')";
    $stmt = mysqli_query($conn, $sql);

    if ($stmt) {
        echo "Record added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

}
?>
