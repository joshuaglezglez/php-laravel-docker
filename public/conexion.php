<?php
$host = 'localhost';
$port = '5432';
$dbname = 'empresa';
$user = 'postgres';
$password = 'tu_contraseña';

try {
    $link = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
?>