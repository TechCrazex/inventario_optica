<?php
session_start();
if (!isset($_SESSION['Correo'])) {
    header('Location: ../../includes/_sesion/login.php');
    exit();
}
?>
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header2.php' ?>

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
    <h1>Generar Informe</h1>
</div>
    <div class="col-auto">
        <form action="../../views/usuarios/generar_info_compra.php" method="post" target="_blank">
            <button class="btn btn-primary" type="submit" name="generar_informe" value="ventas">Generar informe Compras</button>    
        </form>
        <form action="../../views/usuarios/generar_info_venta.php" method="post" target="_blank">
            <button class="btn btn-primary" type="submit" name="generar_informe" value="compras">Generar informe Ventas</button>
        </form>
        <form action="../../views/usuarios/generar_info_proveedores.php" method="post" target="_blank">
            <button class="btn btn-primary" type="submit" name="generar_informe" value="proveedores">Generar informe Proveedores</button>
        </form>
    </div>

</html>


<?php require '../../includes/_footer.php' ?>
</html>
