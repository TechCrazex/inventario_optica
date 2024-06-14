<?php
session_start();
if (!isset($_SESSION['Correo'])) {
    header('Location: ../../includes/_sesion/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="../../css/Style.css">


<body>
    <?php 
    include ('../../includes/conexionBD.php'); 
    
    $sqlProveedores = "SELECT * FROM tblproveedores ORDER BY IdProveedor ASC";
    $proveedores = $conn->query($sqlProveedores);

    ?>

    <form action="registrarProveedor.php" method="POST">
        <div class="tit-pri">
            <h1>Registros De los Proveedores</h1>
                <div>
                    <input type="text" class="light-table-filter" data-table="table-id" placeholder="Buscar...">
                </div>
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalProveedores">Nuevo registro</a>
            </div>
        </div>    
    </form>

    <form action="../../views/usuarios/generar_info_proveedores.php" method="post" target="_blank">
        <div class="col-auto">
        <button class="btn btn-primary" type="submit" name="generar_informe" value="proveedores">Generar informe</button>
        </div>
    </form>

    <table class="table-id">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nit</th>
                <th>Nombre Empresa</th>
                <th>Nombre Proveedor</th>
                <th>Producto Vender</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Correo</th>
            </tr>
        </thead>

        <tbody>

        <?php while($rowProveedores = $proveedores->fetch_assoc()) { ?>
            <tr>
                <td><?=$rowProveedores['IdProveedor']; ?></td>
                <td><?=$rowProveedores['Nit']; ?></td>
                <td><?=$rowProveedores['NombreEmpresa']; ?></td>
                <td><?=$rowProveedores['NombreProveedor']; ?></td>
                <td><?=$rowProveedores['ProductoVender']; ?></td>
                <td><?=$rowProveedores['Direccion']; ?></td>
                <td><?=$rowProveedores['Telefono']; ?></td>
                <td><?=$rowProveedores['Correo']; ?></td>
                <td>
                <a href="#" class="btn btn-sm btn-edi" data-bs-toggle="modal" data-bs-target="#ModalEditarProveedores" data-bs-id="<?= $rowProveedores['IdProveedor']; ?>">Editar</a>
                
                <a href="#" class="btn btn-sm btn-eli" data-bs-toggle="modal" data-bs-target="#ModalEliminarProveedor" data-bs-id="<?= $rowProveedores['IdProveedor']; ?>">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>

    </table>

    <?php include 'ModalRegistrarProveedores.php'; ?>
    <?php include 'ModalEliminarProveedor.php'; ?>
    <?php include 'ModalEditarProveedores.php'; ?>

    <script>
        let ModalEditarProveedores = document.getElementById('ModalEditarProveedores')
        let ModalEliminarProveedor = document.getElementById('ModalEliminarProveedor')

        ModalEditarProveedores.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdProveedor = button.getAttribute('data-bs-id')

            let inputIdProveedor = ModalEditarProveedores.querySelector('.modal-body #IdProveedor')
            let inputNit = ModalEditarProveedores.querySelector('.modal-body #Nit')
            let inputNombreEmpresa = ModalEditarProveedores.querySelector('.modal-body #NombreEmpresa')
            let inputNombreProveedor = ModalEditarProveedores.querySelector('.modal-body #NombreProveedor')
            let inputProductoVender = ModalEditarProveedores.querySelector('.modal-body #ProductoVender')
            let inputDireccion = ModalEditarProveedores.querySelector('.modal-body #Direccion')
            let inputTelefono = ModalEditarProveedores.querySelector('.modal-body #Telefono')
            let inputMarca = ModalEditarProveedores.querySelector('.modal-body #Marca')
            let inputCorreo = ModalEditarProveedores.querySelector('.modal-body #Correo')

            let url = "editarProveedores.php"
            let formData = new FormData();
            formData.append('IdProveedor', IdProveedor);
// Agrega otras líneas para los demás campos del formulario


            fetch(url,{
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {

                inputIdProveedor.value = data.IdProveedor
                inputNit.value = data.Nit
                inputNombreEmpresa.value = data.NombreEmpresa
                inputNombreProveedor.value = data.NombreProveedor
                inputProductoVender.value = data.ProductoVender
                inputDireccion.value = data.Direccion
                inputTelefono.value = data.Telefono
                inputCorreo.value = data.Correo

            }).catch(err => console.log(err))

        })

        ModalEliminarProveedor.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdProveedor = button.getAttribute('data-bs-id')
            ModalEliminarProveedor.querySelector('.modal-footeer #IdProveedor').value = IdProveedor
        })
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="buscador/buscador.js"></script>
</body>
</html>