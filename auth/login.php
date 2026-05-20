<?php

session_start();

if(isset($_SESSION["user_id"])){

    header("Location: ../pages/dashboard.php");
    exit();
}
?>
// backend login page for admin users

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
    action="authenticate.php"
    method="POST"
    class="login-form">

        <h2>Ã°Å¸ÂÅ¾ Bakers Bakery</h2>
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
                Ã°Å¸â€˜ÂÃ¯Â¸Â
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

            <a href="/bakersbakery/frontend/auth/login.php">Login as Customer</a>

        </button>

    </form>

</div>

<script src="../../bakersbakery/assets/js/script.js"></script>

</body>
</html>

//frontend login page for customers
<?php
session_start();
include "../../backend/config/db.php";

$error = "";

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT customer_id, full_name, password_hash FROM customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password_hash'])){

            $_SESSION['customer_id'] = $user['customer_id'];
            $_SESSION['customer_name'] = $user['full_name'];

            header("Location: ../pages/index.php");
            exit();

        } else {
            $error = "Invalid password";
        }

    } else {
        $error = "Account not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Login</title>
    <link rel="stylesheet" href="../../backe/bakersbakery/assets/css/style.css">
</head>
<body class="login-body">

<div class="login-container">

<h2>Ã°Å¸ÂÅ¾ Bakers Bakery</h2>    
<br><h3>Customer Login</h3>

    <?php if($error): ?>
        <p class="error-message"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" class="login-form">

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">
            Login
        </button>

        <button type="submit" name="login">
           <a href="/bakersbakery/backend/auth/login.php">Login as Admin</a> </button>

    </form>

    <p>
        <br>No account?
        <a href="register.php">Register</a>
    </p>


</div>

</body>
</html>

// auth check for customer pages

<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['customer_id'])){
    header("Location: ../auth/login.php");
    exit();
}

?>