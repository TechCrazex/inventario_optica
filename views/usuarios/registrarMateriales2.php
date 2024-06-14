<?php

require '../../includes/conexionBD.php';

$Material = $conn->real_escape_string($_POST['Material']);

$sql = "INSERT INTO tblmaterialesproductos (Material) 
    VALUES ('$Material')";

if ($conn->query($sql)) {
    $IdMaterial = $conn->insert_id;
    header('Location: materiales_registrar.php');
}

?>