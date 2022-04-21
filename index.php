<?php require("controllerUserData.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="style.css">

    <title>Login Form</title>
</head>
<style>
    .error {
        color: red;
    }
</style>

<body>

    <!-- Load Login,Signup Page -->
    <?php
    $PagesDirectory = 'Pages Folder';
    if (!empty($_GET['PageName'])) {
        $PagesFolder = scandir($PagesDirectory, 0);
        unset($PagesFolder[0], $PagesFolder[1]);
        $PageName = $_GET['PageName'];
        if (in_array($PageName . '.php', $PagesFolder)) {
            include($PagesDirectory . '/' . $PageName . '.php');
        } else {
            echo '<h2>Sorry Page Not Found</h2>';
        }
    } else {
        include($PagesDirectory . '/Login.php');
    }
    ?>

    <script src="script.js"></script>

</body>

</html>