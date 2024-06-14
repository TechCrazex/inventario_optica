<?php

require '../../includes/conexionBD.php';

$IdCliente = $conn->real_escape_string($_POST['IdCliente']);
$Cedula = $conn->real_escape_string($_POST['Cedula']);
$Nombres = $conn->real_escape_string($_POST['Nombres']);
$Apellidos = $conn->real_escape_string($_POST['Apellidos']);
$Telefono = $conn->real_escape_string($_POST['Telefono']);
$Correo = $conn->real_escape_string($_POST['Correo']);

$sql = "UPDATE tblclientes SET
            Cedula ='$Cedula',
            Nombres = '$Nombres',
            Apellidos = '$Apellidos',
            Telefono = '$Telefono',
            Correo = '$Correo'
        WHERE IdCliente = '$IdCliente'";

error_log("Consulta SQL: " . $sql);

if ($conn->query($sql)) {
}

header('Location: cliente_registrar.php');
?>