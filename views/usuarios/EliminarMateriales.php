<?php

require '../../includes/conexionBD.php';

$IdMaterial = $conn->real_escape_string($_POST['IdMaterial']);

$sql = "DELETE FROM tblmaterialesproductos WHERE IdMaterial = $IdMaterial";

if ($conn->query($sql)) {
    // Reiniciar IDs
    $sqlReindex = "
        SET @count = 0;
        UPDATE tblmaterialesproductos SET IdMaterial = @count:= @count + 1;
        ALTER TABLE tblmaterialesproductos AUTO_INCREMENT = 1;
    ";
    $conn->multi_query($sqlReindex);
    // Asegurarse de que todas las consultas se hayan ejecutado
    while ($conn->next_result()) {;}
}

header('Location: materiales_registrar.php');
?>
