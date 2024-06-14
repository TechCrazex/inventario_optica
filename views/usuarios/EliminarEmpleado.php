<?php

require '../../includes/conexionBD.php';

$IdEmpleado = $conn->real_escape_string($_POST['IdEmpleado']);

$sql = "DELETE FROM tblempleados WHERE IdEmpleado = $IdEmpleado";

if ($conn->query($sql)) {
}

header('Location: empleado_registrar.php');
?>