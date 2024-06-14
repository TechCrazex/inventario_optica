<?php

require '../../includes/conexionBD.php';

$Marca = $conn->real_escape_string($_POST['Marca']);

$sql = "INSERT INTO tblmarcasproductos (Marca) 
    VALUES ('$Marca')";

if ($conn->query($sql)) {
    $IdMarca = $conn->insert_id;
    header('Location: marcas_registrar.php');
}

?>