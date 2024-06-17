<?php
require '../../includes/conexionBD.php';

// Verifica que el IdCompra se recibió correctamente
if (isset($_POST['IdCompra'])) {
    $IdCompra = $conn->real_escape_string($_POST['IdCompra']);

    // Prepara la consulta SQL para obtener la compra específica
    $sql = "SELECT * FROM tblcompras WHERE IdCompra = '$IdCompra'";
    $result = $conn->query($sql);

    // Verifica si se encontraron resultados
    if ($result->num_rows > 0) {
        // Obtiene los datos de la compra
        $compra = $result->fetch_assoc();
        // Devuelve los datos en formato JSON
        echo json_encode($compra);
    } else {
        // Si no se encontró la compra, devuelve un mensaje de error
        echo json_encode(["error" => "No se encontró la compra con el IdCompra proporcionado: $IdCompra"]);
    }
} else {
    // Si no se recibió correctamente el IdCompra, devuelve un mensaje de error
    echo json_encode(["error" => "No se proporcionó el IdCompra correctamente"]);
}
?>
