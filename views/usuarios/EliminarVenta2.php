<?php

require '../../includes/conexionBD.php';

$IdVenta = $conn->real_escape_string($_POST['IdVenta']);

$sql = "DELETE FROM tblventas WHERE IdVenta = $IdVenta";

if ($conn->query($sql)) {
}

header('Location: venta_registrar2.php');
?>