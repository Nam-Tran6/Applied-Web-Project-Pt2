<?php
session_start();
include "settings.php"; // Contains your DB connection ($conn)

// Create a new MySQLi connection to the database
$conn = new mysqli($host, $user, $pwd, $sql_db);

// Check if connection failed and stop script with error message
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepared statement to check user
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // If user exists
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        //  Verify hashed password
        if (password_verify($password, $row['password'])) {
            session_regenerate_id(true);   // prevent session from using same session again and again
            $_SESSION['user'] = $row['username']; // Save username in session
            header("Location: manage.php"); // Redirect to HR dashboard
            exit;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Username not found.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login page for company">
    <meta name="keywords" content="Company Details, login page, Common Navigation, Jira & Github link">
    <link rel="stylesheet" href="">
    <meta name="author" content="Sothearith Kuy">
<title>HR Manager Login</title>
<!--Link to Stylesheet-->
    <link rel="stylesheet" href="styles/layout.css" type="text/css">

</head>
<body>
    <?php
        // header inclusions
        include "header.inc";
    ?>

<h2 id="h2login" >HR Manager Login</h2>

<form id="formlogin" method="post">
    <input class="inputlogin" type="text" name="username" placeholder="Username" required><br>
    <input class="inputlogin" type="password" name="password" placeholder="Password" required><br>
    <button class="btnlogin" type="submit">Login</button>
</form>

<?php 
    if (!empty($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; 
    
    ?>

<?php
        // header footer
        include "footer.inc"; 
    ?>

</body>
</html>
