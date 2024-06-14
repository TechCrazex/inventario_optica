<?php

require '../../includes/conexionBD.php';

$IdProveedor = $conn->real_escape_string($_POST['IdProveedor']);

$sql = "DELETE FROM tblproveedores WHERE IdProveedor = $IdProveedor";

if ($conn->query($sql)) {
}

header('Location: registrarProveedor.php');
?>