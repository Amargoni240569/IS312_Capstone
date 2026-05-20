<?php
session_start();
require_once "../config/db.php"; // adjust path if needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Get user
    $stmt = $conn->prepare("SELECT user_id, username, password_hash, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();

        // CHECK PASSWORD
        if (password_verify($password, $user["password_hash"])) {

            // SET SESSION (IMPORTANT)
            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["username"] = $user["username"];

            // REDIRECT TO DASHBOARD
            header("Location: /bakersbakery/admin/dashboard.php");
            exit();

        } else {
            $_SESSION["error"] = "Invalid password";
            header("Location: /bakersbakery/auth/admin_login.php");
            exit();
        }

    } else {
        $_SESSION["error"] = "User not found";
        header("Location: /bakersbakery/auth/admin_login.php");
        exit();
    }
}
?>