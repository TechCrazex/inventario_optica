<?php

require '../../includes/conexionBD.php';

$Nit = $conn->real_escape_string($_POST['Nit']);
$NombreEmpresa = $conn->real_escape_string($_POST['NombreEmpresa']);
$NombreProveedor = $conn->real_escape_string($_POST['NombreProveedor']);
$ProductoVender = $conn->real_escape_string($_POST['ProductoVender']);
$Direccion = $conn->real_escape_string($_POST['Direccion']);
$Telefono = $conn->real_escape_string($_POST['Telefono']);
$Correo = $conn->real_escape_string($_POST['Correo']);

$sql = "INSERT INTO tblproveedores (Nit, NombreEmpresa, NombreProveedor, ProductoVender, Direccion, Telefono, Correo) 
    VALUES ('$Nit', '$NombreEmpresa', '$NombreProveedor', '$ProductoVender', '$Direccion', '$Telefono', '$Correo')";

if ($conn->query($sql)) {
    $IdProveedor = $conn->insert_id;
    header('Location: registrarProveedor.php');
}
?>