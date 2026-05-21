<?php
/*
|--------------------------------------------------------------------------
| HEADER
|--------------------------------------------------------------------------
*/
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo $pageTitle; ?>
    </title>

    <link rel="stylesheet"
    href="/bakersbakery/assets/css/style.css">

</head>

<body>

<header class="header">
    <div class="top-header">
        <div class="logo-section">
            <img src="/bakersbakery/assets/images/logo.png" alt="Bakers Bakery Logo" width="150">
            <h1>Bakers Bakery</h1>
        </div>

        <div class="admin-info">

            <span>
                Hi, Admin
            </span>

            <a href="../auth/admin_logout.php"
            class="logout-btn">

                Logout

            </a>
        </div>

    </div>

    <!-- NAVIGATION -->

    <nav class="navbar">
        <a href="dashboard.php">Dashboard</a>
        <a href="products.php">Products</a>
        <a href="gallery.php">Gallery</a>
        <a href="reviews.php">Reviews</a>
        <a href="messages.php">Messages</a>
        <a href="../public/index.php">Frontend</a>
    </nav>

</header>

<div class="page-container">