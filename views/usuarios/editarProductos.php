<?php

require '../../includes/conexionBD.php';

$id = $conn->real_escape_string($_POST['IdProducto']);


$sqlEditar = "SELECT p.IdProducto, p.NombreProducto, p.Descripcion, p.IdProveedor, pr.NombreProveedor, p.CantidadStock, p.IdCategoria, p.IdMarca, p.PrecioCompra, p.PrecioVenta, p.IdMaterial 
FROM tblproductos p
INNER JOIN tblproveedores pr ON p.IdProveedor = pr.IdProveedor
WHERE p.IdProducto = $id LIMIT 1";
$resultado = $conn->query($sqlEditar);
$rows = $resultado->num_rows;

$Productos = [];

if($rows > 0){
    $Productos = $resultado->fetch_array();
}

echo json_encode($Productos, JSON_UNESCAPED_UNICODE);

?>