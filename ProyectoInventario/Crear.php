<?php
require 'includes/funciones.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    insertarProducto($_POST);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="build/css/style.css">
    <script src="build/js/validations.js?v=2"></script>
</head>
<body>

<div class="container">
    <h2>➕ Agregar Producto</h2>

    <form method="POST" name="formProducto" onsubmit="return validarFormulario();">

        <input type="text" name="nombre"
       placeholder="Nombre del producto"
       pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
       title="Solo se permiten letras"
       required>
        <input type="text" name="categoria" placeholder="Categoría" required>
        <textarea name="descripcion" placeholder="Descripción"></textarea>
        <input type="number" step="0.01" min="0" name="precio" placeholder="Precio" required>
        <input type="number" min="0" name="stock" placeholder="Stock" required>
        <input type="text" name="proveedor" placeholder="Proveedor">
        <input type="text" name="codigo_barras" placeholder="Código de barras">
        <input type="date" name="fecha_ingreso">
        <input type="text" name="estado" placeholder="Estado">
        <input type="number" step="0.01" min="0" name="peso" placeholder="Peso (kg)">

        <button type="submit" class="btn btn-primary">Guardar Producto</button>
        <a href="index.php" class="btn btn-delete">Cancelar</a>

    </form>
</div>

</body>
</html>