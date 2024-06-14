<?php

require '../../includes/conexionBD.php';

$IdMarca = $conn->real_escape_string($_POST['IdMarca']);

$sql = "DELETE FROM tblmarcasproductos WHERE IdMarca = $IdMarca";

if ($conn->query($sql)) {
}

header('Location: marcas_registrar.php');
?>