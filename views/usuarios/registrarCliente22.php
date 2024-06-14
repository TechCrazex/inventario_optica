<?php

require '../../includes/conexionBD.php';

$Cedula = $conn->real_escape_string($_POST['Cedula']);
$Nombres = $conn->real_escape_string($_POST['Nombres']);
$Apellidos = $conn->real_escape_string($_POST['Apellidos']);
$Telefono = $conn->real_escape_string($_POST['Telefono']);
$Correo = $conn->real_escape_string($_POST['Correo']);

$sql = "INSERT INTO tblclientes (Cedula, Nombres, Apellidos, Telefono, Correo) 
    VALUES ('$Cedula', '$Nombres', '$Apellidos', '$Telefono','$Correo')";

if ($conn->query($sql)) {
    $IdCliente = $conn->insert_id;
    header('Location: cliente_registrar2.php');
}

?>