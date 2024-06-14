<?php

require '../../includes/conexionBD.php';

$id = $conn->real_escape_string($_POST['IdMaterial']);


$sqlEditar = "SELECT IdMaterial, Material FROM tblmaterialesproductos WHERE IdMaterial=$id LIMIT 1";
$resultado = $conn->query($sqlEditar);
$rows = $resultado->num_rows;

$materiales = [];

if($rows > 0){
    $materiales = $resultado->fetch_array();
}

echo json_encode($materiales, JSON_UNESCAPED_UNICODE);

?>