<?php
session_start();
//Checking if user is logged in
if (isset($_SESSION["admin_id"])) {
    session_destroy();
    header("location:../login.php");
}
