<?php

require '../../includes/conexionBD.php';

$NumeroVenta = $conn->real_escape_string($_POST['NumeroVenta']);
$IdCliente = $conn->real_escape_string($_POST['cliente']);
$IdEmpleado = $conn->real_escape_string($_POST['empleado']);
$IdProducto = $conn->real_escape_string($_POST['producto']);
$CantidadVendida = $conn->real_escape_string($_POST['CantidadVendida']);
$PrecioUnidad = $conn->real_escape_string($_POST['PrecioUnidad']);
$PrecioTotal = $conn->real_escape_string($_POST['PrecioTotal']);
$FechaVenta = $conn->real_escape_string($_POST['FechaVenta']);
$Observacion = $conn->real_escape_string($_POST['Observacion']);
$Categoria = $conn->real_escape_string($_POST['Categoria']);

// Insertar los datos en la tabla de ventas
$sql = "INSERT INTO tblventas (NumeroVenta, IdCliente, IdEmpleado, IdProducto, CantidadVendida, PrecioUnidad, PrecioTotal, FechaVenta, Observación, IdCategoria) 
    VALUES ('$NumeroVenta', '$IdCliente', '$IdEmpleado', '$IdProducto', '$CantidadVendida', '$PrecioUnidad', '$PrecioTotal', '$FechaVenta', '$Observacion', '$Categoria')";

if ($conn->query($sql)) {
    $IdVenta = $conn->insert_id;

    // Consulta para obtener la cantidad actual en stock del producto
    $sqlStock = "SELECT CantidadStock FROM tblproductos WHERE IdProducto = '$IdProducto'";
    $resultStock = $conn->query($sqlStock);

    if ($resultStock->num_rows > 0) {
        $rowStock = $resultStock->fetch_assoc();
        $cantidadActual = $rowStock['CantidadStock'];
        
        // Calcular la nueva cantidad en stock restando la cantidad vendida
        $nuevaCantidad = $cantidadActual - $CantidadVendida;

        // Actualizar la cantidad en stock en la tabla de productos
        $sqlUpdateStock = "UPDATE tblproductos SET CantidadStock = $nuevaCantidad WHERE IdProducto = '$IdProducto'";
        if ($conn->query($sqlUpdateStock)) {
            // Éxito al actualizar la cantidad en stock
            echo 'registrado';
        } else {
            // Error al actualizar la cantidad en stock
            echo 'Error al actualizar la cantidad en stock: ' . $conn->error;
        }
    } else {
        // No se encontró el producto
        echo 'No se encontró el producto.';
    }

} else {
    echo 'Error al insertar en la tabla de ventas: ' . $conn->error;
}

header('Location: venta_registrar.php');

?>