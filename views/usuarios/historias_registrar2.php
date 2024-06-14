<?php
session_start();
if (!isset($_SESSION['Correo'])) {
    header('Location: ../../includes/_sesion/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_db.php'; ?>
<?php require '../../includes/_header2.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="../../css/Style.css">
    <!-- Bootstrao iconos PNG -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/styles.css">
    

<body>
<?php
include ('../../includes/conexionBD.php');

$sqlHistoria = "SELECT h.*, CONCAT(c.Nombres, ' ', c.Apellidos) as Cliente
    FROM tblhistoriasclinicass h
    INNER JOIN tblclientes c ON h.IdCliente = c.IdCliente
    ORDER BY h.IdHistoriaClinica ASC";
$historia = $conn->query($sqlHistoria);

$queryCliente = "SELECT * FROM tblclientes";
$cliente = $conn->query($queryCliente);
?>

    <form action="historias_registrar2.php" method="POST">
        <div class="tit-pri">
            <h1>Registro Historias Clinicas</h1>
                <div>
                    <input type="text" class="light-table-filter" data-table="table-id" placeholder="Buscar...">
                </div>
                <div class="col-auto">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalHistorias">Nuevo registro</a>
                </div>
        </div>
    </form>

    <table class="table-id">
        <thead>
            <tr>
                <th>Id</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Antecedentes</th>
                <th>Descripcion</th>
            </tr>
        </thead>
        <tbody>

        <?php while($rowHistorias = $historia->fetch_assoc()) { ?>
            <tr>
                <td><?=$rowHistorias['IdHistoriaClinica']; ?></td>
                <td><?=$rowHistorias['Cliente']; ?></td>
                <td><?=$rowHistorias['Fecha']; ?></td>
                <td><?=$rowHistorias['Antecedentes']; ?></td>
                <td><?=$rowHistorias['Descripcion']; ?></td>
                <td>
                <a href="#" class="btn btn-sm btn-edi" data-bs-toggle="modal" data-bs-target="#ModalEditarHistorias" data-bs-id="<?= $rowHistorias['IdHistoriaClinica']; ?>">Editar</a>
                
                <a href="#" class="btn btn-sm btn-eli" data-bs-toggle="modal" data-bs-target="#ModalEliminarHistorias" data-bs-id="<?= $rowHistorias['IdHistoriaClinica']; ?>">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>

    </table>

    <?php include 'ModalRegistrarHistorias2.php';  ?>
    <?php include 'ModalEliminarHistorias2.php';  ?>
    <?php $cliente->data_seek(0); ?>
    <?php include 'ModalEditarHistorias2.php';  ?>

    <script>
        let ModalEditarHistorias = document.getElementById('ModalEditarHistorias')
        let ModalEliminarHistorias = document.getElementById('ModalEliminarHistorias')


        ModalEditarHistorias.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdHistoriaClinica = button.getAttribute('data-bs-id')

            let inputIdHistoriaClinica = ModalEditarHistorias.querySelector('.modal-body #IdHistoriaClinica')
            let inputIdCliente = ModalEditarHistorias.querySelector('.modal-body #Cliente')
            let inputFecha = ModalEditarHistorias.querySelector('.modal-body #Fecha')
            let inputAntecedentes = ModalEditarHistorias.querySelector('.modal-body #Antecedentes')
            let inputDescripcion = ModalEditarHistorias.querySelector('.modal-body #Descripcion')

            let url = "editarHistorias2.php"
            let formData = new FormData();
            formData.append('IdHistoriaClinica', IdHistoriaClinica);
// Agrega otras líneas para los demás campos del formulario


            fetch(url,{
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {

                inputIdHistoriaClinica.value = data.IdHistoriaClinica
                inputIdCliente.value = data.IdCliente
                inputFecha.value = data.Fecha
                inputAntecedentes.value = data.Antecedentes
                inputDescripcion.value = data.Descripcion

            }).catch(err => console.log(err))

        })



        ModalEliminarHistorias.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdHistoriaClinica = button.getAttribute('data-bs-id')
            ModalEliminarHistorias.querySelector('.modal-footer #IdHistoriaClinica').value = IdHistoriaClinica
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="buscador/buscador.js"></script>
</body>
    <?php require '../../includes/_footer.php' ?>
</html>