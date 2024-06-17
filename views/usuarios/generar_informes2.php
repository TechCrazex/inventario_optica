<?php
session_start();
if (!isset($_SESSION['Correo'])) {
    header('Location: ../../includes/_sesion/login.php');
    exit();
}
?>
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header2.php' ?>
<?php 
date_default_timezone_set('America/Bogota');
$fechaActual = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Informes</title>
    <link rel="stylesheet" href="../../css/Style.css"> 
</head>
<body>
<div class="tit-prim">
    <h1>Generar Informes</h1>
</div>
<div class="col-auto">
    <form id="formGenerarInforme" method="post" target="_blank">
        <div class="mb-3">
            <label for="tipoInforme" class="form-label">Tipo de Informe:</label>
            <select class="form-select" id="tipoInforme" name="tipoInforme" required>
                <option value="">Seleccione un informe</option>
                <option value="ventas">Informe de Ventas</option>
                <option value="proveedores">Informe de Proveedores</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="fechaInicio" class="form-label">Fecha de Inicio:</label>
            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" max="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="fechaFin" class="form-label">Fecha de Fin:</label>
            <input type="date" class="form-control" id="fechaFin" name="fechaFin" max="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <button class="btn btn-primary" type="submit">Generar PDF</button>
    </form>
</div>

<script>
document.getElementById('formGenerarInforme').addEventListener('submit', function(event) {
    event.preventDefault();
    var tipoInforme = document.getElementById('tipoInforme').value;
    if (tipoInforme === 'ventas') {
        this.action = 'generar_info_venta.php';
    } else if (tipoInforme === 'compras') {
        this.action = 'generar_info_compra.php';
    } else if (tipoInforme === 'proveedores') {
        this.action = 'generar_info_proveedores.php';
    } else {
        alert('Seleccione un tipo de informe válido.');
    }
    this.submit();
});
</script>

</body>
<?php require '../../includes/_footer.php' ?>
</html>
