<?php
error_reporting(0);
session_start();
$actualsesion = $_SESSION['Correo'];

// if($actualsesion == null || $actualsesion == ''){
// header('location: includes/_sesion/login.php');
// }
// else{
//    header('location: views/usuarios/index.php');
// }

if ($usuario) {
   // Dependiendo del rol del usuario, redirigir a la página correspondiente
   switch ($usuario['rol']) {
       case 'Administrador':
           header('Location: ../../views/usuarios/index.php');
           break;
       case 'Vendedor':
           header('Location: ../../views/usuarios/index2.php');
           break;
       default:
           // En caso de que el rol no coincida con ninguno de los anteriores, redirigir al inicio de sesión
           header('Location: ../../includes/_sesion/login.php');
           break;
   }
} else {
   // Si no se encontró un usuario, o las credenciales son incorrectas, redirigir al inicio de sesión
   header('Location: ../../includes/_sesion/login.php');
   // Destruir la sesión
   session_destroy();
}
?>