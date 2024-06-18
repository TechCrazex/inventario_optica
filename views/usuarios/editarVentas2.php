<?php
require '../../includes/conexionBD.php';

// Verifica que el IdVenta se recibió correctamente
if (isset($_POST['IdVenta'])) {
    $IdVenta = $conn->real_escape_string($_POST['IdVenta']);

    // Prepara la consulta SQL para obtener la venta específica
    $sql = "SELECT * FROM tblventas WHERE IdVenta = '$IdVenta'";
    $result = $conn->query($sql);

    // Verifica si se encontraron resultados
    if ($result->num_rows > 0) {
        // Obtiene los datos de la venta
        $venta = $result->fetch_assoc();
        // Devuelve los datos en formato JSON
        echo json_encode($venta);
    } else {
        // Si no se encontró la venta, devuelve un mensaje de error
        echo json_encode(["error" => "No se encontró la venta con el IdVenta proporcionado: $IdVenta"]);
    }
} else {
    // Si no se recibió correctamente el IdVenta, devuelve un mensaje de error
    echo json_encode(["error" => "No se proporcionó el IdVenta correctamente"]);
}
?>
