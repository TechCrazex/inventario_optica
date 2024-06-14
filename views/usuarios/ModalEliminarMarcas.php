<div class="modal fade" id="ModalEliminarMarcas" tabindex="-1" aria-labelledby="ModalEliminarMarcas" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalEliminarMarcas">Aviso</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Desea eliminar el registro?
      </div>

    <div class="modal-footer">
        <form action="EliminarMarcas.php" method="POST">
            <input type="hidden" name="IdMarca" id="IdMarca">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Eliminar</button>
        </form>
    </div>
    </div>
  </div>
</div>