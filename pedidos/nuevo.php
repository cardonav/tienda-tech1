<?php
include('../config/conexion.php');

if($_POST){
    $codigo='PED'.rand(1000,9999);
    $cliente = $conexion->real_escape_string($_POST['cliente']);
    $conexion->query("INSERT INTO pedidos VALUES(NULL,'$codigo','$cliente','PENDIENTE',CURDATE(),0)");
    $mensaje = '<div class="alert">Pedido creado exitosamente! Código: ' . $codigo . '</div>';
}
?>

<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Nuevo Pedido</title>
    <link rel='stylesheet' href='../assets/css/estilos.css'>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Nuevo Pedido</h2>
            <?php if(isset($mensaje)) echo $mensaje; ?>
            <form method='POST'>
                <input name='cliente' placeholder='Nombre del Cliente' required>
                <button type='submit'>Crear pedido</button>
            </form>
            <a href='../index.php' class='btn'>Volver al Inicio</a>
        </div>
    </div>
</body>
</html>