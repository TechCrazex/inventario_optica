<?php

require '../../includes/conexionBD.php';

$IdProveedor = $conn->real_escape_string($_POST['IdProveedor']);

$sql = "DELETE FROM tblproveedores WHERE IdProveedor = $IdProveedor";

if ($conn->query($sql)) {
    // Reiniciar IDs
    $sqlReindex = "
        SET @count = 0;
        UPDATE tblproveedores SET IdProveedor = @count:= @count + 1;
        ALTER TABLE tblproveedores AUTO_INCREMENT = 1;
    ";
    $conn->multi_query($sqlReindex);
    // Asegurarse de que todas las consultas se hayan ejecutado
    while ($conn->next_result()) {;}
}

header('Location: registrarProveedor.php');
?>
