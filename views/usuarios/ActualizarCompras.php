<?php

require '../../includes/conexionBD.php';

$IdCompra = $conn->real_escape_string($_POST['IdCompra']);
$IdProveedor = $conn->real_escape_string($_POST['proveedor']);
$IdProducto = $conn->real_escape_string($_POST['producto']);
$IdEmpleado = $conn->real_escape_string($_POST['Empleado']);
$CantidadComprada = $conn->real_escape_string($_POST['CantidadComprada']);
$PrecioUnidad = $conn->real_escape_string($_POST['PrecioUnidad']);
$PrecioTotal = $conn->real_escape_string($_POST['PrecioTotal']);
$FechaCompra = $conn->real_escape_string($_POST['FechaCompra']);
$Observacion = $conn->real_escape_string($_POST['Observacion']);

$PrecioTotal = $CantidadComprada * $PrecioUnidad;

$sql = "UPDATE tblcompras SET
            IdProveedor = '$IdProveedor',
            IdProducto = '$IdProducto',
            IdEmpleado = '$IdEmpleado',
            CantidadComprada = '$CantidadComprada',
            PrecioUnidad = '$PrecioUnidad',
            PrecioTotal = '$PrecioTotal',
            FechaCompra = '$FechaCompra',
            Observación = '$Observacion'
        WHERE IdCompra = '$IdCompra'";

error_log("Consulta SQL: " . $sql);

if ($conn->query($sql)) {

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
}// Consulta para obtener la cantidad actual en stock del producto
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
}

header('Location: compras_registrar.php');
?>
