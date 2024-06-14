<?php

require '../../includes/conexionBD.php';

$IdCategoria = $conn->real_escape_string($_POST['IdCategoria']);
$Categoria = $conn->real_escape_string($_POST['Categoria']);


$sql = "UPDATE tblcategoriasproductos SET
            Categoria ='$Categoria'
        WHERE IdCategoria = '$IdCategoria'";

error_log("Consulta SQL: " . $sql);

if ($conn->query($sql)) {
}

header('Location: categorias_registrar.php');
?>