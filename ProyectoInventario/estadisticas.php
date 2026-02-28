<?php
require 'includes/database.php';

/* =======================
   DATOS PARA GRÁFICAS
======================= */

// Productos por categoría
$consulta1 = $conexion->query("SELECT categoria, COUNT(*) as total FROM productos GROUP BY categoria");
$categorias = [];
$totales_categoria = [];
while($row = $consulta1->fetch_assoc()){
    $categorias[] = $row['categoria'];
    $totales_categoria[] = $row['total'];
}

// Valor por categoría
$consulta2 = $conexion->query("SELECT categoria, SUM(precio * stock) as valor FROM productos GROUP BY categoria");
$categorias_valor = [];
$valores_categoria = [];
while($row = $consulta2->fetch_assoc()){
    $categorias_valor[] = $row['categoria'];
    $valores_categoria[] = $row['valor'];
}

// Stock por producto
$consulta3 = $conexion->query("SELECT nombre, stock FROM productos");
$nombres_productos = [];
$stocks_productos = [];
while($row = $consulta3->fetch_assoc()){
    $nombres_productos[] = $row['nombre'];
    $stocks_productos[] = $row['stock'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Estadísticas</title>
<link rel="stylesheet" href="build/css/style.css?v=7">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

<div class="navbar">
    📦 Sistema de Inventario - Tienda
    <div class="nav-links">
        <a href="index.php">Inventario</a>
        <a href="estadisticas.php">Estadísticas</a>
    </div>
</div>

<div class="container">

<h2 class="titulo-graficas">📊 Panel de Estadísticas</h2>

<div class="graficas-grid">

    <div class="grafica-card">
        <h4>Productos por Categoría</h4>
        <canvas id="graficaCategorias"></canvas>
    </div>

    <div class="grafica-card">
        <h4>Valor por Categoría</h4>
        <canvas id="graficaValor"></canvas>
    </div>

    <div class="grafica-card">
        <h4>Stock por Producto</h4>
        <canvas id="graficaStock"></canvas>
    </div>

</div>

</div>

<script>
new Chart(document.getElementById('graficaCategorias'), {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($categorias); ?>,
        datasets: [{
            label: 'Productos',
            data: <?php echo json_encode($totales_categoria); ?>
        }]
    }
});

new Chart(document.getElementById('graficaValor'), {
    type: 'pie',
    data: {
        labels: <?php echo json_encode($categorias_valor); ?>,
        datasets: [{
            data: <?php echo json_encode($valores_categoria); ?>
        }]
    }
});

new Chart(document.getElementById('graficaStock'), {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($nombres_productos); ?>,
        datasets: [{
            label: 'Stock',
            data: <?php echo json_encode($stocks_productos); ?>
        }]
    },
    options: { indexAxis: 'y' }
});
</script>

</body>
</html>