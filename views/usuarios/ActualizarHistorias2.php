<?php

require '../../includes/conexionBD.php';

$IdHistoriaClinica = $conn->real_escape_string($_POST['IdHistoriaClinica']);
$IdCliente = $conn->real_escape_string($_POST['Cliente']);
$Fecha = $conn->real_escape_string($_POST['Fecha']);
$Antecedentes = $conn->real_escape_string($_POST['Antecedentes']);
$Descripcion = $conn->real_escape_string($_POST['Descripcion']);



$sql = "UPDATE tblhistoriasclinicass SET
            IdCliente = '$IdCliente',
            Fecha = '$Fecha',
            Antecedentes = '$Antecedentes',
            Descripcion = '$Descripcion'
        WHERE IdHistoriaClinica = '$IdHistoriaClinica'";

error_log("Consulta SQL: " . $sql);

if ($conn->query($sql)) {
}

header('Location: historias_registrar2.php');
?>