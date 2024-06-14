<?php

require '../../includes/conexionBD.php';

$IdHistoriaClinica = $conn->real_escape_string($_POST['IdHistoriaClinica']);

$sql = "DELETE FROM tblhistoriasclinicass WHERE IdHistoriaClinica = $IdHistoriaClinica";

if ($conn->query($sql)) {
}

header('Location: historias_registrar2.php');
?>