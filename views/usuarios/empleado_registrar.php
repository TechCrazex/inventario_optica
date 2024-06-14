<?php
session_start();
if (!isset($_SESSION['Correo'])) {
    header('Location: ../../includes/_sesion/login.php');
    exit();
}
?>
<?php require '../../includes/_header.php'; ?>
<?php require '../../includes/_db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="../../css/Style.css">
    <!-- Bootstrao iconos PNG -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/styles.css">
    

<body>
<?php
include ('../../includes/conexionBD.php');

$sqlEmpleado = "SELECT c.*, e.Rol 
FROM tblempleados c
INNER JOIN tblrolesempleados e ON c.IdRol = e.IdRol
ORDER BY c.IdEmpleado ASC";
$empleados = $conn->query($sqlEmpleado);

$queryRoles = "SELECT * FROM tblrolesempleados";
$roles = $conn->query($queryRoles);
?>

    <form action="empleado_registrar.php" method="POST">
        <div class="tit-pri">
            <h1>Registro De Los Empleados</h1>
            <div>
                <input type="text" class="light-table-filter" data-table="table-id" placeholder="Buscar...">
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalEmpleados">Nuevo registro</a>
            </div>
        </div>
    </form>

    <table class="table-id">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cédula</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>

        <?php while($rowEmpleados = $empleados->fetch_assoc()) { ?>
            <tr>
                <td><?=$rowEmpleados['IdEmpleado']; ?></td>
                <td><?=$rowEmpleados['Nombres']; ?></td>
                <td><?=$rowEmpleados['Apellidos']; ?></td>
                <td><?=$rowEmpleados['Cedula']; ?></td>
                <td><?=$rowEmpleados['Correo']; ?></td>
                <td><?=$rowEmpleados['Contraseña']; ?></td>
                <td><?=$rowEmpleados['Rol']; ?></td>
                <td>
                <a href="#" class="btn btn-sm btn-edi" data-bs-toggle="modal" data-bs-target="#ModalEditarEmpleados" data-bs-id="<?= $rowEmpleados['IdEmpleado']; ?>">Editar</a>
                
                <a href="#" class="btn btn-sm btn-eli" data-bs-toggle="modal" data-bs-target="#ModalEliminarEmpleados" data-bs-id="<?= $rowEmpleados['IdEmpleado']; ?>">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>

    </table>

    <?php include 'ModalRegistrarEmpleados.php';  ?>
    <?php $roles->data_seek(0); ?>
    <?php include 'ModalEliminarEmpleados.php';  ?>
    <?php include 'ModalEditarEmpleados.php';  ?>

    <script>
        let ModalEditarEmpleados = document.getElementById('ModalEditarEmpleados')
        let ModalEliminarEmpleados = document.getElementById('ModalEliminarEmpleados')

        ModalEditarEmpleados.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdEmpleado = button.getAttribute('data-bs-id')

            let inputIdEmpleado = ModalEditarEmpleados.querySelector('.modal-body #IdEmpleado')
            let inputNombres = ModalEditarEmpleados.querySelector('.modal-body #Nombres')
            let inputApellidos = ModalEditarEmpleados.querySelector('.modal-body #Apellidos')
            let inputCedula = ModalEditarEmpleados.querySelector('.modal-body #Cedula')
            let inputCorreo = ModalEditarEmpleados.querySelector('.modal-body #Correo')
            let inputContraseña = ModalEditarEmpleados.querySelector('.modal-body #Contraseña')
            let inputRol = ModalEditarEmpleados.querySelector('.modal-body #Rol')

            let url = "editarEmpleado.php"
            let formData = new FormData();
            formData.append('IdEmpleado', IdEmpleado);
// Agrega otras líneas para los demás campos del formulario


            fetch(url,{
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {

                inputIdEmpleado.value = data.IdEmpleado
                inputNombres.value = data.Nombres
                inputApellidos.value = data.Apellidos
                inputCedula.value = data.Cedula
                inputCorreo.value = data.Correo
                inputContraseña.value = data.Contraseña
                inputRol.value = data.IdRol

            }).catch(err => console.log(err))

        })



        ModalEliminarEmpleados.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdEmpleado = button.getAttribute('data-bs-id')
            ModalEliminarEmpleados.querySelector('.modal-footer #IdEmpleado').value = IdEmpleado
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="buscador/buscador.js"></script>
</body>
    <?php require '../../includes/_footer.php' ?>
</html>