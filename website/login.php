<?php
// Establish a connection to the database
$host = 'localhost';
$dbname = 'users';
$username = 'root';
$password = '';
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Retrieve the user's email and password from the form
$email = $_POST['Email'];
$password = $_POST['Password'];

// Query the database to retrieve the user's ID
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND password = ?");
$stmt->execute([$email, $password]);
$row = $stmt->fetch();

// Authenticate the user if the SELECT statement returned a row
if ($row) {
    session_start();
    $_SESSION['user_id'] = $row['id'];
    header("Location: dashboard.php");
    exit();
} else {
    echo "Invalid email or password.";
}
?>
