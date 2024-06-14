<?php

require '../../includes/conexionBD.php';

$id = $conn->real_escape_string($_POST['IdCategoria']);


$sqlEditar = "SELECT IdCategoria, Categoria FROM tblcategoriasproductos WHERE IdCategoria=$id LIMIT 1";
$resultado = $conn->query($sqlEditar);
$rows = $resultado->num_rows;

$categoria = [];

if($rows > 0){
    $categoria = $resultado->fetch_array();
}

echo json_encode($categoria, JSON_UNESCAPED_UNICODE);

?>