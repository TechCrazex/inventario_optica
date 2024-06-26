<div class="modal fade" id="ModalEditarProveedores" tabindex="-1" aria-labelledby="ModalEditarProveedores" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalEditarProveedores">Editar Proveedores</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="ActualizarProveedor.php" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="IdProveedor" id="IdProveedor">

            <!--<div class="mb-3">-->
            <!--    <label for="Nit">Nit: </label>-->
            <!--    <input type="text" name="Nit" id="Nit" class="form-control" required>-->
            <!--</div>-->

            <div class="mb-3">
                <label for="NombreEmpresa">Nombre Empresa: </label>
                <input type="text" name="NombreEmpresa" id="NombreEmpresa" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="NombreProveedor">Nombre Proveedor: </label>
                <input type="text" name="NombreProveedor" id="NombreProveedor" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="ProductoVender">Producto Vender: </label>
                <input type="text" name="ProductoVender" id="ProductoVender" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="Direccion">Dirección: </label>
                <input type="text" name="Direccion" id="Direccion" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="Telefono">Teléfono: </label>
                <input type="text" name="Telefono" id="Telefono" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="Correo">Correo: </label>
                <input type="text" name="Correo" id="Correo" class="form-control" required>
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
