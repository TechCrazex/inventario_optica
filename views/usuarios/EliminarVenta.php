<?php

require '../../includes/conexionBD.php';

$IdVenta = $conn->real_escape_string($_POST['IdVenta']);

$sql = "DELETE FROM tblventas WHERE IdVenta = $IdVenta";

if ($conn->query($sql)) {
    // Reiniciar IDs
    $sqlReindex = "
        SET @count = 0;
        UPDATE tblventas SET IdVenta = @count:= @count + 1;
        ALTER TABLE tblventas AUTO_INCREMENT = 1;
    ";
    $conn->multi_query($sqlReindex);
    // Asegurarse de que todas las consultas se hayan ejecutado
    while ($conn->next_result()) {;}
}

header('Location: venta_registrar.php');
?>
