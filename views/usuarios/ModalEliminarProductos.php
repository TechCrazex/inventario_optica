<div class="modal fade" id="ModalEliminarProductos" tabindex="-1" aria-labelledby="ModalEliminarProductos" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalEliminarProductos">Aviso</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Desea eliminar el registro?
      </div>

    <div class="modal-footer">
        <form action="EliminarProducto.php" method="POST">
            <input type="hidden" name="IdProducto" id="IdProducto">
            
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Eliminar</button>
        </form>
    </div>
    </div>
  </div>
</div>