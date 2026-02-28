<?php
require 'database.php';

function obtenerProductos(){
    global $conexion;
    $resultado = $conexion->query("SELECT * FROM productos");
    return $resultado;
}

function insertarProducto($datos){
    global $conexion;
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
        $datos['peso']
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
        $datos['peso'],
        $datos['id']
    );

    return $stmt->execute();
}
?>