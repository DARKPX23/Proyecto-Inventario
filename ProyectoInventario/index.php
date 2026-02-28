<?php
require 'includes/database.php';
require 'includes/funciones.php';

$productos = obtenerProductos();

/* =======================
   ESTADÍSTICAS
======================= */

$total = $productos->num_rows;

$stock_bajo = 0;
$total_valor = 0;

$productos->data_seek(0);
while($p = $productos->fetch_assoc()){
    if($p['stock'] < 5){
        $stock_bajo++;
    }
    $total_valor += ($p['precio'] * $p['stock']);
}
$productos->data_seek(0);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Dashboard Inventario</title>
<link rel="stylesheet" href="build/css/style.css?v=10">

<script>
function buscarProducto(){
    let input = document.getElementById("buscador").value.toLowerCase();
    let filas = document.querySelectorAll("tbody tr");

    filas.forEach(fila=>{
        let texto = fila.innerText.toLowerCase();
        fila.style.display = texto.includes(input) ? "" : "none";
    });
}
</script>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">Sistema de Inventario</div>
    <div class="nav-links">
        <a href="index.php" class="active">Inventario</a>
        <a href="estadisticas.php">Estadísticas</a>
    </div>
</div>

<div class="container">

    <!-- TARJETAS SUPERIORES -->
    <div class="cards">
        <div class="card">
            <h3>Total Productos</h3>
            <p><?php echo $total; ?></p>
        </div>

        <div class="card">
            <h3>Stock Bajo</h3>
            <p><?php echo $stock_bajo; ?></p>
        </div>

        <div class="card">
            <h3>Valor Inventario</h3>
            <p>$<?php echo number_format($total_valor,2); ?></p>
        </div>
    </div>

    <!-- BOTÓN -->
    <a href="crear.php" class="btn btn-primary">+ Agregar Producto</a>

    <!-- BUSCADOR -->
    <div class="search">
        <input type="text" id="buscador" onkeyup="buscarProducto()" placeholder="Buscar producto...">
    </div>

    <!-- TABLA -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php while($producto = $productos->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $producto['id']; ?></td>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo $producto['categoria']; ?></td>
                    <td>$<?php echo number_format($producto['precio'],2); ?></td>
                    <td class="<?php echo ($producto['stock'] < 5) ? 'stock-bajo' : ''; ?>">
                        <?php echo $producto['stock']; ?>
                    </td>
                    <td>
                        <a href="editar.php?id=<?php echo $producto['id']; ?>" class="btn btn-edit">Editar</a>
                        <a href="eliminar.php?id=<?php echo $producto['id']; ?>" 
                           class="btn btn-delete"
                           onclick="return confirm('¿Eliminar producto?');">
                           Eliminar
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>