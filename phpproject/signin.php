<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.webp">
    <title>Sign In</title>
</head>
<body>

<?php include('header.php'); ?>
<main>
    <img src="images/signin-background.png" alt="Main Background Image" class="homepage-image">
    
</main>
    <div class="main-content">
        <div class="login-form">
            <h2>Login</h2>
            <form action="login.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>
                <button type="submit">Login</button>
            </form>
        </div>
        <div class="signup-form">
    <h2>New user? Register here</h2>
    <?php
    session_start();
    

    $username = "";
    $usernameError = "";
    $passwordError = "";

    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $username = $_POST['username'];
        $password = $_POST['password'];

        $host = "localhost";
        $dbname = "adoptpetsco";
        $dbUsername = "root";
        $dbPassword = "";

        try {
            // Create PDO connection
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbUsername, $dbPassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if username already exists
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch();

            if ($user) {
                $usernameError = "Username already in use. Please choose a different one.";
            }

            // Validate password complexity
            if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {
                $passwordError = "Password must contain at least one uppercase letter, one lowercase letter, and one number.";
            }

            // If no errors, proceed with registration
            if (empty($usernameError) && empty($passwordError)) {
                // Encrypt/Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insert data into database
                $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':username' => $username, ':password' => $hashed_password]);

                echo "<p>New user created successfully!</p>";

                // Reset form fields after registration
                $username = "";
                $password = "";
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        // Close database connection
        $pdo = null;
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
        <?php if (!empty($usernameError)) { echo "<span style='color: red;'>$usernameError</span><br>"; } ?><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required 
               pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}"
               title="Password must be at least 8 characters long and include at least one lowercase letter, one uppercase letter, and one number.">
        <?php if (!empty($passwordError)) { echo "<span style='color: red;'>$passwordError</span><br>"; } ?><br>

        <button type="submit">Sign Up</button>
    </form>
</div>
    </div>
</main>

<?php include('footer.php'); ?>

<script src="js/script.js"></script>

</body>
</html>
