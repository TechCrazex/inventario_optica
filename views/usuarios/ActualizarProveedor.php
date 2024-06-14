<?php

require '../../includes/conexionBD.php';

$IdProveedor = $conn->real_escape_string($_POST['IdProveedor']);
$Nit = $conn->real_escape_string($_POST['Nit']);
$NombreEmpresa = $conn->real_escape_string($_POST['NombreEmpresa']);
$NombreProveedor = $conn->real_escape_string($_POST['NombreProveedor']);
$ProductoVender = $conn->real_escape_string($_POST['ProductoVender']);
$Direccion = $conn->real_escape_string($_POST['Direccion']);
$Telefono = $conn->real_escape_string($_POST['Telefono']);
$Correo = $conn->real_escape_string($_POST['Correo']);



$sql = "UPDATE tblproveedores SET
            Nit ='$Nit',
            NombreEmpresa = '$NombreEmpresa',
            NombreProveedor = '$NombreProveedor',
            ProductoVender = '$ProductoVender',
            Direccion = '$Direccion',
            Telefono = '$Telefono',
            Correo = '$Correo'
        WHERE IdProveedor = '$IdProveedor'";

error_log("Consulta SQL: " . $sql);

if ($conn->query($sql)) {
}

header('Location: registrarProveedor.php');
?>