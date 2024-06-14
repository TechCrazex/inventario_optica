<?php
require '../../includes/conexionBD.php';
// Obtener el producto seleccionado
$productoo = $_GET['Producto'];

// Consulta para obtener el proveedor asociado al producto
$sqll = "SELECT IdProveedor, NombreProveedor FROM tblproveedores WHERE ProductoVender = '$productoo' LIMIT 1";

// Ejecutar la consulta
$resultt = $conn->query($sqll);

if ($resultt->num_rows > 0) {
    // Obtener el resultado
    $roww = $resultt->fetch_assoc();
    // Devolver el resultado como JSON
    echo json_encode($roww);
} else {
    echo json_encode(['error' => 'Proveedor no encontrado']);
}

?>