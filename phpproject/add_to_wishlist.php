<?php
session_start();

if (isset($_POST['add_to_wishlist']) && isset($_SESSION['user_id'])) {
    $pet_id = $_POST['pet_id'];
    $user_id = $_SESSION['user_id'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "adoptpetsco";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert into the wishlist table
        $stmt = $pdo->prepare("INSERT INTO wishlist (user_id, pet_id) VALUES (:user_id, :pet_id)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':pet_id', $pet_id);
        $stmt->execute();

        // Redirect back to pet details page with the success messge
        header("Location: wishlist.php?id=$pet_id&added=true");
        exit;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
} else {

    header("Location: login.php");
    exit;
}
?>
