<?php

require '../../includes/conexionBD.php';

$IdCliente = $conn->real_escape_string($_POST['IdCliente']);

$sql = "DELETE FROM tblclientes WHERE IdCliente = $IdCliente";

if ($conn->query($sql)) {
}

header('Location: cliente_registrar.php');
?>