<?php
session_start();
if (!isset($_SESSION['Correo'])) {
    header('Location: ../../includes/_sesion/login.php');
    exit();
}
?>
<?php require '../../includes/_db.php'; ?>
<?php require '../../includes/_header.php'; ?>
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

$sqlMarcas = "SELECT * FROM tblmarcasproductos
    ORDER BY IdMarca ASC";
$marcas = $conn->query($sqlMarcas);

?>

    <form action="marcas_registrar.php" method="POST">
        <div class="tit-pri">
            <h1>Registros De Las Marcas</h1>
            <div>
                <input type="text" class="light-table-filter" data-table="table-id" placeholder="Buscar...">
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalMarcas">Nuevo registro</a>
            </div>
        </div> 
    </form>

    <table class="table-id">
        <thead>
            <tr>
                <th>Id</th>
                <th>Marca</th>
            </tr>
        </thead>
        <tbody>

        <?php while($rowMarcas = $marcas->fetch_assoc()) { ?>
            <tr>
                <td><?=$rowMarcas['IdMarca']; ?></td>
                <td><?=$rowMarcas['Marca']; ?></td>
                <td>
                <a href="#" class="btn btn-sm btn-edi" data-bs-toggle="modal" data-bs-target="#ModalEditarMarcas" data-bs-id="<?= $rowMarcas['IdMarca']; ?>">Editar</a>
                
                <a href="#" class="btn btn-sm btn-eli" data-bs-toggle="modal" data-bs-target="#ModalEliminarMarcas" data-bs-id="<?= $rowMarcas['IdMarca']; ?>">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>

    </table>

    <?php include 'ModalRegistrarMarcas.php';  ?>
    <?php include 'ModalEliminarMarcas.php';  ?>
    <?php include 'ModalEditarMarcas.php';  ?>

    <script>
        let ModalEditarMarcas = document.getElementById('ModalEditarMarcas')
        let ModalEliminarMarcas = document.getElementById('ModalEliminarMarcas')


        ModalEditarMarcas.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdMarca = button.getAttribute('data-bs-id')

            let inputIdMarca = ModalEditarMarcas.querySelector('.modal-body #IdMarca')
            let inputMarca = ModalEditarMarcas.querySelector('.modal-body #Marca')

            let url = "editarMarcas.php"
            let formData = new FormData();
            formData.append('IdMarca', IdMarca);
// Agrega otras líneas para los demás campos del formulario


            fetch(url,{
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {

                inputIdMarca.value = data.IdMarca
                inputMarca.value = data.Marca

            }).catch(err => console.log(err))

        })



        ModalEliminarMarcas.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdMarca = button.getAttribute('data-bs-id')
            ModalEliminarMarcas.querySelector('.modal-footer #IdMarca').value = IdMarca
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="buscador/buscador.js"></script>
</body>
    <?php require '../../includes/_footer.php' ?>
</html>