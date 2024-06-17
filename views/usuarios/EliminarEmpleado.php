<?php

require '../../includes/conexionBD.php';

$IdEmpleado = $conn->real_escape_string($_POST['IdEmpleado']);

$sql = "DELETE FROM tblempleados WHERE IdEmpleado = $IdEmpleado";

if ($conn->query($sql)) {
    // Reiniciar IDs
    $sqlReindex = "
        SET @count = 0;
        UPDATE tblempleados SET IdEmpleado = @count:= @count + 1;
        ALTER TABLE tblempleados AUTO_INCREMENT = 1;
    ";
    $conn->multi_query($sqlReindex);
    // Asegurarse de que todas las consultas se hayan ejecutado
    while ($conn->next_result()) {;}
}

header('Location: empleado_registrar.php');
?>
