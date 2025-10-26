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
        // header footer
        include "footer.inc";
    ?>

</body>
</html>
