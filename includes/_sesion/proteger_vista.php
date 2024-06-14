<?php
session_start();
if (!isset($_SESSION['Correo'])) {
    header('Location: ../../includes/_sesion/login.php');
    exit();
}
?>