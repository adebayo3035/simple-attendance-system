<?php
session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    header("Location:login.php");
    die();
}
unset($_SESSION["admin_email"]);
unset($_SESSION["userLogin"]);
header("Location:login.php");
?>