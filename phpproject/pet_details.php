<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.webp">
    <title>Pet Details</title>
</head>
<body>

<?php include('header.php'); ?>

<main class="container">
    <div class="pet-details">
        <?php
        session_start();

        // Retrieve pet ID from URL param
        if (isset($_GET['id'])) {
            $pet_id = $_GET['id'];

            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "adoptpetsco";

            try {
                $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Retrieve pet details based on the ID
                $sql = "SELECT * FROM pets WHERE pet_id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $pet_id);
                $stmt->execute();
                $pet = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($pet) {
                    // Display detailed pet information
                    echo "<h2>" . $pet["name"] . "</h2>";
                    echo "<p><strong>Breed:</strong> " . $pet["breed"] . "</p>";
                    echo "<p><strong>Age:</strong> " . $pet["age"] . "</p>";
                    echo "<p><strong>Gender:</strong> " . $pet["gender"] . "</p>";
                    echo "<p><strong>Description:</strong> " . $pet["description"] . "</p>";
                    echo "<img src='" . $pet["photo"] . "' alt='" . $pet["name"] . "' style='max-width: 100%;'>";

                    // Add to wishlist or adopt buttons
                    echo "<a href='wishlist.php?id=" . $pet["pet_id"] . "' class='details-button'>Favorite Pet</a>";
                    echo "<a href='adopt.php?id=" . $pet["pet_id"] . "' class='details-button'>Adopt</a>";
                } else {
                    echo "Pet not found.";
                }

            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }

            $pdo = null;
        } else {
            echo "Invalid request.";
        }
        ?>
    </div>
</main>

<?php include('footer.php'); ?>

<script src="js/script.js"></script>

</body>
</html>

