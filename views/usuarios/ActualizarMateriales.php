<?php

require '../../includes/conexionBD.php';

$IdMaterial = $conn->real_escape_string($_POST['IdMaterial']);
$Material = $conn->real_escape_string($_POST['Material']);

$sql = "UPDATE tblmaterialesproductos SET
            Material ='$Material'
        WHERE IdMaterial = '$IdMaterial'";

error_log("Consulta SQL: " . $sql);

if ($conn->query($sql)) {
}

header('Location: materiales_registrar.php');
?>