<?php
require '../../includes/conexionBD.php';

$IdCliente = $conn->real_escape_string($_POST['cliente']);
$IdEmpleado = $conn->real_escape_string($_POST['empleado']);
$IdProducto = $conn->real_escape_string($_POST['producto']);
$CantidadVendida = $conn->real_escape_string($_POST['CantidadVendida']);
$PrecioUnidad = $conn->real_escape_string($_POST['PrecioUnidad']);
$PrecioTotal = $conn->real_escape_string($_POST['PrecioTotal']);
$FechaVenta = $conn->real_escape_string($_POST['FechaVenta']);
$Observacion = $conn->real_escape_string($_POST['Observacion']);
$Categoria = $conn->real_escape_string($_POST['Categoria']);

// Consulta para obtener empleados con IdRol igual a 2
$sqlEmpleados = "SELECT IdEmpleado FROM tblempleados WHERE IdRol = 2";
$resultEmpleados = $conn->query($sqlEmpleados);

if ($resultEmpleados->num_rows > 0) {
    $empleadosPermitidos = [];
    while ($row = $resultEmpleados->fetch_assoc()) {
        $empleadosPermitidos[] = $row['IdEmpleado'];
    }

    // Verificar si el empleado seleccionado está en la lista permitida
    if (!in_array($IdEmpleado, $empleadosPermitidos)) {
        echo "El empleado seleccionado no tiene el rol permitido para registrar ventas.";
        exit;
    }

    // Insertar los datos en la tabla de ventas
    $sql = "INSERT INTO tblventas (IdCliente, IdEmpleado, IdProducto, CantidadVendida, PrecioUnidad, PrecioTotal, FechaVenta, Observación, IdCategoria) 
            VALUES ('$IdCliente', '$IdEmpleado', '$IdProducto', '$CantidadVendida', '$PrecioUnidad', '$PrecioTotal', '$FechaVenta', '$Observacion', '$Categoria')";

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
                header('Location: venta_registrar.php');
                exit;
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

} else {
    echo 'No hay empleados con el rol permitido para registrar ventas.';
}

header('Location: venta_registrar.php');
?>
