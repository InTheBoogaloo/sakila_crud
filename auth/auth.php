<?php
session_start();
if (!isset($_SESSION["staff_id"])) {
    header("Location: ../auth/login.php");
    exit;
}
