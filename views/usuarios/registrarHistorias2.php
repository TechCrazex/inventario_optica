<?php

require '../../includes/conexionBD.php';

$IdCliente = $conn->real_escape_string($_POST['Cliente']);
$Fecha = $conn->real_escape_string($_POST['Fecha']);
$Antecedentes = $conn->real_escape_string($_POST['Antecedentes']);
$Descripcion = $conn->real_escape_string($_POST['Descripcion']);

$sql = "INSERT INTO tblhistoriasclinicass (IdCliente, Fecha, Antecedentes, Descripcion) 
    VALUES ('$IdCliente', '$Fecha', '$Antecedentes', '$Descripcion')";

if ($conn->query($sql)) {
    $IdHistoriaClinica = $conn->insert_id;
    header('Location: historias_registrar.php');
} else {
    echo 'Error: ' . $conn->error;
}


?>