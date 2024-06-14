<?php

require '../../includes/conexionBD.php';

$IdCategoria = $conn->real_escape_string($_POST['IdCategoria']);

$sql = "DELETE FROM tblcategoriasproductos WHERE IdCategoria = $IdCategoria";

if ($conn->query($sql)) {
}

header('Location: categorias_registrar.php');
?>