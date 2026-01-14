<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'tienda_tech';

$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Establecer charset
$conexion->set_charset('utf8mb4');
?>