<div class="modal fade" id="ModalHistorias" tabindex="-1" aria-labelledby="ModalHistorias" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalHistorias">Registrar La Historia Clinica</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-bodyy">
        <form action="registrarHistorias2.php" method="POST" enctype="multipart/form-data">
        
          
          <div class="mb-3">
            <label for="cliente">Cliente: </label>
            <select type="text" name="Cliente" id="Cliente" class="form-select" required>
              <option value="">Seleccionar Cliente...</option>
              <?php while($rowCliente = $cliente->fetch_assoc()) { ?>
                <option value="<?php echo $rowCliente["IdCliente"]; ?>"><?= $rowCliente["Nombres"] ?> <?= $rowCliente["Apellidos"] ?></option>
                <?php } ?>
              </select>
            </div>
            
            <div class="mb-3">
                <label for="Fecha">Fecha: </label>
                <input type="date" name="Fecha" id="Fecha" class="form-control" max="<?= $fechaActual; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="Antecedentes">Antecedentes: </label>
                <input type="text" name="Antecedentes" id="Antecedentes" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="Descripcion">Descripción: </label>
                <textarea type="text" name="Descripcion" id="Descripcion" rows="3" class="form-control" required></textarea>
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
