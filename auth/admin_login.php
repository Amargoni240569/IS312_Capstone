<?php

session_start();

if(isset($_SESSION["user_id"])){

    header("Location: /bakersbakery/admin/dashboard.php");
    exit();
}
?> 

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Bakery Login</title>

    <link rel="stylesheet"
    href="/bakersbakery/assets/css/style.css">

</head>

<body class="login-body">

<div class="login-container">

    <form
    action="/bakersbakery/auth/authenticate.php"
    method="POST"
    class="login-form">

        <h2>🍞 Bakers Bakery</h2>
        <h3>Administrator Login</h3>

        <?php

        if(isset($_SESSION["error"])){

            echo "<p class='error'>"
            . $_SESSION["error"] .
            "</p>";

            unset($_SESSION["error"]);
        }

        ?>

        <input
        type="email"
        name="email"
        placeholder="Enter your email"
        required>

        <div class="password-box">

            <input
            type="password"
            name="password"
            id="password"
            placeholder="Enter your password"
            required>

            <span id="togglePassword">
                👁️
            </span>

        </div>

        <div class="remember-box">

            <input
            type="checkbox"
            name="remember">

            <label>
                Remember Me
            </label>

        </div>

        <button type="submit">
            Login
        </button>

        <button
        type="button"
        id="orangeModeBtn">

            <a class="login.btn" href="/bakersbakery/auth/customer_login.php">Login as Customer</a>

        </button>

    </form>

    <p>
        <br>No account?
        <a href="/bakersbakery/auth/register.php">Register</a>
    </p>

</div>

<script src="/bakersbakery/assets/js/script.js"></script>

</body>
</html>