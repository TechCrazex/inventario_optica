<?php

require '../../includes/conexionBD.php';

$id = $conn->real_escape_string($_POST['IdProveedor']);


$sqlEditar = "SELECT IdProveedor, Nit, NombreEmpresa, NombreProveedor, ProductoVender, Direccion, Telefono, Correo FROM tblproveedores WHERE IdProveedor=$id LIMIT 1";
$resultado = $conn->query($sqlEditar);
$rows = $resultado->num_rows;

$proveedores = [];

if($rows > 0){
    $proveedores = $resultado->fetch_array();
}

echo json_encode($proveedores, JSON_UNESCAPED_UNICODE);

?>