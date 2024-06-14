<?php

require '../../includes/conexionBD.php';

$IdCompra = $conn->real_escape_string($_POST['IdCompra']);

$sql = "DELETE FROM tblcompras WHERE IdCompra = $IdCompra";

if ($conn->query($sql)) {
}

header('Location: compras_registrar.php');
?>