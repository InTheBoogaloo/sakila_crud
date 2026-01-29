<?php
$conn = new mysqli("localhost", "sakila_admin", "123", "sakila");
//$conn = new mysqli("localhost", "db_22030618", "22030618", "sakila");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
