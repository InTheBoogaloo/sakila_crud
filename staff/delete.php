<?php
require "../auth/auth.php";
require "../config/db.php";

$id = $_GET["id"];

$conn->query("UPDATE staff SET active=0 WHERE staff_id=$id");
header("Location: index.php");
