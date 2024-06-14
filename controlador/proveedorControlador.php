<?php
require_once '../includes/proveedorModelo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si todos los campos esperados están presentes en $_POST
    if (
        isset($_POST['nit']) &&
        isset($_POST['nombreEmpresa']) &&
        isset($_POST['nombreProveedor']) &&
        isset($_POST['direccion']) &&
        isset($_POST['telefono']) &&
        isset($_POST['correo'])
    ) {
        // Accede a los valores una vez que se ha verificado su existencia en $_POST
        $nit = $_POST['nit'];
        $nombreEmpresa = $_POST['nombreEmpresa'];
        $nombreProveedor = $_POST['nombreProveedor'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];

        // Crea una instancia del modelo de proveedores
        $proveedorModelo = new ProveedorModelo();

        // Intenta registrar al proveedor con los datos recibidos
        $registroExitoso = $proveedorModelo->registrarProveedor($nit, $nombreEmpresa, $nombreProveedor, $direccion, $telefono, $correo);

        if ($registroExitoso) {
            echo "<script>alert('Proveedor registrado exitosamente.');
                    window.location.href = '../../views/usuarios/registrarProveedor.php';</script>";
        } else {
            echo "<script>alert('Error al registrar el proveedor.');</script>";
        }
    } 
}

// ////////////////////////////////////////////////////////////
// En tu controlador (proveedorControlador.php)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nitEliminar'])) {
        $nitEliminar = $_POST['nitEliminar'];
        $proveedorModelo = new ProveedorModelo();

        try {
            // Buscar el proveedor por su NIT en la base de datos
            $proveedorEncontrado = $proveedorModelo->buscarPorNit($nitEliminar);

            if ($proveedorEncontrado) {
                $eliminacionExitosa = $proveedorModelo->eliminarProveedor($nitEliminar);

                if ($eliminacionExitosa) {
                    echo "<script>alert('El NIT: $nitEliminar fue eleminado correctamente.');
                    window.location.href = '../../views/usuarios/consultarProveedores.php';</script>";
                } else {
                    echo "<script>alert('Error al eliminar el proveedor con NIT: $nitEliminar.');</script>";
                }
            } else {
                echo "<script>alert('El proveedor con NIT: $nitEliminar no existe en la base de datos.');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Error en la base de datos al eliminar el proveedor con NIT: $nitEliminar.');</script>";
        }
    }
}
// Actualizar proveedor



?>


