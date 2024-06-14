<div class="modal fade" id="ModalMarcas" tabindex="-1" aria-labelledby="ModalMarcas" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalMarcas">Registrar Marcas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="registrarMarcas2.php" method="POST" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label for="Marca">Marca: </label>
                <input type="text" name="Marca" id="Marca" class="form-control" required>
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