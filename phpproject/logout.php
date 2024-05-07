<?php
session_start();

// Check if the logout form is submitted
if (isset($_POST['logout'])) {
    $_SESSION = [];

    // End the session
    session_destroy();

    // Redirect to the login page after logout
    header("Location: signin.php");
    exit;
} else {
    // If logout form is not submitted, redirect to login page
    header("Location: login.php");
    exit;
}
?>
