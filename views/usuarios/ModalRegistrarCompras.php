<div class="modal fade" id="ModalCompras" tabindex="-1" aria-labelledby="ModalCompras" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalCompras">Registrar Compras</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-bodyy">
        <form action="registrarCompras2.php" method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="proveedor">Proveedor: </label>
                <select type="text" name="proveedor" id="proveedor" class="form-select" required>
                <option value="">Seleccionar Proveedor...</option>
                <?php while($rowProveedor = $proveedor->fetch_assoc()) { ?>
                        <option value="<?php echo $rowProveedor["IdProveedor"]; ?>"><?= $rowProveedor["NombreProveedor"] ?></option>
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
                <label for="Empleado">Administrador: </label>
                <select type="text" name="Empleado" id="Empleado" class="form-select" required>
                <option value="">Seleccionar Empleado...</option>
                <?php 
                    // Consulta para obtener los empleados con rol de administrador
                    $sqlEmpleados = "SELECT IdEmpleado, Nombres, Apellidos FROM tblempleados WHERE IdRol = '1'";
                    $resultEmpleados = $conn->query($sqlEmpleados);
                    
                    if ($resultEmpleados->num_rows > 0) {
                    while ($rowEmpleado = $resultEmpleados->fetch_assoc()) { ?>

                <option value="<?php echo $rowEmpleado["IdEmpleado"]; ?>">
                    <?php echo $rowEmpleado["Nombres"] ?> <?= $rowEmpleado["Apellidos"]; ?>
                </option>
                <?php } ?>
                <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="CantidadComprada">Cantidad Comprada: </label>
                <input type="text" name="CantidadComprada" id="CantidadComprada" class="form-control" required oninput="calcularPrecioTotalCompra()">
            </div>

            <div class="mb-3">
                <label for="PrecioUnidad">Precio Unidad: </label>
                <input type="text" name="PrecioUnidad" id="PrecioUnidad" class="form-control" readonly required oninput="calcularPrecioTotalCompra()">
            </div>

            <!-- Campo PrecioTotal oculto -->
            <input type="hidden" id="PrecioTotal" name="PrecioTotal">

            <div class="mb-3">
                <label for="FechaCompra">Fecha Compra: </label>
                <input type="date" name="FechaCompra" id="FechaCompra" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="Observacion">Observación: </label>
                <input type="text" name="Observacion" id="Observacion" class="form-control" required>
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
    function calcularPrecioTotalCompra() {
        var CantidadComprada = document.getElementById('CantidadComprada').value;
        var PrecioUnidad = document.getElementById('PrecioUnidad').value;
        var PrecioTotal = CantidadComprada * PrecioUnidad;

        // Actualiza el valor del campo PrecioTotal
        document.getElementById('PrecioTotal').value = PrecioTotal;
    }

    document.getElementById('producto').addEventListener('change', function() {
    var productoSeleccionado = this.value;
    var url = 'Precios/registrarCompras3.php'; // Cambia esto por la ruta correcta de tu archivo PHP para obtener el precio de venta
    var formData = new FormData();
    formData.append('IdProducto', productoSeleccionado);

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('PrecioUnidad').value = data.PrecioCompra;
    })
    .catch(error => console.error('Error:', error));
});
</script>
