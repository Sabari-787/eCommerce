<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Assuming a static salt for simplicity (not recommended for real applications)
    $salt = "codeflix";

    // Encrypt the password using SHA-1 with salt
    $password_encrypted = sha1($password . $salt);

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'auth');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement with parameterized query to prevent SQL injection
    // $stmt = $conn->prepare("SELECT * FROM login WHERE username=?");
    // $stmt->bind_param("s", $username);
    // $stmt->execute();
    // $result = $stmt->get_result();

    $query="select * from login where username='$username'";
    $result=$conn->query($query);

    if ($result->num_rows == 1) {
        // User exists, verify password
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify password using password_verify
        if (password_verify($password, $hashedPassword)) {
            // Password verified, redirect to success page
            header("Location: success.php");
            exit();
        } else {
            // Password does not match, redirect to error page
            header("Location: error.html");
            exit();
        }
    } else {
        // User does not exist, redirect to error page
        header("Location: error.html");
        exit();
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
