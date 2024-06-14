<?php

require '../../includes/conexionBD.php';

// Obtener los datos del formulario
$NumeroCompra = $conn->real_escape_string($_POST['NumeroCompra']);
$IdProveedor = $conn->real_escape_string($_POST['proveedor']);
$IdProducto = $conn->real_escape_string($_POST['producto']);
$IdEmpleado = $conn->real_escape_string($_POST['Empleado']);
$CantidadComprada = $conn->real_escape_string($_POST['CantidadComprada']);
$PrecioUnidad = $conn->real_escape_string($_POST['PrecioUnidad']);
$PrecioTotal = $conn->real_escape_string($_POST['PrecioTotal']);
$FechaCompra = $conn->real_escape_string($_POST['FechaCompra']);
$Observacion = $conn->real_escape_string($_POST['Observacion']);

// Suponiendo que ya tienes las variables $CantidadComprada y $IdProducto

// Consulta para obtener la cantidad actual en stock del producto
$sqlStock = "SELECT CantidadStock FROM tblproductos WHERE IdProducto = '$IdProducto'";
$resultStock = $conn->query($sqlStock);

if ($resultStock->num_rows > 0) {
    $rowStock = $resultStock->fetch_assoc();
    $cantidadActual = $rowStock['CantidadStock'];
    
    // Calcular la nueva cantidad en stock sumando la cantidad comprada
    $nuevaCantidad = $cantidadActual + $CantidadComprada;

    // Actualizar la cantidad en stock en la tabla de productos
    $sqlUpdateStock = "UPDATE tblproductos SET CantidadStock = $nuevaCantidad WHERE IdProducto = '$IdProducto'";
    if ($conn->query($sqlUpdateStock)) {
        // Éxito al actualizar la cantidad en stock
    } else {
        // Error al actualizar la cantidad en stock
    }
} else {
    // No se encontró el producto
}

// Insertar los datos en la tabla de compras
$sql = "INSERT INTO tblcompras (NumeroCompra, IdProveedor, IdProducto, IdEmpleado, CantidadComprada, PrecioUnidad, PrecioTotal, FechaCompra, Observación) 
    VALUES ('$NumeroCompra', '$IdProveedor', '$IdProducto', '$IdEmpleado', '$CantidadComprada', '$PrecioUnidad', '$PrecioTotal', '$FechaCompra', '$Observacion')";

if ($conn->query($sql)) {
    $IdCompra = $conn->insert_id; // Asigna el insert_id después de la inserción
    header('Location: registrarProveedor.php');
} else {
    echo 'Error: ' . $conn->error;
}

header('Location: compras_registrar.php');

?>