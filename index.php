<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Tienda mundo virtual</title>
    <link rel='stylesheet' href='assets/css/estilos.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <h1><i class="fas fa-laptop-code"></i> Tienda de Accesorios Tecnológicos</h1>
        <p>Electrónica • Arduino • Computación</p>
        <div class="menu">
            <a class='btn' href='#'><i class="fas fa-home"></i> Inicio</a>
            <a class='btn' href='productos/agregar.php'><i class="fas fa-plus"></i> Agregar Producto</a>
            <a class='btn' href='productos/inventario_diario.php'><i class="fas fa-boxes"></i> Inventario</a>
            <a class='btn' href='pedidos/nuevo.php'><i class="fas fa-shopping-cart"></i> Nuevo Pedido</a>
        </div>
    </header>

    <div class="container">
        <div class="dashboard">
            <div class="card">
                <h2><i class="fas fa-chart-line"></i> Resumen</h2>
                <?php
                include('config/conexion.php');
                
                // Total productos
                $result = $conexion->query("SELECT COUNT(*) as total FROM productos");
                $totalProductos = $result->fetch_assoc()['total'];
                
                // Total stock
                $result = $conexion->query("SELECT SUM(stock) as total_stock FROM productos");
                $totalStock = $result->fetch_assoc()['total_stock'];
                
                // Productos con stock bajo
                $result = $conexion->query("SELECT COUNT(*) as bajos FROM productos WHERE stock < 10");
                $stockBajo = $result->fetch_assoc()['bajos'];
                
                // Total pedidos pendientes
                $result = $conexion->query("SELECT COUNT(*) as pendientes FROM pedidos WHERE estado = 'PENDIENTE'");
                $pendientes = $result->fetch_assoc()['pendientes'];
                
                $conexion->close();
                ?>
                <p><strong>Total Productos:</strong> <?php echo $totalProductos; ?></p>
                <p><strong>Stock Total:</strong> <?php echo $totalStock; ?> unidades</p>
                <p><strong>Productos con Stock Bajo:</strong> <span class="stock-low"><?php echo $stockBajo; ?></span></p>
                <p><strong>Pedidos Pendientes:</strong> <?php echo $pendientes; ?></p>
            </div>

            <div class="card">
                <h2><i class="fas fa-box"></i> Productos Recientes</h2>
                <?php
                include('config/conexion.php');
                $result = $conexion->query("SELECT * FROM productos ORDER BY id DESC LIMIT 5");
                
                if ($result->num_rows > 0) {
                    echo "<ul>";
                    while($row = $result->fetch_assoc()) {
                        echo "<li>{$row['nombre']} - Stock: {$row['stock']}</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No hay productos registrados.</p>";
                }
                $conexion->close();
                ?>
                <a href='productos/inventario_diario.php' class='btn' style='margin-top: 15px;'>
                    <i class="fas fa-eye"></i> Ver Todo el Inventario
                </a>
            </div>
        </div>

        <div class="card">
            <h2><i class="fas fa-history"></i> Actividad Reciente</h2>
            <?php
            include('config/conexion.php');
            
            // Últimos pedidos
            echo "<h3>Últimos Pedidos:</h3>";
            $result = $conexion->query("SELECT * FROM pedidos ORDER BY fecha DESC LIMIT 5");
            
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Código</th><th>Cliente</th><th>Estado</th><th>Fecha</th></tr>";
                while($row = $result->fetch_assoc()) {
                    $estadoColor = $row['estado'] == 'COMPLETADO' ? 'color: #10b981;' : 'color: #f59e0b;';
                    echo "<tr>";
                    echo "<td>{$row['codigo_pedido']}</td>";
                    echo "<td>{$row['cliente']}</td>";
                    echo "<td style='{$estadoColor}'>{$row['estado']}</td>";
                    echo "<td>{$row['fecha']}</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No hay pedidos registrados.</p>";
            }
            
            $conexion->close();
            ?>
        </div>
    </div>
</body>
</html>