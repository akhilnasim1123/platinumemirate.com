<?php
session_start();
// $con = new mysqli("localhost", "root","","platinum");
$con = new mysqli("localhost", "u688626878_platinum","Plat@#6677","u688626878_platinum");
if (!isset($_SESSION["habrix_admin_loggedin"])) {
    header("Location: login.php");
}

?>
