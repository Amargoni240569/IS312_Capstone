<?php
session_start();

require_once __DIR__ . '/../config/db.php';

$error = "";

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT customer_id, full_name, password_hash FROM customers WHERE email = ?");

        if(!$stmt){
            die("SQL Error: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password_hash'])){

            $_SESSION['customer_id'] = $user['customer_id'];
            $_SESSION['customer_name'] = $user['full_name'];

            header("Location: /bakersbakery/public/index.php");
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
    <link rel="stylesheet" href="/bakersbakery/assets/css/style.css">
</head>
<body class="login-body">

<div class="login-container">

<h2>Bakers Bakery</h2>    
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

        <button
        type="button"
        id="orangeModeBtn">

            <a class="login.btn" href="/bakersbakery/auth/admin_login.php">Login as Admin</a>

        </button>

    </form>

    <p>
        <br>No account?
        <a href="/bakersbakery/auth/register.php">Register</a>
    </p>


</div>

</body>
</html>