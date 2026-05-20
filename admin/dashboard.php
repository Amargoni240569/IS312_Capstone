<?php

$pageTitle = "Dashboard";

session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: /bakersbakery/auth/admin_login.php");
    exit();
}

require_once __DIR__ . "/header.php";

?>

<div class="dashboard">

    <div class="dashboard-card">

        <h2>
            Welcome,
            <?php echo $_SESSION["username"]; ?> 🍞
        </h2>

        <p>
            Welcome to Bakers Bakery Management Dashboard.
        </p>

        <div class="dashboard-buttons">

            <a href="products.php">
                Manage Products
            </a>

            <a href="reviews.php">
                Customer Reviews
            </a>

            <a href="gallery.php">
                View Gallery
            </a>

            <a href="../auth/admin_logout.php"
            class="logout-btn">
                Logout
            </a>

        </div>

    </div>

</div>

<?php
require_once __DIR__ . "/footer.php";
?>