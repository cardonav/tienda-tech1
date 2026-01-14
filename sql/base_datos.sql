CREATE DATABASE IF NOT EXISTS tienda_tech;
USE tienda_tech;

CREATE TABLE IF NOT EXISTS productos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_producto VARCHAR(20) UNIQUE,
    nombre VARCHAR(100),
    precio DECIMAL(10,2),
    stock INT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS pedidos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_pedido VARCHAR(20) UNIQUE,
    cliente VARCHAR(100),
    estado VARCHAR(20) DEFAULT 'PENDIENTE',
    fecha DATE,
    total DECIMAL(10,2) DEFAULT 0
);

-- Datos de ejemplo
INSERT INTO productos (codigo_producto, nombre, precio, stock) VALUES
('PRD1001', 'Arduino UNO R3', 25.99, 15),
('PRD1002', 'Raspberry Pi 4 4GB', 75.50, 8),
('PRD1003', 'Sensor DHT22', 12.75, 25),
('PRD1004', 'Cable HDMI 2.0', 18.99, 30),
('PRD1005', 'Teclado Mecánico RGB', 89.99, 5),
('PRD1006', 'Mouse Inalámbrico', 24.50, 12),
('PRD1007', 'Monitor 24" Full HD', 189.99, 3),
('PRD1008', 'Webcam 1080p', 45.75, 18),
('PRD1009', 'Micrófono USB', 65.25, 7),
('PRD1010', 'Placa Protoboard', 8.99, 50);

INSERT INTO pedidos (codigo_pedido, cliente, estado, fecha) VALUES
('PED2024001', 'Juan Pérez', 'COMPLETADO', '2024-01-15'),
('PED2024002', 'María García', 'PENDIENTE', '2024-01-16'),
('PED2024003', 'Tech Solutions SAC', 'COMPLETADO', '2024-01-14'),
('PED2024004', 'Carlos López', 'PENDIENTE', '2024-01-17');