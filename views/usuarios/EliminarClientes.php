<?php

require '../../includes/conexionBD.php';

$IdCliente = $conn->real_escape_string($_POST['IdCliente']);

$sql = "DELETE FROM tblclientes WHERE IdCliente = $IdCliente";

if ($conn->query($sql)) {
    // Reiniciar IDs
    $sqlReindex = "
        SET @count = 0;
        UPDATE tblclientes SET IdCliente = @count:= @count + 1;
        ALTER TABLE tblclientes AUTO_INCREMENT = 1;
    ";
    $conn->multi_query($sqlReindex);
    // Asegurarse de que todas las consultas se hayan ejecutado
    while ($conn->next_result()) {;}
}

header('Location: cliente_registrar.php');
?>
