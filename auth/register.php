<?php
session_start();
include "../config/db.php";

$message = "";

if(isset($_POST['register'])){

    $accountType = trim($_POST['account_type']);
    $email = trim($_POST['email']);
    $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    /*
    =========================================
    CUSTOMER REGISTRATION
    =========================================
    */

    if($accountType === "customer"){

        $fullName = trim($_POST['fullname']);
        $phoneNumber = trim($_POST['phone_number']);

        // Check existing customer email
        $check = $conn->prepare("
            SELECT COUNT(*)
            FROM customers
            WHERE email=?
        ");

        $check->bind_param("s", $email);
        $check->execute();
        $check->bind_result($count);
        $check->fetch();
        $check->close();

        if($count > 0){

            $message = "Customer email already exists";

        } else {

            $stmt = $conn->prepare("
                INSERT INTO customers(
                    full_name,
                    email,
                    password_hash,
                    phone_number
                )
                VALUES(?, ?, ?, ?)
            ");

            $stmt->bind_param(
                "ssss",
                $fullName,
                $email,
                $passwordHash,
                $phoneNumber
            );

            if($stmt->execute()){

                $message = "Customer registered successfully";

            } else {

                $message = "Error: " . $stmt->error;

            }
        }
    }

    /*
    =========================================
    ADMIN REGISTRATION
    =========================================
    */

    elseif($accountType === "admin"){

        $username = trim($_POST['username']);

        // Check existing admin
        $check = $conn->prepare("
            SELECT COUNT(*)
            FROM users
            WHERE username=? OR email=?
        ");

        $check->bind_param("ss", $username, $email);
        $check->execute();
        $check->bind_result($count);
        $check->fetch();
        $check->close();

        if($count > 0){

            $message = "Admin username or email already exists";

        } else {

            $stmt = $conn->prepare("
                INSERT INTO users(
                    username,
                    email,
                    password_hash
                )
                VALUES(?, ?, ?)
            ");

            $stmt->bind_param(
                "sss",
                $username,
                $email,
                $passwordHash
            );

            if($stmt->execute()){

                $message = "Admin registered successfully";

            } else {

                $message = "Error: " . $stmt->error;

            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="login-container">

    <form method="POST" class="login-form">

        <h2>Register</h2>

<?php if($message != ""): ?>

    <p style="
        text-align:center;
        color:green;
        margin-bottom:20px;
        font-weight:bold;
    ">
        <?php echo $message; ?>
    </p>

<?php endif; ?>

<select 
    name="account_type" 
    id="account_type"
    onchange="toggleFields()"
    required
>
    <option value="">-- Register As --</option>
    <option value="customer">Customer</option>
    <option value="admin">Admin</option>
</select>

<!-- CUSTOMER FIELDS -->

<div id="customerFields" style="display:none;">

    <input
        type="text"
        name="fullname"
        placeholder="Full Name"
    >

    <input
        type="text"
        name="phone_number"
        placeholder="Phone Number"
    >

</div>

<!-- ADMIN FIELDS -->

<div id="adminFields" style="display:none;">

    <input
        type="text"
        name="username"
        placeholder="Username"
    >

</div>

<!-- COMMON FIELDS -->

<input
    type="email"
    name="email"
    placeholder="Email Address"
    required
>

<div class="password-box">

    <input
        type="password"
        name="password"
        id="password"
        placeholder="Password"
        required
    >

    <span onclick="togglePassword()">👁</span>

</div>

<button type="submit" name="register">
    Register
</button>

<button
    type="button"
    onclick="window.location.href='../auth/customer_login.php'"
>
    Customer Login
</button>

<button
    type="button"
    onclick="window.location.href='../auth/admin_login.php'"
>
    Admin Login
</button>
    </form>

</div>

<script>

function togglePassword(){

    let password = document.getElementById("password");

    if(password.type === "password"){

        password.type = "text";

    }else{

        password.type = "password";
    }
}

function toggleFields(){

    let accountType = document.getElementById("account_type").value;

    let customerFields = document.getElementById("customerFields");

    let adminFields = document.getElementById("adminFields");

    if(accountType === "customer"){

        customerFields.style.display = "block";
        adminFields.style.display = "none";

    }
    else if(accountType === "admin"){

        customerFields.style.display = "none";
        adminFields.style.display = "block";

    }
    else{

        customerFields.style.display = "none";
        adminFields.style.display = "none";
    }
}

</script>

</body>
</html>