<?php

session_start();

// Database connection credentials
$host = "localhost";
$dbname = "adoptpetsco";
$dbUsername = "root";
$dbPassword = "";

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve form data SECURELY
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate input data
    if (empty($username) || empty($password)) {
        echo "<h2>Login failed. Please enter username and password.</h2>";
        echo '<a href="main.php">Back to Login</a>';
        exit; // Stop script execution
    }

    // Retrieve user data from database
    $stmt = $pdo->prepare("SELECT username, password FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch();

    // Verify password if user exists
    if ($user) {
        $hashed_password_from_db = $user['password'];

        if (password_verify($password, $hashed_password_from_db)) {
            $_SESSION['username'] = $username; // Set session variable
            header("Location: main.php"); // Redirect to main.php or desired page
            exit;
        }else {
            // incorrect password, display error message
            echo "<h2>Login failed. Invalid username or password.</h2>";
            echo '<a href="main.php">Back to Login</a>'; // Provide a link to return to login form
        }
    } else {
        // User not found in database, display the error message
        echo "<h2>Login failed. User not found.</h2>";
        echo '<a href="main.php">Back to Login</a>';
    }
} catch (PDOException $e) {

    echo "Connection failed: " . $e->getMessage();
}

// Close database connection
$pdo = null;
?>

