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

$sqlCategoria = "SELECT * FROM tblcategoriasproductos ORDER BY IdCategoria ASC";
$categoria = $conn->query($sqlCategoria);
?>

    <form action="categorias_registrar.php" method="POST">
        <div class="tit-pri">
            <h1>Registros De Las Categorías</h1>
            <div>
                <input type="text" class="light-table-filter" data-table="table-id" placeholder="Buscar...">
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalCategorias">Nuevo registro</a>
            </div>
        </div>
    </form>

    <table class="table-id">
        <thead>
            <tr>
                <th>Id</th>
                <th>Categoría</th>
            </tr>
        </thead>
        <tbody>

        <?php while($rowCategorias = $categoria->fetch_assoc()) { ?>
            <tr>
                <td><?=$rowCategorias['IdCategoria']; ?></td>
                <td><?=$rowCategorias['Categoria']; ?></td>
                <td>
                <a href="#" class="btn btn-sm btn-edi" data-bs-toggle="modal" data-bs-target="#ModalEditarCategorias" data-bs-id="<?= $rowCategorias['IdCategoria']; ?>">Editar</a>
                
                <a href="#" class="btn btn-sm btn-eli" data-bs-toggle="modal" data-bs-target="#ModalEliminarCategorias" data-bs-id="<?= $rowCategorias['IdCategoria']; ?>">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>

    </table>

    <?php include 'ModalRegistrarCategorias.php';  ?>
    <?php include 'ModalEliminarCategorias.php';  ?>
    <?php include 'ModalEditarCategorias.php';  ?>

    <script>
        let ModalEditarCategorias = document.getElementById('ModalEditarCategorias')
        let ModalEliminarCategorias = document.getElementById('ModalEliminarCategorias')


        ModalEditarCategorias.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdCategoria = button.getAttribute('data-bs-id')

            let inputIdCategoria = ModalEditarCategorias.querySelector('.modal-body #IdCategoria')
            let inputCategoria = ModalEditarCategorias.querySelector('.modal-body #Categoria')

            let url = "editarCategorias.php"
            let formData = new FormData();
            formData.append('IdCategoria', IdCategoria);
// Agrega otras líneas para los demás campos del formulario


            fetch(url,{
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {

                inputIdCategoria.value = data.IdCategoria
                inputCategoria.value = data.Categoria

            }).catch(err => console.log(err))

        })



        ModalEliminarCategorias.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdCategoria = button.getAttribute('data-bs-id')
            ModalEliminarCategorias.querySelector('.modal-footer #IdCategoria').value = IdCategoria
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="buscador/buscador.js"></script>
</body>
    <?php require '../../includes/_footer.php' ?>
</html>