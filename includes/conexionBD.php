<?php

$conn = new mysqli("localhost", "u251035269_crudoptica", "Sena2617515.", "u251035269_bdoptica");

if ($conn->connect_error) {
    die("Error de conexion" . $conn->connect_error);
}

?>
<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "u251035269_crudoptica";
$password = "Sena2617515.";
$database = "u251035269_bdoptica";

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>