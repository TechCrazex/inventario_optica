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
                <label for="Descripcion">Descripcion: </label>
                <textarea type="text" name="Descripcion" id="Descripcion" rows="3" class="form-control" required></textarea>
            </div>

<!--             <div class="mb-3">
                <label for="IdProveedor">Proveedor Asociado: </label>
                <input type="text" id="NombreProveedor" class="form-control" readonly>
                <select type="hidden" name="IdProveedor" id="IdProveedor">
            </div> -->
            <div class="mb-3">
              <label for="IdProveedor">Proveedor Asociado: </label>
              <select name="IdProveedor" id="IdProveedor" class="form-select" required>
              <option value="">Seleccionar Proveedor...</option>
              <?php
              // Conectar a la base de datos
              require '../../includes/conexionBD.php';

              // Consulta para obtener los proveedores
              $sql = "SELECT DISTINCT IdProveedor, NombreProveedor FROM tblproveedores WHERE NombreProveedor IS NOT NULL";

              // Ejecutar la consulta
              $result = $conn->query($sql);

               // Verificar si hay resultados
              if ($result->num_rows > 0) {
                // Iterar sobre los resultados y generar las opciones del select
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
                <label for="IdCategoria">Categoria: </label>
                <select type="text" name="IdCategoria" id="IdCategoria" class="form-select" required>
                <option value="">Seleccionar Categoria ...</option>
                <?php while($rowCategoria  = $Categoria ->fetch_assoc()) { ?>
                        <option value="<?php echo $rowCategoria ["IdCategoria"]; ?>"><?= $rowCategoria ["Categoria"] ?></option>
                        <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="IdMarca">Marca: </label>
                <select type="text" name="IdMarca" id="IdMarca" class="form-select" required>
                <option value="">Seleccionar Marca ...</option>
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
                <option value="">Seleccionar Material ...</option>
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
