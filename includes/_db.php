<?php
$host = "localhost";
$user = "u251035269_crudoptica";
$password = "Sena2617515.";
$database = "u251035269_bdoptica";


$conexion = mysqli_connect($host, $user, $password, $database);
if(!$conexion){
echo "No se realizo la conexion a la basa de datos, el error fue:".
mysqli_connect_error() ;
}

?>
