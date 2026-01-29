<?php
require "../auth/auth.php";
require "../config/db.php";

$id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare(
        "UPDATE staff
         SET first_name=?, last_name=?, email=?, active=?
         WHERE staff_id=?"
    );

    $stmt->bind_param(
        "sssii",
        $_POST["first_name"],
        $_POST["last_name"],
        $_POST["email"],
        $_POST["active"],
        $id
    );
    $stmt->execute();
    header("Location: index.php");
}

$result = $conn->query("SELECT * FROM staff WHERE staff_id=$id");
$staff = $result->fetch_assoc();
?>

<form method="POST">
    <input name="first_name" value="<?= $staff["first_name"] ?>">
    <input name="last_name" value="<?= $staff["last_name"] ?>">
    <input name="email" value="<?= $staff["email"] ?>">
    <select name="active">
        <option value="1" <?= $staff["active"] ? "selected" : "" ?>>Activo</option>
        <option value="0" <?= !$staff["active"] ? "selected" : "" ?>>Inactivo</option>
    </select>
    <button>Actualizar</button>
</form>
