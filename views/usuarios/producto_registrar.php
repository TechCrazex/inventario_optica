
<!DOCTYPE html>
<html lang="en">
    <?php require '../../includes/_db.php' ?>
    <?php require '../../includes/_header.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/Style.css">
    <body>
    <?php
    include ('../../includes/conexionBD.php'); 
    
    $sqlProductos = "SELECT p.*, pr.NombreProveedor, c.Categoria, m.Marca, mp.Material
    FROM tblproductos p 
    INNER JOIN tblproveedores pr ON p.IdProveedor = pr.IdProveedor
    INNER JOIN tblcategoriasproductos c ON p.IdCategoria = c.IdCategoria
    INNER JOIN tblmarcasproductos m ON p.IdMarca = m.IdMarca
    INNER JOIN tblmaterialesproductos mp ON p.IdMaterial = mp.IdMaterial
    ORDER BY p.IdProducto ASC";
    $Productos = $conn->query($sqlProductos);

    $queryProveedores = "SELECT * FROM tblproveedores";
    $Proveedor = $conn->query($queryProveedores);
    
    $queryCategoria = "SELECT * FROM tblcategoriasproductos";
    $Categoria = $conn->query($queryCategoria);
    
    $queryMarca = "SELECT * FROM tblmarcasproductos";
    $Marca = $conn->query($queryMarca);
    
    $queryMaterial = "SELECT * FROM tblmaterialesproductos";
    $Material = $conn->query($queryMaterial);
    ?>

    <form action="producto_registrar.php" method="POST">
        <div class="tit-pri">
            <h1>Registro De Los Productos</h1>
            <div>
                <input type="text" class="light-table-filter" data-table="table-id" placeholder="Buscar...">
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalProductos">Nuevo registro</a>
            </div>
        </div>
    </form>

    <table class="table-id">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre Producto</th>
                <th>Descripción</th>
                <th>Proveedor</th>
                <th>Cantidad Stock</th>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                <th>Material</th>
            </tr>
        </thead>
        <tbody>

        <?php while($rowProductos = $Productos->fetch_assoc()) { ?>
            <tr>
                <td><?=$rowProductos['IdProducto']; ?></td>
                <td><?=$rowProductos['NombreProducto']; ?></td>
                <td><?=$rowProductos['Descripcion']; ?></td>
                <td><?=$rowProductos['NombreProveedor']; ?></td>
                <td><?=$rowProductos['CantidadStock']; ?></td>
                <td><?=$rowProductos['Categoria']; ?></td>
                <td><?=$rowProductos['Marca']; ?></td>
                <td><?=$rowProductos['PrecioCompra']; ?></td>
                <td><?=$rowProductos['PrecioVenta']; ?></td>
                <td><?=$rowProductos['Material']; ?></td>
                <td>
                <a href="#" class="btn btn-sm btn-edi" data-bs-toggle="modal" data-bs-target="#ModalEditarProductos" data-bs-id="<?= $rowProductos['IdProducto']; ?>">Editar</a>

                <a href="#" class="btn btn-sm btn-eli" data-bs-toggle="modal" data-bs-target="#ModalEliminarProductos" data-bs-id="<?= $rowProductos['IdProducto']; ?>">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>

    </table>


    <?php include 'ModalRegistrarProductos.php'; ?>
    <?php include 'ModalEliminarProductos.php'; ?>
    <?php $Proveedor->data_seek(0); ?>
    <?php $Categoria->data_seek(0); ?>
    <?php $Marca->data_seek(0); ?>
    <?php $Material->data_seek(0); ?>
    <?php include 'ModalEditarProductos.php'; ?>

<script>
let ModalEditarProductos = document.getElementById('ModalEditarProductos');

ModalEditarProductos.addEventListener('shown.bs.modal', event => {
    let button = event.relatedTarget;
    let IdProducto = button.getAttribute('data-bs-id');

    let inputIdProducto = ModalEditarProductos.querySelector('.modal-body #IdProducto');
    let inputNombreProducto = ModalEditarProductos.querySelector('.modal-body #NombreProducto');
    let inputDescripcion = ModalEditarProductos.querySelector('.modal-body #Descripcion');
    let inputIdProveedor = ModalEditarProductos.querySelector('.modal-body #IdProveedor');
    let inputCantidadStock = ModalEditarProductos.querySelector('.modal-body #CantidadStock');
    let inputIdCategoria = ModalEditarProductos.querySelector('.modal-body #IdCategoria');
    let inputIdMarca = ModalEditarProductos.querySelector('.modal-body #IdMarca');
    let inputPrecioCompra = ModalEditarProductos.querySelector('.modal-body #PrecioCompra');
    let inputPrecioVenta = ModalEditarProductos.querySelector('.modal-body #PrecioVenta');
    let inputIdMaterial = ModalEditarProductos.querySelector('.modal-body #IdMaterial');

    let url = "editarProductos.php";
    let formData = new FormData();
    formData.append('IdProducto', IdProducto);

    fetch(url, {
        method: "POST",
        body: formData
    }).then(response => response.json())
    .then(data => {
        console.log(data); // Añadir para depuración
        if (data) {
            inputIdProducto.value = data.IdProducto || '';
            inputNombreProducto.value = data.NombreProducto || '';
            inputDescripcion.value = data.Descripcion || '';
            inputIdProveedor.value = data.IdProveedor || '';
            inputCantidadStock.value = data.CantidadStock || '';
            inputIdCategoria.value = data.IdCategoria || '';
            inputIdMarca.value = data.IdMarca || '';
            inputPrecioCompra.value = data.PrecioCompra || '';
            inputPrecioVenta.value = data.PrecioVenta || '';
            inputIdMaterial.value = data.IdMaterial || '';
        } else {
            console.error('Datos no encontrados');
        }
    }).catch(err => console.log(err));
});

let ModalEliminarProductos = document.getElementById('ModalEliminarProductos');
ModalEliminarProductos.addEventListener('shown.bs.modal', event => {
    let button = event.relatedTarget;
    let IdProducto = button.getAttribute('data-bs-id');
    ModalEliminarProductos.querySelector('.modal-footer #IdProducto').value = IdProducto;
});
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="buscador/buscador.js"></script>
</body>

    <?php require '../../includes/_footer.php'; ?>
</html>
