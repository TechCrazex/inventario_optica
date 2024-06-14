<?php

require '../../includes/conexionBD.php';

$IdEmpleado = $conn->real_escape_string($_POST['IdEmpleado']);
$Nombres = $conn->real_escape_string($_POST['Nombres']);
$Apellidos = $conn->real_escape_string($_POST['Apellidos']);
$Cedula = $conn->real_escape_string($_POST['Cedula']);
$Correo = $conn->real_escape_string($_POST['Correo']);
$Contraseña = $conn->real_escape_string($_POST['Contraseña']);
$IdRol = $conn->real_escape_string($_POST['Rol']);

$sql = "UPDATE tblempleados SET
            Nombres = '$Nombres',
            Apellidos = '$Apellidos',
            Cedula ='$Cedula',
            Correo = '$Correo',
            Contraseña = '$Contraseña',
            IdRol = '$IdRol'
        WHERE IdEmpleado = '$IdEmpleado'";

error_log("Consulta SQL: " . $sql);

if ($conn->query($sql)) {
}

header('Location: empleado_registrar.php');
?>