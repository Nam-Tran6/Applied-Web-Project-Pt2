<?php
session_start();
include "settings.php"; // Connects to your database

// Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Page</title>
</head>
<body>
    <h1>Hello <?php echo htmlspecialchars($_SESSION['user']); ?></h1>
    
    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
