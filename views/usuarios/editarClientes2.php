<?php

require '../../includes/conexionBD.php';

$id = $conn->real_escape_string($_POST['IdCliente']);


$sqlEditar = "SELECT IdCliente, Cedula, Nombres, Apellidos, Telefono, Correo FROM tblclientes WHERE IdCliente=$id LIMIT 1";
$resultado = $conn->query($sqlEditar);
$rows = $resultado->num_rows;

$cliente = [];

if($rows > 0){
    $cliente = $resultado->fetch_array();
}

echo json_encode($cliente, JSON_UNESCAPED_UNICODE);

?>