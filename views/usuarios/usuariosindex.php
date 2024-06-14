<?php 

// Incluir el archivo de conexión a la base de datos

require_once("../../includes/conexionBD.php");
require '../../includes/_header.php';
// Obtener el correo electrónico del usuario que inició sesión
session_start();
$correoUsuario = $_SESSION['Correo'];

// Definir la zona horaria de Bogotá, Colombia
date_default_timezone_set('America/Bogota');

// Consulta preparada para obtener los datos del empleado que inició sesión
$consultaUsuario = "SELECT IdEmpleado, Nombres, Apellidos, Cedula, Correo, Contraseña, IdRol, NOW() AS Fecha_Hora_Actual FROM tblempleados WHERE Correo=?";
if ($stmt = $conexion->prepare($consultaUsuario)) {
    $stmt->bind_param("s", $correoUsuario);
    $stmt->execute();
    $resultadoUsuario = $stmt->get_result();

    // Comprobar si se obtuvieron resultados
    if ($resultadoUsuario->num_rows > 0) {
        $filaUsuario = $resultadoUsuario->fetch_assoc();
        echo "<table border='1'>
        <tr>
        <th>IdEmpleado</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Cedula</th>
        <th>Correo</th>
        <th>Contraseña</th>
        <th>IdRol</th>
        <th>Registro</th>
        </tr>";
        // Mostrar los datos del empleado que inició sesión
        echo "<tr>";
        echo "<td>" . $filaUsuario["IdEmpleado"] . "</td>";
        echo "<td>" . $filaUsuario["Nombres"] . "</td>";
        echo "<td>" . $filaUsuario["Apellidos"] . "</td>";
        echo "<td>" . $filaUsuario["Cedula"] . "</td>";
        echo "<td>" . $filaUsuario["Correo"] . "</td>";
        echo "<td>" . $filaUsuario["Contraseña"] . "</td>";
        echo "<td>" . $filaUsuario["IdRol"] . "</td>";
        echo "<td>" . $filaUsuario["Fecha_Hora_Actual"] . "</td>";
        echo "</tr>";
        echo "</table>";
    } else {
        echo "No se encontró el empleado.";
    }
    // Cerrar la statement
    $stmt->close();
} else {
    // Manejo de errores si la consulta preparada falla
    echo "Error en la preparación de la consulta.";
}

// Cerrar la conexión
$conexion->close();
?>


</html>
