<?php

require '../../includes/conexionBD.php';

$IdMaterial = $conn->real_escape_string($_POST['IdMaterial']);

$sql = "DELETE FROM tblmaterialesproductos WHERE IdMaterial = $IdMaterial";

if ($conn->query($sql)) {
}

header('Location: materiales_registrar.php');
?>