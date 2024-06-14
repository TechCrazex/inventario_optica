<?php

require '../../includes/conexionBD.php';

$id = $conn->real_escape_string($_POST['IdMarca']);


$sqlEditar = "SELECT IdMarca, Marca FROM tblmarcasproductos WHERE IdMarca=$id LIMIT 1";
$resultado = $conn->query($sqlEditar);
$rows = $resultado->num_rows;

$marca = [];

if($rows > 0){
    $marca = $resultado->fetch_array();
}

echo json_encode($marca, JSON_UNESCAPED_UNICODE);

?>