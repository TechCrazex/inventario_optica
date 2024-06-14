<?php

require '../../includes/conexionBD.php';

$IdProducto = $conn->real_escape_string($_POST['IdProducto']);

$sql = "DELETE FROM tblproductos WHERE IdProducto = $IdProducto";

if ($conn->query($sql)) {
}

header('Location: producto_registrar2.php');
?>