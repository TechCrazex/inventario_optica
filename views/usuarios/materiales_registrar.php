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

$sqlMateriales = "SELECT * FROM tblmaterialesproductos
    ORDER BY IdMaterial ASC";
$materiales = $conn->query($sqlMateriales);

?>

    <form action="materiales_registrar.php" method="POST">
        <div class="tit-pri">
            <h1>Registros De Los Materiales</h1>
            <div>
                <input type="text" class="light-table-filter" data-table="table-id" placeholder="Buscar...">
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalMateriales">Nuevo registro</a>
            </div>
        </div>
    </form>

    <table class="table-id">
        <thead>
            <tr>
                <th>Id</th>
                <th>Material</th>
            </tr>
        </thead>
        <tbody>

        <?php while($rowMateriales = $materiales->fetch_assoc()) { ?>
            <tr>
                <td><?=$rowMateriales['IdMaterial']; ?></td>
                <td><?=$rowMateriales['Material']; ?></td>
                <td>
                <a href="#" class="btn btn-sm btn-edi" data-bs-toggle="modal" data-bs-target="#ModalEditarMateriales" data-bs-id="<?= $rowMateriales['IdMaterial']; ?>">Editar</a>
                
                <a href="#" class="btn btn-sm btn-eli" data-bs-toggle="modal" data-bs-target="#ModalEliminarMateriales" data-bs-id="<?= $rowMateriales['IdMaterial']; ?>">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php include 'ModalRegistrarMateriales.php';  ?>
    <?php include 'ModalEliminarMateriales.php';  ?>
    <?php include 'ModalEditarMateriales.php';  ?>

    <script>
        let ModalEditarMateriales = document.getElementById('ModalEditarMateriales')
        let ModalEliminarMateriales = document.getElementById('ModalEliminarMateriales')


        ModalEditarMateriales.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdMaterial = button.getAttribute('data-bs-id')

            let inputIdMaterial = ModalEditarMateriales.querySelector('.modal-body #IdMaterial')
            let inputMaterial = ModalEditarMateriales.querySelector('.modal-body #Material')

            let url = "editarMateriales.php"
            let formData = new FormData();
            formData.append('IdMaterial', IdMaterial);
// Agrega otras líneas para los demás campos del formulario


            fetch(url,{
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {

                inputIdMaterial.value = data.IdMaterial
                inputMaterial.value = data.Material

            }).catch(err => console.log(err))

        })



        ModalEliminarMateriales.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdMaterial = button.getAttribute('data-bs-id')
            ModalEliminarMateriales.querySelector('.modal-footer #IdMaterial').value = IdMaterial
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="buscador/buscador.js"></script>
</body>
    <?php require '../../includes/_footer.php' ?>
</html>