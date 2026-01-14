<?php
$host = 'sql207.infinityfree.com';
$user = 'if0_40817454';
$pass = 'Iy59XK87XpG9Id';
$db = 'if0_40817454_tienda_tech1';

$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Establecer charset
$conexion->set_charset('utf8mb4');
?>