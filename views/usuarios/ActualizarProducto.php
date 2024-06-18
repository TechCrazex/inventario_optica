<?php

require '../../includes/conexionBD.php';

$IdProducto = $conn->real_escape_string($_POST['IdProducto']);
$NombreProducto = $conn->real_escape_string($_POST['NombreProducto']);
$Descripcion = $conn->real_escape_string($_POST['Descripcion']);
$IdProveedor = $conn->real_escape_string($_POST['IdProveedor']);
$CantidadStock = $conn->real_escape_string($_POST['CantidadStock']);
$IdCategoria = $conn->real_escape_string($_POST['IdCategoria']);
$IdMarca = $conn->real_escape_string($_POST['IdMarca']);
$PrecioCompra = $conn->real_escape_string($_POST['PrecioCompra']);
$PrecioVenta = $conn->real_escape_string($_POST['PrecioVenta']);
$IdMaterial = $conn->real_escape_string($_POST['IdMaterial']);



$sql = "UPDATE tblproductos SET
            NombreProducto ='$NombreProducto',
            Descripcion = '$Descripcion',
            IdProveedor = '$IdProveedor',
            CantidadStock = '$CantidadStock',
            IdCategoria = '$IdCategoria',
            IdMarca = '$IdMarca',
            PrecioCompra = '$PrecioCompra',
            PrecioVenta = '$PrecioVenta',
            IdMaterial = '$IdMaterial'
        WHERE IdProducto = '$IdProducto'";

error_log("Consulta SQL: " . $sql);

if ($conn->query($sql)) {
}

header('Location: producto_registrar.php');
?>
