<?php

require '../../includes/conexionBD.php';

$IdCategoria = $conn->real_escape_string($_POST['IdCategoria']);

$sql = "DELETE FROM tblcategoriasproductos WHERE IdCategoria = $IdCategoria";

if ($conn->query($sql)) {
    // Reiniciar IDs
    $sqlReindex = "
        SET @count = 0;
        UPDATE tblcategoriasproductos SET IdCategoria = @count:= @count + 1;
        ALTER TABLE tblcategoriasproductos AUTO_INCREMENT = 1;
    ";
    $conn->multi_query($sqlReindex);
    // Asegurarse de que todas las consultas se hayan ejecutado
    while ($conn->next_result()) {;}
}

header('Location: categorias_registrar.php');
?>
