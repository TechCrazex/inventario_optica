<?php
/**
 * Validación de datos para poder iniciar sesión
 */
date_default_timezone_set('America/Bogota');
require_once("../conexionBD.php");

// Obtener los datos del formulario
$Correo = $_POST['Correo'];
$Contraseña = $_POST['Contraseña'];

date_default_timezone_set('America/Bogota');

// Consulta para obtener los datos del usuario
$consulta = "SELECT e.*, r.Rol 
             FROM tblempleados e 
             INNER JOIN tblrolesempleados r ON e.IdRol = r.IdRol 
             WHERE e.Correo='$Correo' AND e.Contraseña='$Contraseña'";
$resultado = mysqli_query($conexion, $consulta);
$usuario = mysqli_fetch_assoc($resultado); // Obtenemos los datos del usuario

if ($usuario) {
    // Obtener la fecha y hora actual
    $fechaHoraActual = date('Y-m-d H:i:s');
    
    // Insertar el registro en la tabla tblempleados
    $idEmpleado = $usuario['IdEmpleado'];
    $insertarRegistro = "UPDATE tblempleados SET Registro='$fechaHoraActual' WHERE IdEmpleado='$idEmpleado'";
    mysqli_query($conexion, $insertarRegistro);

    // Iniciar sesión y redirigir según el rol del usuario
    session_start();
    $_SESSION['Correo'] = $Correo;
    switch ($usuario['Rol']) {
        case 'Administrador':
            header('Location: ../../views/usuarios/index.php');
            break;
        case 'Empleado':
            header('Location: ../../views/usuarios/index2.php');
            break;
    }
} else {
    // Si no se encontró un usuario, redirigir al inicio de sesión
    header('Location: ../../index.php');
    // Destruir la sesión
    session_destroy();
}
?>
