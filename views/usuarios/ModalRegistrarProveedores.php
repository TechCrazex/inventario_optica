<link rel="stylesheet" href="../../css/Style.css">
<div class="modal fade" id="ModalProveedores" tabindex="-1" aria-labelledby="ModalProveedores" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalProveedores">Registro Proveedor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-bodyy">
        <form action="registrarProveedor2.php" method="POST" enctype="multipart/form-data">

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
