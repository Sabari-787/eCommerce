<?php
// Database connection details
$conn = new mysqli('localhost', 'root', '', 'auth');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch records from the database
$sql = "SELECT * FROM food";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table class="table table-bordered">';
    echo '<thead><tr><th>Item</th><th>Type</th><th>price</th><th>Status</th><th>Actions</th></tr></thead>';
    echo '<tbody>';
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["item"] . '</td>';
        echo '<td>' . $row["type"] . '</td>';
        echo '<td>' . $row["price"] . '</td>';
        echo '<td>' . $row["status"] . '</td>';
        echo '<td><a href="edit.php?id=' . $row["id"] . '">Edit</a> | <a href="delete.php?id=' . $row["id"] . '">Delete</a></td>';
        
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo "0 results";
}

// Close the connection
$conn->close();
?>
