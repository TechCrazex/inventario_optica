<?php

require '../../includes/conexionBD.php';

$NombreProducto = $conn->real_escape_string($_POST['NombreProducto']);
$Descripcion = $conn->real_escape_string($_POST['Descripcion']);
$IdProveedor = $conn->real_escape_string($_POST['IdProveedor']);
$CantidadStock = $conn->real_escape_string($_POST['CantidadStock']);
$IdCategoria = $conn->real_escape_string($_POST['IdCategoria']);
$IdMarca = $conn->real_escape_string($_POST['IdMarca']);
$PrecioCompra = $conn->real_escape_string($_POST['PrecioCompra']);
$PrecioVenta = $conn->real_escape_string($_POST['PrecioVenta']);
$IdMaterial = $conn->real_escape_string($_POST['IdMaterial']);

$sql = "INSERT INTO tblproductos (NombreProducto, Descripcion, IdProveedor, CantidadStock, IdCategoria, IdMarca, PrecioCompra, PrecioVenta, IdMaterial) 
    VALUES ('$NombreProducto', '$Descripcion', '$IdProveedor', '$CantidadStock', '$IdCategoria', '$IdMarca', '$PrecioCompra', '$PrecioVenta', '$IdMaterial')";

if ($conn->query($sql)) {
    $IdProducto = $conn->insert_id;
    echo 'registrado';
} else {
    echo 'Error: ' . $conn->error;
}

header('Location: producto_registrar2.php');
?>


<script>
    // Obtener referencias a los campos de cantidad vendida y precio unitario
    var inputCantidadVendida = document.getElementById('CantidadVendida');
    var inputPrecioUnidad = document.getElementById('PrecioUnidad');

    // Obtener referencia al campo de precio total
    var inputPrecioTotal = document.getElementById('PrecioTotal');

    // Escuchar eventos de cambio en los campos de cantidad vendida y precio unitario
    inputCantidadVendida.addEventListener('input', calcularPrecioTotal);
    inputPrecioUnidad.addEventListener('input', calcularPrecioTotal);

    // Función para calcular el precio total
    function calcularPrecioTotal() {
        // Obtener los valores de cantidad vendida y precio unitario
        var cantidadVendida = parseFloat(inputCantidadVendida.value);
        var precioUnidad = parseFloat(inputPrecioUnidad.value);

        // Calcular el precio total multiplicando cantidad vendida por precio unitario
        var precioTotal = cantidadVendida * precioUnidad;

        // Redondear el precio unitario a dos decimales y convertirlo a cadena
        var precioUnidadString = precioUnidad.toFixed(2);

        // Actualizar el valor del campo de precio unitario
        inputPrecioUnidad.value = precioUnidadString;

        // Actualizar el valor del campo de precio total
        inputPrecioTotal.value = precioTotal.toFixed(2); // Redondear a 2 decimales
        
        // Establecer la posición del cursor al principio del campo de precio unitario
        inputPrecioUnidad.setSelectionRange(0, 0);
    }
</script>