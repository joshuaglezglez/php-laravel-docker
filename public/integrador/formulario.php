<?php
include 'conexion.php';

$id = $_GET['id'] ?? null;
$nombre = '';
$telefono = '';
$area = '';
$email = '';

if ($id) {
    $query = $link->prepare("SELECT * FROM empleados WHERE id = :id");
    $query->execute(['id' => $id]);
    $empleado = $query->fetch(PDO::FETCH_ASSOC);

    if ($empleado) {
        $nombre = $empleado['nombre'];
        $telefono = $empleado['telefono'];
        $area = $empleado['area'];
        $email = $empleado['email'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $area = $_POST['area'];
    $email = $_POST['email'];

    if ($id) {
        $query = $link->prepare("UPDATE empleados SET nombre = :nombre, telefono = :telefono, area = :area, email = :email WHERE id = :id");
        $query->execute(['nombre' => $nombre, 'telefono' => $telefono, 'area' => $area, 'email' => $email, 'id' => $id]);
    } else {
        $query = $link->prepare("INSERT INTO empleados (nombre, telefono, area, email) VALUES (:nombre, :telefono, :area, :email)");
        $query->execute(['nombre' => $nombre, 'telefono' => $telefono, 'area' => $area, 'email' => $email]);
    }

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $id ? 'Editar' : 'Agregar' ?> Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4"><?= $id ? 'Editar' : 'Agregar' ?> Empleado</h1>
        <p>El Avatar se genera automáticamente vía el servicio de la nube "GRAVATAR", genera el tuyo en la plataforma o el sistema generará uno vía "UI Avatars"</p>
        <form method="post" class="row g-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?= htmlspecialchars($nombre) ?>" required>
            </div>
            <div class="col-md-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="<?= htmlspecialchars($telefono) ?>">
            </div>
            <div class="col-md-6">
                <label for="area" class="form-label">Área</label>
                <input type="text" name="area" id="area" class="form-control" value="<?= htmlspecialchars($area) ?>">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($email) ?>">
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success"><?= $id ? 'Actualizar' : 'Agregar' ?></button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
