<?php
include 'conexion.php';

// Consultar todos los registros
$query = $link->query("SELECT * FROM empleados ORDER BY id ASC");
$empleados = $query->fetchAll(PDO::FETCH_ASSOC);

// Función para obtener el URL de Gravatar
function getGravatarUrl($email, $size = 100) {
    $default = "https://via.placeholder.com/$size"; // Placeholder si no tiene Gravatar
    $grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?s=$size&d=" . urlencode($default);
    return $grav_url;
}
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
        <div class="row g-4">
            <?php foreach ($empleados as $empleado): ?>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="<?= getGravatarUrl($empleado['email'], 200) ?>" class="card-img-top" alt="Avatar de <?= htmlspecialchars($empleado['nombre']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($empleado['nombre']) ?></h5>
                            <p class="card-text"><strong>Teléfono:</strong> <?= htmlspecialchars($empleado['telefono']) ?></p>
                            <p class="card-text"><strong>Área:</strong> <?= htmlspecialchars($empleado['area']) ?></p>
                            <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($empleado['email']) ?></p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="formulario.php?id=<?= $empleado['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="eliminar.php?id=<?= $empleado['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este registro?');">Eliminar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
