<?php
// Incluye la conexión a la base de datos
require_once '../../../includes/conexionBD.php';

// Verifica si se recibió el IdProducto
if (isset($_POST['IdProducto'])) {
    $IdProducto = $_POST['IdProducto'];

    // Consulta el precio de Compra del producto
    $sql = "SELECT PrecioCompra FROM tblproductos WHERE IdProducto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $IdProducto);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica si se encontró el precio de Compra
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $precioCompra = $row['PrecioCompra'];
        
        // Devuelve el precio de Compra en formato JSON
        echo json_encode(['PrecioCompra' => $precioCompra]);
    } 
}
?>