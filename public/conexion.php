<?php
$host = 'dpg-ct6ikr2lqhvc73ankh40-a';
$port = '5432';
$dbname = 'dic24udg';
$user = 'joshua';
$password = 'KYuEhu2rR28Bw7v1iMj9qlfoQ9Vl1Qly';

try {
    $link = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
?>