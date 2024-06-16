<?php
require '../../includes/conexionBD.php';

$NombreEmpresa = $conn->real_escape_string($_POST['NombreEmpresa']);
$NombreProveedor = $conn->real_escape_string($_POST['NombreProveedor']);
$ProductoVender = $conn->real_escape_string($_POST['ProductoVender']);
$Direccion = $conn->real_escape_string($_POST['Direccion']);
$Telefono = $conn->real_escape_string($_POST['Telefono']);
$Correo = $conn->real_escape_string($_POST['Correo']);

// Obtener la fecha y hora actual del servidor
$fechaRegistroPro = date('Y-m-d H:i:s');

$sql = "INSERT INTO tblproveedores (NombreEmpresa, NombreProveedor, ProductoVender, Direccion, Telefono, Correo, fechaRegistroPro) 
    VALUES ('$NombreEmpresa', '$NombreProveedor', '$ProductoVender', '$Direccion', '$Telefono', '$Correo', '$fechaRegistroPro')";

if ($conn->query($sql)) {
    // Éxito al insertar el proveedor, redirige a la página de registros de proveedores
    header('Location: registrarProveedor.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
