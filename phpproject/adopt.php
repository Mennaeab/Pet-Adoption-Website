<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.webp">
    <title>Adopt a Pet</title>
</head>
<body>

<?php include('header.php'); ?>

<main>
    <div class="adoption-form">
        <h1>Adopt a Pet</h1>

        <?php

         session_start();


        
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

                // Retrieve pet details based on pet ID
                $sql = "SELECT * FROM pets WHERE pet_id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $pet_id);
                $stmt->execute();
                $pet = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($pet) {
                    // Display pet adoption request form
                    echo "<h2>" . $pet["name"] . "</h2>";
                    echo "<p><strong>Breed:</strong> " . $pet["breed"] . "</p>";
                    echo "<p><strong>Age:</strong> " . $pet["age"] . "</p>";
                    echo "<p><strong>Gender:</strong> " . $pet["gender"] . "</p>";
                    echo "<img src='" . $pet["photo"] . "' alt='" . $pet["name"] . "' style='max-width: 100%;'>";

                    // Adoption request form
                    echo "<form method='post' action='submit_request.php'>";
                    echo "<input type='hidden' name='pet_id' value='" . $pet_id . "'>";
                    echo "<label for='name'>Your Name:</label>";
                    echo "<input type='text' id='name' name='name' required><br>";
                    echo "<label for='email'>Your Email:</label>";
                    echo "<input type='email' id='email' name='email' required><br>";
                    echo "<label for='message'>Additional Message:</label>";
                    echo "<textarea id='message' name='message' rows='4' required></textarea><br>";
                    echo "<button type='submit'>Submit Adoption Request</button>";
                    echo "</form>";
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
    </div>
</main>

<?php include('footer.php'); ?>

<script src="js/script.js"></script>

</body>
</html>
