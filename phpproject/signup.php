<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/favicon.webp">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Sign Up</title>
</head>
<body>
<?php

session_start();
// Database connection
$host = "localhost";
$dbname = "adoptpetsco";
$username = "root";
$password = "";

try {
    $dsn = "mysql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];

// Check if username is already in use
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute([':username' => $username]);
$user = $stmt->fetch();

if ($user) {
    echo "Username already in use. Please choose a different one.";
} else {
    // Check password complexity
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {
        echo "Password must contain at least one uppercase letter, one lowercase letter, and one number.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the database
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([
                ':username' => $username,
                ':password' => $hashed_password
            ]);
            echo "<p>User created successfully</p>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

$pdo = null; // Close the connection
?>
</body>
</html>
