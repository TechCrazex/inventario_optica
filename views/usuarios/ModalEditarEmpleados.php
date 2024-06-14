<div class="modal fade" id="ModalEditarEmpleados" tabindex="-1" aria-labelledby="ModalEditarEmpleados" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalEditarEmpleados">Editar Empleados</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="ActualizarEmpleado.php" method="POST">
            
            <input type="hidden" name="IdEmpleado" id="IdEmpleado">

            <div class="mb-3">
              <label for="Nombres">Nombres: </label>
              <input type="text" name="Nombres" id="Nombres" class="form-control" required>
            </div>
            
            <div class="mb-3">
              <label for="Apellidos">Apellidos: </label>
              <input type="text" name="Apellidos" id="Apellidos" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="Cedula">Cédula: </label>
                <input type="text" name="Cedula" id="Cedula" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="Correo">Correo: </label>
                <input type="text" name="Correo" id="Correo" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="Contraseña">Contraseña: </label>
                <input type="text" name="Contraseña" id="Contraseña" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="Rol">Rol</label>
                <select type="text" name="Rol" id="Rol" class="form-select" required>
                <option value="">Seleccionar Rol...</option>
                <?php while($rowRol = $roles->fetch_assoc()) { ?>
                        <option value="<?php echo $rowRol["IdRol"]; ?>"><?= $rowRol["Rol"] ?></option>
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