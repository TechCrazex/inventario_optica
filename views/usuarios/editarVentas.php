<?php
// Conexión a la base de datos
require '../../includes/conexionBD.php';

$id = $conn->real_escape_string($_POST['IdVenta']);

$sqlEditar = "SELECT IdVenta, NumeroVenta, IdCliente, IdEmpleado, IdProducto, CantidadVendida, PrecioUnidad, PrecioTotal, FechaVenta, Observación, IdCategoria FROM tblventas WHERE IdVenta=$id LIMIT 1";
$resultado = $conn->query($sqlEditar);
$rows = $resultado->num_rows;

$ventas = [];

if ($rows > 0) {
    $ventas = $resultado->fetch_array();
}

echo json_encode($ventas, JSON_UNESCAPED_UNICODE);
?>