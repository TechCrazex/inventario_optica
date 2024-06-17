<?php

require '../../includes/conexionBD.php';

$IdMarca = $conn->real_escape_string($_POST['IdMarca']);

$sql = "DELETE FROM tblmarcasproductos WHERE IdMarca = $IdMarca";

if ($conn->query($sql)) {
    // Reiniciar IDs
    $sqlReindex = "
        SET @count = 0;
        UPDATE tblmarcasproductos SET IdMarca = @count:= @count + 1;
        ALTER TABLE tblmarcasproductos AUTO_INCREMENT = 1;
    ";
    $conn->multi_query($sqlReindex);
    // Asegurarse de que todas las consultas se hayan ejecutado
    while ($conn->next_result()) {;}
}

header('Location: marcas_registrar.php');
?>
