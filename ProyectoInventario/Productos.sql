CREATE DATABASE inventario_tienda;
USE inventario_tienda;

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    proveedor VARCHAR(100),
    codigo_barras VARCHAR(50),
    fecha_ingreso DATE,
    estado VARCHAR(20),
    peso DECIMAL(8,2)
);

INSERT INTO productos 
(nombre, categoria, descripcion, precio, stock, proveedor, codigo_barras, fecha_ingreso, estado, peso)
VALUES
('Laptop HP', 'Electrónica', 'Laptop 8GB RAM', 12000.00, 10, 'HP México', '123456789', '2026-01-01', 'Disponible', 2.5),
('Mouse Logitech', 'Accesorios', 'Mouse inalámbrico', 350.00, 50, 'Logitech', '987654321', '2026-01-02', 'Disponible', 0.2),
('Teclado Redragon', 'Accesorios', 'Teclado mecánico', 900.00, 20, 'Redragon', '456123789', '2026-01-03', 'Disponible', 0.8),
('Monitor Samsung', 'Electrónica', 'Monitor 24 pulgadas', 3500.00, 15, 'Samsung', '741258963', '2026-01-04', 'Disponible', 4.5),
('USB Kingston', 'Almacenamiento', 'USB 64GB', 150.00, 100, 'Kingston', '369258147', '2026-01-05', 'Disponible', 0.05);