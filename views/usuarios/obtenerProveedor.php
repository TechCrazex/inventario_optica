<?php
// Conectar a la base de datos
require '../../includes/conexionBD.php';

// Verificar si 'producto' está definido en $_POST
if (isset($_POST['producto'])) {
    // Obtener el producto enviado por la solicitud POST
    $NombreProducto = $conn->real_escape_string($_POST['producto']);

    // Consulta para obtener el proveedor asociado al producto
    $sql = "SELECT IdProveedor, NombreProveedor FROM tblproveedores WHERE ProductoVender = '$NombreProducto'";

    $resultado = $conn->query($sql);

    $respuesta = array();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $respuesta['IdProveedor'] = $row['IdProveedor'];
        $respuesta['NombreProveedor'] = $row['NombreProveedor'];
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
} else {
    // Si 'producto' no está definido, enviar un mensaje de error
    echo json_encode(array('error' => 'Producto no está definido en la solicitud POST'), JSON_UNESCAPED_UNICODE);
}
?>