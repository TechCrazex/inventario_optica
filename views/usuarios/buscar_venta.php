<?php
// Incluir el archivo de conexión a la base de datos
require_once '../../includes/conexionBD.php';

// Inicializar un array para almacenar las ventas encontradas
$ventas = [];

// Verificar si se ha enviado un término de búsqueda
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['searchTerm'])) {
    $searchTerm = $conn->real_escape_string($_POST['searchTerm']);
    
    // Consulta SQL para buscar la venta por IdVenta
    $sqlVentas = "SELECT v.IdVenta, v.NumeroVenta, CONCAT(c.Nombres, ' ', c.Apellidos) AS Cliente, p.NombreProducto, v.CantidadVendida, v.PrecioUnidad, v.PrecioTotal, v.FechaVenta, v.Observacion, cp.Categoria 
                  FROM tblventas v 
                  JOIN tblclientes c ON v.IdCliente = c.IdCliente 
                  JOIN tblproductos p ON v.IdProducto = p.IdProducto
                  JOIN tblcategoriasproductos cp ON v.IdCategoria = cp.IdCategoria
                  WHERE v.IdVenta = '$searchTerm'
                  ORDER BY v.IdVenta ASC";

    // Ejecutar la consulta SQL
    $result = mysqli_query($conn, $sqlVentas);

    // Verificar si se encontraron resultados
    if ($result) {
        // Obtener todas las filas como un array asociativo
        $ventas = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        // Manejar cualquier error o falta de resultados
        $error = mysqli_error($conn);
        echo "Error al ejecutar la consulta: " . $error;
    }
}

// Devolver los detalles de la venta en formato JSON
header('Content-Type: application/json');
echo json_encode($ventas);
exit;
?>
