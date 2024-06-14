<link rel="stylesheet" href="../../css/Style.css">
<div class="modal fade" id="ModalProductos" tabindex="-1" aria-labelledby="ModalProductos" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalProductos">Registro de Producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-bodyy">
        <form action="registrarProductos2.php" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="NombreProducto">Producto a vender: </label>
            <select type="text" name="NombreProducto" id="NombreProducto" class="form-select" required>
                <option value="">Seleccionar Producto...</option>
                <?php
                // Conectar a la base de datos
                require '../../includes/conexionBD.php';

                // Consulta para obtener los productos de los proveedores
                $sql = "SELECT DISTINCT ProductoVender FROM tblproveedores WHERE ProductoVender IS NOT NULL";

                // Ejecutar la consulta
                $result = $conn->query($sql);

                // Verificar si hay resultados
                if ($result->num_rows > 0) {
                    // Iterar sobre los resultados y generar las opciones del select
                    while($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["ProductoVender"] . '">' . $row["ProductoVender"] . '</option>';
                    }
                } 
                ?>
            </select>
        </div>


            <div class="mb-3">
                <label for="Descripcion">Descripción: </label>
                <textarea type="text" name="Descripcion" id="Descripcion" rows="3" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="IdProveedor">Proveedor Asociado: </label>
                <input type="text" name="NombreProveedor" id="NombreProveedor" class="form-control" readonly>
                <input type="hidden" name="IdProveedor" id="IdProveedor" class="form-control">
            </div>



            <div class="mb-3">
                <label for="CantidadStock">Cantidad Stock: </label>
                <input type="text" name="CantidadStock" id="CantidadStock" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="IdCategoria">Categoría : </label>
                <select type="text" name="IdCategoria" id="IdCategoria" class="form-select" required>
                <option value="">Seleccionar Categoría...</option>
                <?php while($rowCategoria  = $Categoria ->fetch_assoc()) { ?>
                        <option value="<?php echo $rowCategoria ["IdCategoria"]; ?>"><?= $rowCategoria ["Categoria"] ?></option>
                        <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="IdMarca">Marca: </label>
                <select type="text" name="IdMarca" id="IdMarca" class="form-select" required>
                <option value="">Seleccionar Marca...</option>
                <?php while($rowMarca  = $Marca ->fetch_assoc()) { ?>
                        <option value="<?php echo $rowMarca ["IdMarca"]; ?>"><?= $rowMarca ["Marca"] ?></option>
                        <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="PrecioCompra">Precio Compra: </label>
                <input type="text" name="PrecioCompra" id="PrecioCompra" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="PrecioVenta">Precio Venta: </label>
                <input type="text" name="PrecioVenta" id="PrecioVenta" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="IdMaterial">Material: </label>
                <select type="text" name="IdMaterial" id="IdMaterial" class="form-select" required>
                <option value="">Seleccionar Material...</option>
                <?php while($rowMaterial  = $Material ->fetch_assoc()) { ?>
                        <option value="<?php echo $rowMaterial ["IdMaterial"]; ?>"><?= $rowMaterial ["Material"] ?></option>
                        <?php } ?>
                </select>
            </div>

            <div class="">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
document.getElementById('NombreProducto').addEventListener('change', function() {
    var productoSeleccionado = this.value;
    var url = 'obtenerProveedor.php'; // Ruta correcta para el archivo PHP que obtiene el proveedor asociado
    var formData = new FormData();
    formData.append('producto', productoSeleccionado);

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('NombreProveedor').value = data.NombreProveedor; // Actualizar el nombre del proveedor
        document.getElementById('IdProveedor').value = data.IdProveedor; // Actualizar el Id del proveedor (puede ser opcional)
    })
    .catch(error => console.error('Error:', error));
});

</script>