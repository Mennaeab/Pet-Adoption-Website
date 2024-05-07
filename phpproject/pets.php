<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.webp">
    <title>Pet Adoption</title>
</head>
<body>

<?php include('header.php'); ?>

<h1>Find Your Perfect Pet!</h1>

<form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="species">Filter by Pet Type:</label>
    <select name="species" id="species">
        <option value="all" <?php if (!isset($_GET['species']) || $_GET['species'] == 'all') echo 'selected'; ?>>All Pets</option>
        <option value="Cat" <?php if (isset($_GET['species']) && $_GET['species'] == 'Cat') echo 'selected'; ?>>Cats</option>
        <option value="Dog" <?php if (isset($_GET['species']) && $_GET['species'] == 'Dog') echo 'selected'; ?>>Dogs</option>
    </select>
    <button type="submit">Filter</button>
</form>

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "adoptpetsco";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Build query based on selected pet type
    $sql = "SELECT * FROM pets";
    
    if (isset($_GET['species']) && $_GET['species'] != 'all') {
        $sql .= " WHERE species = :species";
    }

    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);

    if (isset($_GET['species']) && $_GET['species'] != 'all') {
        $stmt->bindParam(':species', $_GET['species']);
    }

    $stmt->execute();

    // Display the filtered pets
    echo "<div class='pet-cards'>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='pet-card'>";
        echo "<h2>" . $row["name"] . "</h2>";
        echo "<p><strong>Breed:</strong> " . $row["breed"] . "</p>";
        echo "<p><strong>Age:</strong> " . $row["age"] . "</p>";
        echo "<p><strong>Gender:</strong> " . $row["gender"] . "</p>";
        echo "<img src='" . $row["photo"] . "' alt='" . $row["name"] . "' style='max-width: 100%;'>";
        echo "<a href='pet_details.php?id=" . $row["pet_id"] . "' class='button'>View Details</a>";
        echo "</div>";
    }
    echo "</div>";

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$pdo = null;
?>

<?php include('footer.php'); ?>

<script src="js/script.js"></script>

</body>
</html>

