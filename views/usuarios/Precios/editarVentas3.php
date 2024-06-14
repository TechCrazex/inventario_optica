<?php
// Incluye la conexión a la base de datos
require_once '../../../includes/conexionBD.php';

// Verifica si se recibió el IdProducto
if (isset($_POST['IdProducto'])) {
    $IdProducto = $_POST['IdProducto'];

    // Consulta el precio de venta del producto
    $sql = "SELECT PrecioVenta FROM tblproductos WHERE IdProducto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $IdProducto);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica si se encontró el precio de venta
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $precioVenta = $row['PrecioVenta'];
        
        // Devuelve el precio de venta en formato JSON
        echo json_encode(['PrecioVenta' => $precioVenta]);
    } 
}
?>
