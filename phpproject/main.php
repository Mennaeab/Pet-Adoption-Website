<?php
session_start();

$loggedIn = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome! Adoptpetsco</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.webp">
</head>
<body>

<?php include('header.php'); ?>

<?php
// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    // User is logged in, show welcome message and logout link
    echo "<h2>Welcome, {$_SESSION['username']}!</h2>";
} else 
?>
<main>
    <img src="images/home-background2.png" alt="Main Background Image" class="homepage-image">
</main>

<?php


// display the logout button if user is logged in
if ($loggedIn) {
    echo '
    <!-- Logout Button Form -->
    <form action="logout.php" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
    ';
}

?>

<?php include('footer.php'); ?>

<script src="js/script.js"></script>

</body>
</html>
