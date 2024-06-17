<div class="modal fade" id="ModalEditarCompras" tabindex="-1" aria-labelledby="ModalEditarCompras" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalEditarCompras">Editar Compras</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="ActualizarCompras.php" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="IdCompra" id="IdCompra">


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
                <label for="producto">Nombre Producto: </label>
                <select type="text" name="producto" id="producto" class="form-select" required>
                <option value="">Seleccionar Producto...</option>
                    <?php while($rowProducto = $producto->fetch_assoc()) { ?>
                        <option value="<?php echo $rowProducto["IdProducto"]; ?>"><?= $rowProducto["NombreProducto"] ?></option>
                        <?php } ?>
                </select>
            </div>
            
            <div class="mb-3">
    <label for="Empleado">Empleado: </label>
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
                <input type="text" name="PrecioUnidad" id="PrecioUnidad" class="form-control" required oninput="calcularPrecioTotalCompra()">
            </div>

            <input type="hidden" id="PrecioTotal" name="PrecioTotal">

            <div class="mb-3">
                <label for="FechaCompra">Fecha Compra: </label>
                <input type="text" name="FechaCompra" id="FechaCompra" class="form-control" required>
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

        // Escuchar eventos de cambio en los campos de cantidad vendida y precio unidad
  inputCantidadComprada.addEventListener('input', calcularPrecioTotal);
  inputPrecioUnidad.addEventListener('input', calcularPrecioTotal);

  // Función para calcular el precio total
    var CantidadComprada = parseFloat(inputCantidadComprada.value) || 0;
    var PrecioUnidad = parseFloat(inputPrecioUnidad.value) || 0;

    // Calcular el precio total multiplicando cantidad vendida por precio unidad
    var PrecioTotal = CantidadComprada * PrecioUnidad;

    // Actualizar el valor del campo de precio total
    inputPrecioTotal.value = PrecioTotal.toFixed(2); // Redondear a 2 decimales
  }
    

    document.getElementById('producto').addEventListener('change', function() {
        var productoSeleccionado = this.value;
        var url = 'editarCompras3.php'; // Ruta al script PHP para obtener el precio unitario
        var formData = new FormData();
        formData.append('IdProducto', productoSeleccionado);

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('PrecioUnidad').value = data.PrecioUnidad;
        })
        .catch(error => console.error('Error:', error));
    });
</script>
