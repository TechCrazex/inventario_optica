<?php
session_start();
if (!isset($_SESSION['Correo'])) {
    header('Location: ../../includes/_sesion/login.php');
    exit();
}
?>
<?php require '../../includes/_db.php'; ?>
<?php require '../../includes/_header2.php'; ?>
<!DOCTYPE html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Bootstrao iconos PNG -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="../../css/Style.css">
    

<body>
<?php
include ('../../includes/conexionBD.php');

$sqlCliente = "SELECT * FROM tblclientes
ORDER BY IdCliente ASC";
$clientes = $conn->query($sqlCliente);

?>

    <form action="cliente_registrar.php" method="POST">
        <div class="tit-pri">
            <h1>Registros De Los Clientes</h1>
                <div>
                    <input type="text" class="light-table-filter" data-table="table-id" placeholder="Buscar...">
                </div>
                <div class="col-auto">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalClientes">Nuevo registro</a>
                </div>
        </div>
    </form>

    <table class="table-id">
        <thead>
            <tr>
                <th>Id</th>
                <th>Cédula</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Teléfono</th>
                <th>Correo</th>
            </tr>
        </thead>
        <tbody>

        <?php while($rowClientes = $clientes->fetch_assoc()) { ?>
            <tr>
                <td><?=$rowClientes['IdCliente']; ?></td>
                <td><?=$rowClientes['Cedula']; ?></td>
                <td><?=$rowClientes['Nombres']; ?></td>
                <td><?=$rowClientes['Apellidos']; ?></td>
                <td><?=$rowClientes['Telefono']; ?></td>
                <td><?=$rowClientes['Correo']; ?></td>
                <td>
                <a href="#" class="btn btn-sm btn-edi" data-bs-toggle="modal" data-bs-target="#ModalEditarClientes" data-bs-id="<?= $rowClientes['IdCliente']; ?>">Editar</a>
                
                <a href="#" class="btn btn-sm btn-eli" data-bs-toggle="modal" data-bs-target="#ModalEliminarClientes" data-bs-id="<?= $rowClientes['IdCliente']; ?>">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>

    </table>

    <?php include 'ModalRegistrarClientes.php';  ?>
    <?php include 'ModalEliminarClientes.php';  ?>
    <?php include 'ModalEditarClientes.php';  ?>

    <script>
        let ModalEditarClientes = document.getElementById('ModalEditarClientes')
        let ModalEliminarClientes = document.getElementById('ModalEliminarClientes')

        ModalEditarClientes.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdCliente = button.getAttribute('data-bs-id')

            let inputIdCliente = ModalEditarClientes.querySelector('.modal-body #IdCliente')
            let inputCedula = ModalEditarClientes.querySelector('.modal-body #Cedula')
            let inputNombres = ModalEditarClientes.querySelector('.modal-body #Nombres')
            let inputApellidos = ModalEditarClientes.querySelector('.modal-body #Apellidos')
            let inputTelefono = ModalEditarClientes.querySelector('.modal-body #Telefono')
            let inputCorreo = ModalEditarClientes.querySelector('.modal-body #Correo')

            let url = "editarClientes.php"
            let formData = new FormData();
            formData.append('IdCliente', IdCliente);
// Agrega otras líneas para los demás campos del formulario


            fetch(url,{
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {

                inputIdCliente.value = data.IdCliente
                inputCedula.value = data.Cedula
                inputNombres.value = data.Nombres
                inputApellidos.value = data.Apellidos
                inputTelefono.value = data.Telefono
                inputCorreo.value = data.Correo

            }).catch(err => console.log(err))

        })

        ModalEliminarClientes.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdCliente = button.getAttribute('data-bs-id')
            ModalEliminarClientes.querySelector('.modal-footer #IdCliente').value = IdCliente
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="buscador/buscador.js"></script>
</body>
    <?php require '../../includes/_footer.php' ?>
</html>
