<?php

require '../../includes/conexionBD.php';

$id = $conn->real_escape_string($_POST['IdEmpleado']);


$sqlEditar = "SELECT IdEmpleado, Nombres, Apellidos, Cedula, Correo, Contraseña, IdRol FROM tblempleados WHERE IdEmpleado=$id LIMIT 1";
$resultado = $conn->query($sqlEditar);
$rows = $resultado->num_rows;

$empleado = [];

if($rows > 0){
    $empleado = $resultado->fetch_array();
}

echo json_encode($empleado, JSON_UNESCAPED_UNICODE);

?>