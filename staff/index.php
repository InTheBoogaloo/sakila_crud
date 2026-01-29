<?php
require "../auth/auth.php";
require "../config/db.php";

$result = $conn->query(
    "SELECT staff_id, first_name, last_name, email, username, active
     FROM staff"
);
?>

<a href="create.php">Nuevo staff</a>
<a href="../auth/logout.php">Salir</a>

<table border="1">
<tr>
    <th>ID</th><th>Nombre</th><th>Email</th><th>Usuario</th><th>Estado</th><th>Acciones</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row["staff_id"] ?></td>
    <td><?= $row["first_name"] ?> <?= $row["last_name"] ?></td>
    <td><?= $row["email"] ?></td>
    <td><?= $row["username"] ?></td>
    <td><?= $row["active"] ? "Activo" : "Inactivo" ?></td>
    <td>
        <a href="edit.php?id=<?= $row["staff_id"] ?>">Editar</a>
        <a href="delete.php?id=<?= $row["staff_id"] ?>">Eliminar</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
