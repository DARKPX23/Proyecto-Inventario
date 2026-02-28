function validarFormulario(){
    let nombre = document.forms["formProducto"]["nombre"].value;
    let precio = document.forms["formProducto"]["precio"].value;
    let stock = document.forms["formProducto"]["stock"].value;

    if(nombre == ""){
        alert("El nombre es obligatorio");
        return false;
    }

    if(precio <= 0){
        alert("El precio debe ser mayor a 0");
        return false;
    }

    if(stock < 0){
        alert("El stock no puede ser negativo");
        return false;
    }

    return true;
}