<?php

require '../../includes/conexionBD.php';

$IdMarca = $conn->real_escape_string($_POST['IdMarca']);
$Marca = $conn->real_escape_string($_POST['Marca']);

$sql = "UPDATE tblmarcasproductos SET
            Marca ='$Marca'
        WHERE IdMarca = '$IdMarca'";

error_log("Consulta SQL: " . $sql);

if ($conn->query($sql)) {
}

header('Location: marcas_registrar.php');
?>