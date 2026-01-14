<?php
$host = "sql202.infinityfree.com";
$user = "if0_40907242";
$pass = "qIAE3ZMMgjNEVb";
$db = "if0_40907242_tiendatech1";

$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Establecer charset
$conexion->set_charset('utf8mb4');
?>