<?php
session_start();
//Checking if user is logged in
if (isset($_SESSION["student_id"])) {
    session_unset();
    session_destroy();
    header("location:../login.php");
}
