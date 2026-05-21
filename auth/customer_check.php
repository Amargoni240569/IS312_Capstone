<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['customer_id'])){
    header("Location: /bakersbakery/auth/customer_login.php");
    exit();
}

?>