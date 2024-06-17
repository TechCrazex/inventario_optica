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

$sqlCompras = "SELECT p.*, pr.NombreProducto, c.NombreProveedor, CONCAT(e.Nombres, ' ', e.Apellidos) as Empleado
    FROM tblcompras p 
    INNER JOIN tblproductos pr ON p.IdProducto = pr.IdProducto
    INNER JOIN tblproveedores c ON p.IdProveedor = c.IdProveedor
    INNER JOIN tblempleados e ON p.IdEmpleado = e.IdEmpleado
    ORDER BY p.IdCompra ASC";
$compras = $conn->query($sqlCompras);

$queryProveedor = "SELECT * FROM tblproveedores";
$proveedor = $conn->query($queryProveedor);

$queryProducto = "SELECT * FROM tblproductos";
$producto = $conn->query($queryProducto);

$queryEmpleado = "SELECT * FROM tblempleados WHERE IdRol = 1";
$empleado = $conn->query($queryEmpleado);
?>

    <form action="compras_registrar.php" method="POST">
        <div class="tit-pri">
            <h1>Registros De Las Compras</h1>
                <div>
                    <input type="text" class="light-table-filter" data-table="table-id" placeholder="Buscar...">
                </div>
                <div class="col-auto">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalCompras">Nuevo registro</a>
                </div>
        </div>
    </form>
    <!-- <form action="../../views/usuarios/generar_info_compra.php" method="post" target="_blank">
        <div class="col-auto">
            <button class="btn btn-primary" type="submit" name="generar_informe" value="ventas">Generar informe</button>    
        </div>
    </form> -->

    <table class="table-id">
        <thead>
            <tr>
                <th>Id</th>
                <th>Proveedor</th>
                <th>Producto</th>
                <th>Empleado</th>
                <th>Cantidad Comprada</th>
                <th>Precio Unidad</th>
                <th>Precio Total</th>
                <th>Fecha Compra</th>
                <th>Observación</th>
            </tr>
        </thead>
        <tbody>

        <?php while($rowCompras = $compras->fetch_assoc()) { ?>
            <tr>
                <td><?=$rowCompras['IdCompra']; ?></td>
                <td><?=$rowCompras['NombreProveedor']; ?></td>
                <td><?=$rowCompras['NombreProducto']; ?></td>
                <td><?=$rowCompras['Empleado']; ?></td>
                <td><?=$rowCompras['CantidadComprada']; ?></td>
                <td><?= number_format($rowCompras['PrecioUnidad'], 2); ?></td>
                <td><?= number_format($rowCompras['PrecioTotal'], 2); ?></td>
                <td><?=$rowCompras['FechaCompra']; ?></td>
                <td><?=$rowCompras['Observación']; ?></td>
                <td>
                <a href="#" class="btn btn-sm btn-edi" data-bs-toggle="modal" data-bs-target="#ModalEditarCompras" data-bs-id="<?= $rowCompras['IdCompra']; ?>">Editar</a>
                
                <a href="#" class="btn btn-sm btn-eli" data-bs-toggle="modal" data-bs-target="#ModalEliminarCompras" data-bs-id="<?= $rowCompras['IdCompra']; ?>">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>

    </table>

    <?php include 'ModalRegistrarCompras.php';  ?>
    <?php include 'ModalEliminarCompras.php';  ?>
    <?php $proveedor->data_seek(0); ?>
    <?php $producto->data_seek(0); ?>
    <?php $empleado->data_seek(0); ?>
    <?php include 'ModalEditarCompras.php';  ?>

    <script>
        let ModalEditarCompras = document.getElementById('ModalEditarCompras')
        let ModalEliminarCompras = document.getElementById('ModalEliminarCompras')


        ModalEditarCompras.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdCompra = button.getAttribute('data-bs-id')

            let inputIdCompra = ModalEditarCompras.querySelector('.modal-body #IdCompra')
            let inputIdProveedor = ModalEditarCompras.querySelector('.modal-body #proveedor')
            let inputIdProducto = ModalEditarCompras.querySelector('.modal-body #producto')
            let inputIdEmpleado = ModalEditarCompras.querySelector('.modal-body #Empleado')
            let inputCantidadComprada = ModalEditarCompras.querySelector('.modal-body #CantidadComprada')
            let inputPrecioUnidad = ModalEditarCompras.querySelector('.modal-body #PrecioUnidad')
            let inputPrecioTotal = ModalEditarCompras.querySelector('.modal-body #PrecioTotal')
            let inputFechaCompra = ModalEditarCompras.querySelector('.modal-body #FechaCompra')
            let inputObservacion = ModalEditarCompras.querySelector('.modal-body #Observacion')

            let url = "editarCompras.php"
            let formData = new FormData();
            formData.append('IdCompra', IdCompra);
// Agrega otras líneas para los demás campos del formulario


            fetch(url,{
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {

                inputIdCompra.value = data.IdCompra
                inputIdProveedor.value = data.IdProveedor
                inputIdProducto.value = data.IdProducto
                inputIdEmpleado.value = data.IdEmpleado
                inputCantidadComprada.value = data.CantidadComprada
                inputPrecioUnidad.value = data.PrecioUnidad
                inputPrecioTotal.value = data.PrecioTotal
                inputFechaCompra.value = data.FechaCompra
                inputObservacion.value = data.Observación

            }).catch(err => console.log(err))
        })

        ModalEliminarCompras.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdCompra = button.getAttribute('data-bs-id')
            ModalEliminarCompras.querySelector('.modal-footer #IdCompra').value = IdCompra
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="buscador/buscador.js"></script>
</body>
    <?php require '../../includes/_footer.php' ?>
</html>
