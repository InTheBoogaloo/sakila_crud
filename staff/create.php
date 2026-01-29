<?php
require "../auth/auth.php";
require "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $firstName = trim($_POST["first_name"]);
    $lastName  = trim($_POST["last_name"]);
    $email     = trim($_POST["email"]);
    $password  = $_POST["password"];

    // username = antes del @
    $username = explode("@", $email)[0];

    // valores fijos del sistema
    $addressId = 1;
    $storeId   = 1;
    $active    = 1;

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "INSERT INTO staff
        (first_name, last_name, address_id, email, store_id, username, password, active)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssissssi",
        $firstName,
        $lastName,
        $addressId,
        $email,
        $storeId,
        $username,
        $passwordHash,
        $active
    );

    if (!$stmt->execute()) {
        die("Error SQL: " . $stmt->error);
    }

    header("Location: index.php");
    exit;
}
?>
<form method="POST">
    <input name="first_name" placeholder="Nombre" required>
    <input name="last_name" placeholder="Apellido" required>
    <input name="email" type="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button>Guardar</button>
</form>
