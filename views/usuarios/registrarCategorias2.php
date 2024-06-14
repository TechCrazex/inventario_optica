<?php

require '../../includes/conexionBD.php';

$Categoria = $conn->real_escape_string($_POST['Categoria']);

$sql = "INSERT INTO tblcategoriasproductos (Categoria) 
    VALUES ('$Categoria')";

if ($conn->query($sql)) {
    $IdCategoria = $conn->insert_id;
    header('Location: categorias_registrar.php');
}

?>