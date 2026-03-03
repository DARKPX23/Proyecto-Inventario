<?php
require 'includes/funciones.php';

if(!isset($_GET['id'])){
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

$resultado = obtenerProducto($id);

if($resultado->num_rows == 0){
    header("Location: index.php");
    exit;
}

$producto = $resultado->fetch_assoc();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_POST['id'] = $id;

    if(actualizarProducto($_POST)){
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Error al actualizar');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="build/css/style.css">
    <script src="build/js/validations.js"></script>
</head>
<body>

<div class="container">
    <h2>✏ Editar Producto</h2>

    <form method="POST" name="formProducto" onsubmit="return validarFormulario();">

        <input type="text" name="nombre"
       placeholder="Nombre del producto"
       pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
       title="Solo se permiten letras"
       required>
        <input type="text" name="categoria" value="<?php echo $producto['categoria']; ?>" required>
        <textarea name="descripcion"><?php echo $producto['descripcion']; ?></textarea>
        <input type="number" step="0.01" min="0" name="precio" value="<?php echo $producto['precio']; ?>" required>
        <input type="number" min="0" name="stock" value="<?php echo $producto['stock']; ?>" required>
        <input type="text" name="proveedor" value="<?php echo $producto['proveedor']; ?>">
        <input type="text" name="codigo_barras" value="<?php echo $producto['codigo_barras']; ?>">
        <input type="date" name="fecha_ingreso" value="<?php echo $producto['fecha_ingreso']; ?>">
        <input type="text" name="estado" value="<?php echo $producto['estado']; ?>">
        <input type="number" step="0.01" min="0" name="peso" value="<?php echo $producto['peso']; ?>">

        <button type="submit" class="btn btn-edit">Actualizar Producto</button>
        <a href="index.php" class="btn btn-delete">Cancelar</a>

    </form>
</div>

</body>
</html>