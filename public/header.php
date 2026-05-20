<?php
/*
    header.php
*/

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="/bakersbakery/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>

<header class="header">
    <div class="top-header">
        <div class="logo-section">
            <img src="/bakersbakery/assets/images/logo.png" alt="Bakers Bakery Logo" width="150">
            <h1>Bakers Bakery</h1>
        </div>

        <div class="user-info">

            <?php if(isset($_SESSION['customer_name'])): ?>

                <span class="welcome-text">
                    Hi, <?php echo htmlspecialchars($_SESSION['customer_name']); ?>
                </span>

                <a href="/bakersbakery/auth/customer_logout.php" class="logout-btn">
                    Logout
                </a>

        <?php else: ?>

            <a href="/bakersbakery/auth/customer_login.php" class="login-btn">
                Login
            </a>

        <?php endif; ?>

        </div>

    </div>

    <!-- =========================
     NAVIGATION
    ========================= -->

<nav class="nav">

    <!-- HAMBURGER -->

    <div class="hamburger">
        ☰
    </div>

    <ul class="nav-links">

        <li>
            <a href="index.php">Home</a>
        </li>

        <!-- DROPDOWN -->

        <li class="dropdown">

            <a href="http://127.0.0.1/bakersbakery/public/products.php">
                Products ▼
            </a>

            <ul class="dropdown-menu">

                <li>
                    <a href="cake.php">Cake</a>
                </li>

                <li>
                    <a href="cookie.php">Cookies</a>
                </li>

                <li>
                    <a href="muffin.php">Muffin</a>
                </li>

                <li>
                    <a href="pastry.php">Pastry</a>
                </li>

            </ul>

        </li>

        <li>
            <a href="gallery.php">Gallery</a>
        </li>

        <li>
            <a href="reviews.php">Reviews</a>
        </li>

        <li>
            <a href="contact.php">Contact</a>
        </li>

        <li>
            <a href="about.php">About</a>
        </li>

    </ul>

</nav>

         <script src="/bakersbakery/assets/js/script.js"></script>       

</body>
</header>
