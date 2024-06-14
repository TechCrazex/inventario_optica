<?php

require '../../includes/conexionBD.php';

$id = $conn->real_escape_string($_POST['IdHistoriaClinica']);


$sqlEditar = "SELECT IdHistoriaClinica, IdCliente, Fecha, Antecedentes, Descripcion FROM tblhistoriasclinicass WHERE IdHistoriaClinica=$id LIMIT 1";
$resultado = $conn->query($sqlEditar);
$rows = $resultado->num_rows;

$historia = [];



if ($rows > 0) {
    $historia = $resultado->fetch_array();
}


echo json_encode($historia, JSON_UNESCAPED_UNICODE);

?>