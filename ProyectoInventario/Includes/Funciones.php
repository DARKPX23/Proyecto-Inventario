<?php
require 'database.php';

function obtenerProductos(){
    global $conexion;
    $resultado = $conexion->query("SELECT * FROM productos");
    return $resultado;
}

function insertarProducto($datos){
    global $conexion;

    // Validar nombre y categoría (solo letras)
    if(!preg_match("/^[a-zA-ZÁÉÍÓÚáéíóúñÑ\s]+$/", $datos['nombre'])){
        return false;
    }

    if(!preg_match("/^[a-zA-ZÁÉÍÓÚáéíóúñÑ\s]+$/", $datos['categoria'])){
        return false;
    }

    // 🔥 CORRECCIÓN AQUÍ
    $peso = ($datos['peso'] === "") ? 0 : $datos['peso'];

    // Validar negativos
    if($datos['precio'] < 0 || $datos['stock'] < 0 || $peso < 0){
        return false;
    }

    $stmt = $conexion->prepare("INSERT INTO productos 
    (nombre,categoria,descripcion,precio,stock,proveedor,codigo_barras,fecha_ingreso,estado,peso)
    VALUES (?,?,?,?,?,?,?,?,?,?)");

    $stmt->bind_param("sssdiisssd",
        $datos['nombre'],
        $datos['categoria'],
        $datos['descripcion'],
        $datos['precio'],
        $datos['stock'],
        $datos['proveedor'],
        $datos['codigo_barras'],
        $datos['fecha_ingreso'],
        $datos['estado'],
        $peso // 🔥 aquí también cambiado
    );

    return $stmt->execute();
}

function eliminarProducto($id){
    global $conexion;
    $conexion->query("DELETE FROM productos WHERE id=$id");
}

function obtenerProducto($id){
    global $conexion;
    return $conexion->query("SELECT * FROM productos WHERE id=$id");
}

function actualizarProducto($datos){
    global $conexion;

    if(!preg_match("/^[a-zA-ZÁÉÍÓÚáéíóúñÑ\s]+$/", $datos['nombre'])){
        return false;
    }

    if(!preg_match("/^[a-zA-ZÁÉÍÓÚáéíóúñÑ\s]+$/", $datos['categoria'])){
        return false;
    }

    // 🔥 CORRECCIÓN AQUÍ
    $peso = ($datos['peso'] === "") ? 0 : $datos['peso'];

    if($datos['precio'] < 0 || $datos['stock'] < 0 || $peso < 0){
        return false;
    }

    $stmt = $conexion->prepare("UPDATE productos SET 
        nombre=?, categoria=?, descripcion=?, precio=?, stock=?, 
        proveedor=?, codigo_barras=?, fecha_ingreso=?, estado=?, peso=?
        WHERE id=?");

    $stmt->bind_param("sssdiisssdi",
        $datos['nombre'],
        $datos['categoria'],
        $datos['descripcion'],
        $datos['precio'],
        $datos['stock'],
        $datos['proveedor'],
        $datos['codigo_barras'],
        $datos['fecha_ingreso'],
        $datos['estado'],
        $peso, // 🔥 aquí también cambiado
        $datos['id']
    );

    return $stmt->execute();
}
?>