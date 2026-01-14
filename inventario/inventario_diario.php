<?php
include('../config/conexion.php');

// Procesar búsqueda si existe
$busqueda = '';
$where = '';
if(isset($_GET['buscar']) && !empty($_GET['buscar'])){
    $busqueda = $conexion->real_escape_string($_GET['buscar']);
    $where = "WHERE nombre LIKE '%$busqueda%' OR codigo_producto LIKE '%$busqueda%'";
}
?>

<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Inventario Diario</title>
    <link rel='stylesheet' href='../assets/css/estilos.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <h1><i class="fas fa-clipboard-list"></i> Inventario Diario</h1>
        <div class="menu">
            <a class='btn' href='../index.php'><i class="fas fa-home"></i> Inicio</a>
            <a class='btn' href='agregar.php'><i class="fas fa-plus"></i> Agregar Producto</a>
        </div>
    </header>
    
    <div class="container">
        <div class="card">
            <h2><i class="fas fa-search"></i> Buscar Productos</h2>
            <form method='GET'>
                <input name='buscar' placeholder='Buscar por nombre o código...' value='<?php echo $busqueda; ?>'>
                <button type='submit'><i class="fas fa-search"></i> Buscar</button>
                <?php if($busqueda): ?>
                    <a href='inventario_diario.php' class='btn'>Limpiar Búsqueda</a>
                <?php endif; ?>
            </form>
        </div>
        
        <div class="card">
            <h2><i class="fas fa-boxes"></i> Lista de Productos</h2>
            <?php
            $result = $conexion->query("SELECT * FROM productos $where ORDER BY nombre");
            
            if ($result->num_rows > 0) {
                // Total valor inventario
                $totalValor = 0;
                $productos = [];
                while($row = $result->fetch_assoc()) {
                    $productos[] = $row;
                    $totalValor += $row['precio'] * $row['stock'];
                }
                
                echo "<p><strong>Total de productos:</strong> " . count($productos) . "</p>";
                echo "<p><strong>Valor total del inventario:</strong> $" . number_format($totalValor, 2) . "</p>";
                
                echo "<table>";
                echo "<tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Valor Total</th>
                        <th>Estado</th>
                      </tr>";
                
                foreach($productos as $producto) {
                    $valorTotal = $producto['precio'] * $producto['stock'];
                    $estado = '';
                    $stockClass = '';
                    
                    if($producto['stock'] == 0) {
                        $estado = '<span style="color: #ef4444;">Agotado</span>';
                        $stockClass = 'stock-low';
                    } elseif($producto['stock'] < 10) {
                        $estado = '<span style="color: #f59e0b;">Bajo</span>';
                        $stockClass = 'stock-low';
                    } else {
                        $estado = '<span style="color: #10b981;">Disponible</span>';
                    }
                    
                    echo "<tr>";
                    echo "<td><strong>{$producto['codigo_producto']}</strong></td>";
                    echo "<td>{$producto['nombre']}</td>";
                    echo "<td>$" . number_format($producto['precio'], 2) . "</td>";
                    echo "<td class='{$stockClass}'>{$producto['stock']}</td>";
                    echo "<td>$" . number_format($valorTotal, 2) . "</td>";
                    echo "<td>{$estado}</td>";
                    echo "</tr>"; 
                }
                
                echo "</table>";
            } else {
                echo "<p>No hay productos en el inventario.</p>";
            }
            
            $conexion->close();
            ?>
            
            <div style="margin-top: 20px;">
                <a href='agregar.php' class='btn'><i class="fas fa-plus"></i> Agregar Nuevo Producto</a>
                <button onclick="window.print()" class='btn'><i class="fas fa-print"></i> Imprimir Inventario</button>
            </div>
        </div>
    </div>
</body>
</html>