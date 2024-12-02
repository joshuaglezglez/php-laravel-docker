<?php
include 'conexion.php';

// Consultar todos los registros
$query = $link->query("SELECT * FROM empleados ORDER BY id ASC");
$empleados = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empleados</title>
</head>
<body>
    <h1>Gestión de Empleados</h1>
    <a href="formulario.php">Agregar Nuevo Empleado</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Área</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empleados as $empleado): ?>
                <tr>
                    <td><?= $empleado['id'] ?></td>
                    <td><?= $empleado['nombre'] ?></td>
                    <td><?= $empleado['telefono'] ?></td>
                    <td><?= $empleado['area'] ?></td>
                    <td><?= $empleado['email'] ?></td>
                    <td>
                        <a href="formulario.php?id=<?= $empleado['id'] ?>">Editar</a>
                        <a href="eliminar.php?id=<?= $empleado['id'] ?>" onclick="return confirm('¿Está seguro de eliminar este registro?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
