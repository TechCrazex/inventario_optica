<div class="modal fade" id="ModalClientes" tabindex="-1" aria-labelledby="ModalClientes" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalClientes">Registrar Clientes</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="registrarCliente2.php" method="POST" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label for="Cedula">Cédula: </label>
                <input type="text" name="Cedula" id="Cedula" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="Nombres">Nombres: </label>
                <input type="text" name="Nombres" id="Nombres" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="Apellidos">Apellidos: </label>
                <input type="text" name="Apellidos" id="Apellidos" class="form-control" required>
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