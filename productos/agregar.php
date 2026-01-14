<?php
include('../config/conexion.php');

$mensaje = '';
if($_POST){
    $codigo = 'PRD' . rand(1000, 9999);
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $precio = $conexion->real_escape_string($_POST['precio']);
    $stock = $conexion->real_escape_string($_POST['stock']);
    
    $sql = "INSERT INTO productos (codigo_producto, nombre, precio, stock) 
            VALUES ('$codigo', '$nombre', '$precio', '$stock')";
    
    if($conexion->query($sql)){
        $mensaje = '<div class="alert">Producto agregado correctamente! Código: ' . $codigo . '</div>';
    } else {
        $mensaje = '<div style="background: #ef4444; color: white; padding: 15px; border-radius: 8px;">Error al agregar producto</div>';
    }
}
?>

<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Agregar Producto</title>
    <link rel='stylesheet' href='../assets/css/estilos.css'>
</head>
<body>
    <header>
        <h1><i class="fas fa-plus-circle"></i> Agregar Nuevo Producto</h1>
        <div class="menu">
            <a class='btn' href='../index.php'><i class="fas fa-home"></i> Inicio</a>
            <a class='btn' href='inventario_diario.php'><i class="fas fa-boxes"></i> Ver Inventario</a>
        </div>
    </header>
    
    <div class="container">
        <?php echo $mensaje; ?>
        
        <div class="card">
            <h2><i class="fas fa-edit"></i> Formulario de Producto</h2>
            <form method='POST'>
                <input name='nombre' placeholder='Nombre del Producto' required>
                <input name='precio' placeholder='Precio' type='number' step='0.01' required>
                <input name='stock' placeholder='Stock' type='number' required>
                <button type='submit'><i class="fas fa-save"></i> Guardar Producto</button>
            </form>
        </div>
        
        <div class="card">
            <h2><i class="fas fa-info-circle"></i> Instrucciones</h2>
            <p>1. Completa todos los campos del formulario.</p>
            <p>2. El código del producto se generará automáticamente.</p>
            <p>3. Haz clic en "Guardar Producto" para agregarlo al sistema.</p>
            <p>4. Puedes ver el inventario completo en el enlace superior.</p>
        </div>
    </div>
</body>
</html>