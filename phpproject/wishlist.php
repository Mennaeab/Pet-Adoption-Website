<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
    <title>Add to favorites</title>
</head>
<body>

<?php include('header.php'); ?>

<main>
    <div class="wishlist-content">
        <h1>Add to Wishlist</h1>

        <?php

        session_start();
        // Check if pet ID is provided in the URL
        if (isset($_GET['id'])) {
            $pet_id = $_GET['id'];

            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "adoptpetsco";

            try {
                // Connect to database
                $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Retrieve pet details based on their ID
                $sql = "SELECT * FROM pets WHERE pet_id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $pet_id);
                $stmt->execute();
                $pet = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($pet) {
                    // Display the pets information
                    echo "<h2>" . $pet["name"] . "</h2>";
                    echo "<p><strong>Breed:</strong> " . $pet["breed"] . "</p>";
                    echo "<p><strong>Age:</strong> " . $pet["age"] . "</p>";
                    echo "<p><strong>Gender:</strong> " . $pet["gender"] . "</p>";
                    echo "<p><strong>Description:</strong> " . $pet["description"] . "</p>";
                    echo "<img src='" . $pet["photo"] . "' alt='" . $pet["name"] . "' style='max-width: 100%;'>";
                    echo "<p><strong>This pet has been added to your wishlist!</strong></p>";
                } else {
                    echo "Pet not found.";
                }

            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }

            $pdo = null;
        } else {
            echo "Invalid request. Pet ID not provided.";
        }
        ?>

        <a href="pets.php" class="button">Back to Pet List</a>
    </div>
</main>

<?php include('footer.php'); ?>

<script src="js/script.js"></script>

</body>
</html>
