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
</head>
<body>
    <h1><?= $id ? 'Editar' : 'Agregar' ?> Empleado</h1>
    <form method="post">
        <label>Nombre:
            <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>" required>
        </label><br>
        <label>Teléfono:
            <input type="text" name="telefono" value="<?= htmlspecialchars($telefono) ?>">
        </label><br>
        <label>Área:
            <input type="text" name="area" value="<?= htmlspecialchars($area) ?>">
        </label><br>
        <label>Email:
            <input type="email" name="email" value="<?= htmlspecialchars($email) ?>">
        </label><br>
        <button type="submit"><?= $id ? 'Actualizar' : 'Agregar' ?></button>
    </form>
</body>
</html>
