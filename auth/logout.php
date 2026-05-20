<?php

// backend logout page for admin users

session_start();

/*
|--------------------------------------------------------------------------
| DESTROY SESSION
|--------------------------------------------------------------------------
*/

session_unset();

session_destroy();

/*
|--------------------------------------------------------------------------
| REMOVE REMEMBER ME COOKIE
|--------------------------------------------------------------------------
*/

setcookie(
    "user_email",
    "",
    time() - 3600,
    "/"
);

/*
|--------------------------------------------------------------------------
| REDIRECT TO LOGIN
|--------------------------------------------------------------------------
*/

header("Location: login.php");

exit();
?>

//frontemd logout page for admin users

<?php
session_start();
session_destroy();

header("Location: login.php");
exit();
?>