<?php

require '../../includes/conexionBD.php';

$IdProducto = $conn->real_escape_string($_POST['IdProducto']);

$sql = "DELETE FROM tblproductos WHERE IdProducto = $IdProducto";

if ($conn->query($sql)) {
    // Reiniciar IDs
    $sqlReindex = "
        SET @count = 0;
        UPDATE tblproductos SET IdProducto = @count:= @count + 1;
        ALTER TABLE tblproductos AUTO_INCREMENT = 1;
    ";
    $conn->multi_query($sqlReindex);
    // Asegurarse de que todas las consultas se hayan ejecutado
    while ($conn->next_result()) {;}
}

header('Location: producto_registrar.php');
?>
