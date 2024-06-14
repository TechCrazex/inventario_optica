<div class="modal fade" id="ModalMateriales" tabindex="-1" aria-labelledby="ModalMateriales" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalMateriales">Registrar Material</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="registrarMateriales2.php" method="POST" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label for="Material">Material: </label>
                <input type="text" name="Material" id="Material" class="form-control" required>
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