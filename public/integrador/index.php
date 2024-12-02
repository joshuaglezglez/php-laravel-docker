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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Gestión de Empleados</h1>
        <div class="text-end mb-3">
            <a href="formulario.php" class="btn btn-primary">Agregar Nuevo Empleado</a>
        </div>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
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
                            <a href="formulario.php?id=<?= $empleado['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="eliminar.php?id=<?= $empleado['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este registro?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
