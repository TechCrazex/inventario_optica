<?php

require '../../includes/conexionBD.php';

$IdCompra = $conn->real_escape_string($_POST['IdCompra']);

$sql = "DELETE FROM tblcompras WHERE IdCompra = $IdCompra";

if ($conn->query($sql)) {
    // Reiniciar IDs
    $sqlReindex = "
        SET @count = 0;
        UPDATE tblcompras SET IdCompra = @count:= @count + 1;
        ALTER TABLE tblcompras AUTO_INCREMENT = 1;
    ";
    $conn->multi_query($sqlReindex);
    // Asegurarse de que todas las consultas se hayan ejecutado
    while ($conn->next_result()) {;}
}

header('Location: compras_registrar.php');
?>
