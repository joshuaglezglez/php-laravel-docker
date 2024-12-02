<?php
include 'conexion.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $query = $link->prepare("DELETE FROM empleados WHERE id = :id");
    $query->execute(['id' => $id]);
}

header('Location: index.php');
exit;
?>
