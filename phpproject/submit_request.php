<?php
session_start();

// Check if form is submitted via POST 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $pet_id = $_POST['pet_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate the form data
    if (empty($pet_id) || empty($name) || empty($email) || empty($message)) {
        echo "<h2>Error: All fields are required.</h2>";
        exit; 
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "adoptpetsco";

    try {
        // Create PDO connection
        $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert adoption request into database
        $sql = "INSERT INTO adoptionrequests (pet_id, name, email, message) VALUES (:pet_id, :name, :email, :message)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':pet_id' => $pet_id, ':name' => $name, ':email' => $email, ':message' => $message]);

        // Include header
        include('header.php');

        echo "<h2>Adoption request submitted successfully!</h2>";
        echo "<h2>Thank you for your interest in adopting this pet.</h2>";
        echo "<button class=\"details-button\" onclick=\"window.location.href = 'pets.php';\">Back to Pets</button>";


        // Include footer
        include('footer.php');

    } catch (PDOException $e) {
        // Include header
        include('header.php');

        // Check if error is due to primary key violation
        if ($e->getCode() == '23000') {
            echo "<h2>Error: Duplicate adoption request.</h2>";
        } else {
            echo "Connection failed: " . $e->getMessage();
        }

        // Include footer
        include('footer.php');

    } finally {
        // Close database connection
        $pdo = null;
    }
} else {
    // Invalid request
    echo "Invalid request.";
}
?>
