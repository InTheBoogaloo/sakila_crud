<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare(
        "SELECT staff_id, password
         FROM staff
         WHERE username = ?
           AND active = 1
         LIMIT 1"
    );
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // ✅ MD5 (como Sakila)
    if ($user && md5($password) === $user["password"]) {
        $_SESSION["staff_id"] = $user["staff_id"];
        header("Location: ../staff/index.php");
        exit;
    }

    $error = "Usuario o contraseña incorrectos";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h1>Login</h1>

<?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>

<form method="POST">
    <input name="username" placeholder="Usuario" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button>Entrar</button>
</form>

</body>
</html>
