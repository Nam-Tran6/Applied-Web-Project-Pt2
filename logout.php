<?php
session_start(); // Start the session so we can access it
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session
header("Location: login.php"); // Redirect back to the login page
exit;
?>
