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

$sqlVentas = "SELECT p.*, pr.NombreProducto, cr.Categoria, CONCAT(c.Nombres, ' ', c.Apellidos) as Cliente, CONCAT(e.Nombres, ' ', e.Apellidos) as Empleado
    FROM tblventas p 
    INNER JOIN tblproductos pr ON p.IdProducto = pr.IdProducto
    INNER JOIN tblcategoriasproductos cr ON p.IdCategoria = cr.IdCategoria
    INNER JOIN tblclientes c ON p.IdCliente = c.IdCliente
    INNER JOIN tblempleados e ON p.IdEmpleado = e.IdEmpleado
    ORDER BY p.IdVenta ASC";
$ventas = $conn->query($sqlVentas);

$queryProducto = "SELECT * FROM tblproductos";
$producto = $conn->query($queryProducto);

$queryCliente = "SELECT * FROM tblclientes";
$cliente = $conn->query($queryCliente);

$queryCategorias = "SELECT * FROM tblcategoriasproductos";
$categorias = $conn->query($queryCategorias);

$queryEmpleado = "SELECT * FROM tblempleados";
$empleado = $conn->query($queryEmpleado);
?>

    <form action="buscar_venta.php" method="POST">
        <div class="tit-pri">
            <h1>Registros De Las Ventas</h1>
                
                <div class="col-auto">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalVentas">Nuevo registro</a>
                </div>
        </div>
    </form>
    <form action="generar_factura.php" method="post" target="_blank">
    <div class="tit-pri">
            <div>
                <input type="text" class="light-table-filter" data-table="table-id" placeholder="Buscar..." name="IdVenta">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit" name="generar_informe" value="compras">Generar factura</button>
            </div>
        </div>
    </form>

    <table class="table-id">
        <thead>
            <tr>
                <th>Id</th>
                <!--<th>Número Venta</th>-->
                <th>Cliente</th>
                <th>Empleado</th>
                <th>Producto</th>
                <th>Cantidad Vendida</th>
                <th>Precio Unidad</th>
                <th>Precio Total</th>
                <th>Fecha Venta</th>
                <th>Observación</th>
                <th>Categoría</th>
            </tr>
        </thead>
        <tbody>

        <?php while($rowVentas = $ventas->fetch_assoc()) { ?>
            <tr>
                <td><?=$rowVentas['IdVenta']; ?></td>
                <td><?=$rowVentas['Cliente']; ?></td>
                <td><?=$rowVentas['Empleado']; ?></td>
                <td><?=$rowVentas['NombreProducto']; ?></td>
                <td><?=$rowVentas['CantidadVendida']; ?></td>
                <td><?= number_format($rowVentas['PrecioUnidad'], 2); ?></td>
                <td><?= number_format($rowVentas['PrecioTotal'], 2); ?></td>
                <td><?=$rowVentas['FechaVenta']; ?></td>
                <td><?=$rowVentas['Observación']; ?></td>
                <td><?=$rowVentas['Categoria']; ?></td>
                <td>
                <a href="#" class="btn btn-sm btn-edi" data-bs-toggle="modal" data-bs-target="#ModalEditarVentas" data-bs-id="<?= $rowVentas['IdVenta']; ?>">Editar</a>
                
                <a href="#" class="btn btn-sm btn-eli" data-bs-toggle="modal" data-bs-target="#ModalEliminarVentas" data-bs-id="<?= $rowVentas['IdVenta']; ?>">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>

    </table>

    

    <?php include 'ModalRegistrarVentas.php';  ?>
    <?php include 'ModalEliminarVentas.php';  ?>
    <?php $producto->data_seek(0); ?>
    <?php $cliente->data_seek(0); ?>
    <?php $categorias->data_seek(0); ?>
    <?php $empleado->data_seek(0); ?>
    <?php include 'ModalEditarVentas.php';  ?>

    <script>
        let ModalEditarVentas = document.getElementById('ModalEditarVentas')
        let ModalEliminarVentas = document.getElementById('ModalEliminarVentas')


        ModalEditarVentas.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdVenta = button.getAttribute('data-bs-id')

            let inputIdVenta = ModalEditarVentas.querySelector('.modal-body #IdVenta')
            // let inputNumeroVenta = ModalEditarVentas.querySelector('.modal-body #NumeroVenta')
            let inputIdCliente = ModalEditarVentas.querySelector('.modal-body #cliente')
            let inputIdEmpleado = ModalEditarVentas.querySelector('.modal-body #empleado')
            let inputIdProducto = ModalEditarVentas.querySelector('.modal-body #producto')
            let inputCantidadVendida = ModalEditarVentas.querySelector('.modal-body #CantidadVendida')
            let inputPrecioUnidad = ModalEditarVentas.querySelector('.modal-body #PrecioUnidad')
            let inputPrecioTotal = ModalEditarVentas.querySelector('.modal-body #PrecioTotal')
            let inputFechaVenta = ModalEditarVentas.querySelector('.modal-body #FechaVenta')
            let inputObservacion = ModalEditarVentas.querySelector('.modal-body #Observacion')
            let inputCategoria = ModalEditarVentas.querySelector('.modal-body #Categoria')

            let url = "editarVentas.php"
            let formData = new FormData();
            formData.append('IdVenta', IdVenta);
// Agrega otras líneas para los demás campos del formulario


            fetch(url,{
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {

                inputIdVenta.value = data.IdVenta
                // inputNumeroVenta.value = data.NumeroVenta
                inputIdCliente.value = data.IdCliente
                inputIdEmpleado.value = data.IdEmpleado
                inputIdProducto.value = data.IdProducto
                inputCantidadVendida.value = data.CantidadVendida
                inputPrecioUnidad.value = data.PrecioUnidad
                inputPrecioTotal.value = data.PrecioTotal
                inputFechaVenta.value = data.FechaVenta
                inputObservacion.value = data.Observación
                inputCategoria.value = data.IdCategoria

            }).catch(err => console.log(err))

        })



        ModalEliminarVentas.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdVenta = button.getAttribute('data-bs-id')
            ModalEliminarVentas.querySelector('.modal-footer #IdVenta').value = IdVenta
        })

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../usuarios/buscador/buscador2.js"></script>
</body>
    <?php require '../../includes/_footer.php' ?>
</html>
