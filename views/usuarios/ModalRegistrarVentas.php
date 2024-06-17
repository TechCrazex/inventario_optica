<div class="modal fade" id="ModalVentas" tabindex="-1" aria-labelledby="ModalVentas" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalVentas">Registrar Ventas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-bodyy">
        <form action="registrarVentas2.php" method="POST" enctype="multipart/form-data">
        

            <div class="mb-3">
                <label for="cliente">Cliente: </label>
                <select type="text" name="cliente" id="cliente" class="form-select" required>
                <option value="">Seleccionar Cliente...</option>
                <?php while($rowCliente = $cliente->fetch_assoc()) { ?>
                        <option value="<?php echo $rowCliente["IdCliente"]; ?>"><?= $rowCliente["Nombres"] ?> <?= $rowCliente["Apellidos"] ?></option>
                        <?php } ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="empleado">Empleado: </label>
                <select type="text" name="empleado" id="empleado" class="form-select" required>
                <option value="">Seleccionar Empleado...</option>
                <?php while($rowEmpleado = $empleado->fetch_assoc()) { ?>
                        <option value="<?php echo $rowEmpleado["IdEmpleado"]; ?>"><?= $rowEmpleado["Nombres"] ?> <?= $rowEmpleado["Apellidos"] ?></option>
                        <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="producto">Producto: </label>
                <select type="text" name="producto" id="producto" class="form-select" required>
                <option value="">Seleccionar Producto...</option>
                <?php while($rowProducto = $producto->fetch_assoc()) { ?>
                        <option value="<?php echo $rowProducto["IdProducto"]; ?>"><?= $rowProducto["NombreProducto"] ?></option>
                        <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="CantidadVendida">Cantidad Vendida: </label>
                <input type="text" name="CantidadVendida" id="CantidadVendida" class="form-control" required oninput="calcularPrecioTotal()">
            </div>

            <div class="mb-3">
                <label for="PrecioUnidad">Precio Unidad: </label>
                <input type="text" name="PrecioUnidad" id="PrecioUnidad" class="form-control" readonly required oninput="calcularPrecioTotal()">
            </div>

            <input type="hidden" id="PrecioTotal" name="PrecioTotal">

            <div class="mb-3">
<!--                 <label for="FechaVenta">Fecha Venta: </label>
                <input type="date" name="FechaVenta" id="FechaVenta" class="form-control" required> -->
              <form>
                 <label for="FechaVenta">Fecha de Venta:</label>
                  <input type="date" name="FechaVenta" id="FechaVenta" class="form-control" required>
               </form>
              
            </div>

            <div class="mb-3">
                <label for="Observacion">Observación: </label>
                <input type="text" name="Observacion" id="Observacion" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="Categoria">Categoría: </label>
                <select type="text" name="Categoria" id="Categoria" class="form-select" required>
                <option value="">Seleccionar Categoría...</option>
                <?php while($rowCategorias = $categorias->fetch_assoc()) { ?>
                        <option value="<?php echo $rowCategorias["IdCategoria"]; ?>"><?= $rowCategorias["Categoria"] ?></option>
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

<script>
  function calcularPrecioTotal() {
    var CantidadVendida = document.getElementById('CantidadVendida').value;
    var PrecioUnidad = document.getElementById('PrecioUnidad').value;
    var PrecioTotal = CantidadVendida * PrecioUnidad;

    // Actualiza el valor del input PrecioTotal
    document.getElementById('PrecioTotal').value = PrecioTotal;
  }
  
  document.getElementById('producto').addEventListener('change', function() {
    var productoSeleccionado = this.value;
    var url = 'PrecioVenta/registrarVentas3.php'; // Cambia esto por la ruta correcta de tu archivo PHP para obtener el precio de venta
    var formData = new FormData();
    formData.append('IdProducto', productoSeleccionado);

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('PrecioUnidad').value = data.PrecioVenta;
    })
    .catch(error => console.error('Error:', error));
});
</script>

<script>
    // Obtener el elemento de fecha de venta
    const fechaVentaInput = document.getElementById('FechaVenta');

    // Obtener la fecha actual en formato YYYY-MM-DD
    const fechaActual = new Date();

    // Convertir la fecha actual a las 00:00:00 horas para incluir todo el día actual
    fechaActual.setHours(0, 0, 0, 0);

    // Formatear la fecha actual como YYYY-MM-DD
    const fechaMinima = fechaActual.toISOString().split('T')[0];

    // Establecer el atributo max en el input de fecha para limitar fechas futuras
    fechaVentaInput.setAttribute('max', fechaMinima);
</script>
