<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

/*
 Si ya hay sesión iniciada → staff
 Si no → login
*/

if (isset($_SESSION["staff_id"])) {
    header("Location: staff/index.php");
} else {
    header("Location: auth/login.php");
}

exit;
