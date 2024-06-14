<?php

require '../../includes/conexionBD.php';

$Nombres = $conn->real_escape_string($_POST['Nombres']);
$Apellidos = $conn->real_escape_string($_POST['Apellidos']);
$Cedula = $conn->real_escape_string($_POST['Cedula']);
$Correo = $conn->real_escape_string($_POST['Correo']);
$Contraseña = $conn->real_escape_string($_POST['Contraseña']);
$IdRol = $conn->real_escape_string($_POST['Rol']);

$sql = "INSERT INTO tblempleados (Nombres, Apellidos, Cedula, Correo, Contraseña, IdRol) 
    VALUES ('$Nombres', '$Apellidos', '$Cedula', '$Correo', '$Contraseña', '$IdRol')";

if ($conn->query($sql)) {
    $IdEmpleado = $conn->insert_id;
    header('Location: empleado_registrar.php');
}

?>