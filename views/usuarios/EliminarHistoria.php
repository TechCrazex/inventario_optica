<?php

require '../../includes/conexionBD.php';

$IdHistoriaClinica = $conn->real_escape_string($_POST['IdHistoriaClinica']);

$sql = "DELETE FROM tblhistoriasclinicass WHERE IdHistoriaClinica = $IdHistoriaClinica";

if ($conn->query($sql)) {
    // Reiniciar IDs
    $sqlReindex = "
        SET @count = 0;
        UPDATE tblhistoriasclinicass SET IdHistoriaClinica = @count:= @count + 1;
        ALTER TABLE tblhistoriasclinicass AUTO_INCREMENT = 1;
    ";
    $conn->multi_query($sqlReindex);
    // Asegurarse de que todas las consultas se hayan ejecutado
    while ($conn->next_result()) {;}
}

header('Location: historias_registrar.php');
?>
