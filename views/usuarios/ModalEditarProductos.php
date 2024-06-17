<div class="modal fade" id="ModalEditarProductos" tabindex="-1" aria-labelledby="ModalEditarProductos" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalEditarProductos">Editar Productos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="ActualizarProducto.php" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="IdProducto" id="IdProducto">

            <div class="mb-3">
                <label for="NombreProducto">Nombre Del Producto: </label>
                <select name="NombreProducto" id="NombreProducto" class="form-select" required>
                    <option value="">Seleccionar Producto...</option>
                    <?php
                    require '../../includes/conexionBD.php';
                    $sql = "SELECT DISTINCT ProductoVender FROM tblproveedores WHERE ProductoVender IS NOT NULL";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["ProductoVender"] . '">' . $row["ProductoVender"] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="Descripcion">Descripción: </label>
                <textarea name="Descripcion" id="Descripcion" rows="3" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="IdProveedor">Proveedor Asociado: </label>
                <select name="IdProveedor" id="IdProveedor" class="form-select" required>
                <option value="">Seleccionar Proveedor...</option>
                <?php
                require '../../includes/conexionBD.php';
                $sql = "SELECT DISTINCT IdProveedor, NombreProveedor FROM tblproveedores WHERE NombreProveedor IS NOT NULL";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["IdProveedor"] . '">' . $row["NombreProveedor"] . '</option>';
                    }
                }
                ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="CantidadStock">Cantidad Stock: </label>
                <input type="text" name="CantidadStock" id="CantidadStock" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="IdCategoria">Categoría: </label>
                <select name="IdCategoria" id="IdCategoria" class="form-select" required>
                <option value="">Seleccionar Categoría...</option>
                <?php while($rowCategoria = $Categoria->fetch_assoc()) { ?>
                    <option value="<?php echo $rowCategoria["IdCategoria"]; ?>"><?= $rowCategoria["Categoria"] ?></option>
                <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="IdMarca">Marca: </label>
                <select name="IdMarca" id="IdMarca" class="form-select" required>
                <option value="">Seleccionar Marca...</option>
                <?php while($rowMarca = $Marca->fetch_assoc()) { ?>
                    <option value="<?php echo $rowMarca["IdMarca"]; ?>"><?= $rowMarca["Marca"] ?></option>
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
                <select name="IdMaterial" id="IdMaterial" class="form-select" required>
                <option value="">Seleccionar Material...</option>
                <?php while($rowMaterial = $Material->fetch_assoc()) { ?>
                    <option value="<?php echo $rowMaterial["IdMaterial"]; ?>"><?= $rowMaterial["Material"] ?></option>
                <?php } ?>
                </select>
            </div>

            <div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
