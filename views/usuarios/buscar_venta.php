<?php
// buscar_venta.php

require_once '../../includes/conexionBD.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];
    // Consulta SQL para buscar la venta correspondiente al término de búsqueda
    $sql = "SELECT v.IdVenta, c.Nombres, c.Apellidos, p.NombreProducto, v.CantidadVendida, v.PrecioUnidad, v.PrecioTotal, v.FechaVenta, v.Observación, cp.Categoria 
            FROM tblventas v 
            JOIN tblclientes c ON v.IdCliente = c.IdCliente 
            JOIN tblproductos p ON v.IdProducto = p.IdProducto
            JOIN tblcategoriasproductos cp ON v.IdCategoria = cp.IdCategoria
            WHERE v.IdVenta = '$searchTerm'";
    
    $result = mysqli_query($conn, $sql);
    $ventas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Devolver los detalles de la venta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($ventas);
    exit;
}
?>
