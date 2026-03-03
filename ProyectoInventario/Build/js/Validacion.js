function validarFormulario() {

    const nombre = document.querySelector('input[name="nombre"]').value.trim();
    const categoria = document.querySelector('input[name="categoria"]').value.trim();
    const precio = parseFloat(document.querySelector('input[name="precio"]').value);
    const stock = parseInt(document.querySelector('input[name="stock"]').value);
    const pesoInput = document.querySelector('input[name="peso"]').value;

    const soloLetras = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;

    // Validar nombre
    if (!soloLetras.test(nombre)) {
        alert("El nombre solo debe contener letras.");
        return false;
    }

    // Validar categoría
    if (!soloLetras.test(categoria)) {
        alert("La categoría solo debe contener letras.");
        return false;
    }

    // Validar precio
    if (precio < 0 || isNaN(precio)) {
        alert("El precio no puede ser negativo.");
        return false;
    }

    // Validar stock
    if (stock < 0 || isNaN(stock)) {
        alert("El stock no puede ser negativo.");
        return false;
    }

    // Validar peso si está lleno
    if (pesoInput !== "") {
        const peso = parseFloat(pesoInput);
        if (peso < 0 || isNaN(peso)) {
            alert("El peso no puede ser negativo.");
            return false;
        }
    }

    return true;
}