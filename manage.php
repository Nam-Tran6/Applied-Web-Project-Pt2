<?php
session_start();
include "settings.php"; // Connects to your database

//  Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<body>
<h1>Hello <?php echo htmlspecialchars($_SESSION['user']); ?></h1>
</body>
</html>
