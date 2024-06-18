<?php
session_start();
if (!isset($_SESSION['Correo'])) {
    header('Location: ../../includes/_sesion/login.php');
    exit();
}

// Incluir el archivo TCPDF
require_once('tcpdf/tcpdf.php');

// Incluir el archivo de conexión a la base de datos
require_once '../../includes/conexionBD.php'; // Asegúrate de que este archivo contenga la configuración de conexión a la base de datos

// Obtener las fechas de inicio y fin del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fechaInicio']) && isset($_POST['fechaFin'])) {
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];

    // Validar las fechas (puedes implementar una validación más robusta si es necesario)
    if ($fechaInicio > $fechaFin) {
        die('La fecha de inicio no puede ser mayor que la fecha de fin.');
    }

    // Consulta SQL para obtener las compras dentro del rango de fechas
    $sql = "SELECT * FROM tblcompras WHERE FechaCompra BETWEEN '$fechaInicio' AND '$fechaFin'";
    $result = mysqli_query($conn, $sql); // Asegúrate de que $conn esté definido y sea una conexión válida

    if (!$result) {
        die('Error en la consulta: ' . mysqli_error($conn));
    }

    // Crear instancia de TCPDF con tamaño de página personalizado
    $customLayout = array(600, 300); // Ancho y alto personalizados en mm
    $pdf = new TCPDF('L', PDF_UNIT, $customLayout, true, 'UTF-8', false);

    // Establecer información del documento
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nombre del Autor');
    $pdf->SetTitle('Informe de Compras');
    $pdf->SetSubject('Informe de Compras');
    $pdf->SetKeywords('TCPDF, PDF, informe, compras');

    // Configurar márgenes
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Establecer auto página de inicio
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Establecer información de la página
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    $pdf->setJPEGQuality(90);

    // Añadir una página
    $pdf->AddPage();

    // Cabecera
    $html = '<h1>Informe de Compras</h1>';
    $html .= '<p>Fecha de inicio: ' . $fechaInicio . '</p>';
    $html .= '<p>Fecha de fin: ' . $fechaFin . '</p>';

    // Inicializar variable para el total de compras
    $totalCompras = 0;

    // Crear tabla para mostrar los datos de compras
    $html .= '<table border="1" cellpadding="5" cellspacing="0">';
    $html .= '<tr><th>ID Compra</th><th>ID Proveedor</th><th>ID Producto</th><th>ID Empleado</th><th>Cantidad Comprada</th><th>Precio Unidad</th><th>Precio Total</th><th>Fecha Compra</th><th>Observación</th></tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>';
        $html .= '<td>' . $row['IdCompra'] . '</td>';
        $html .= '<td>' . $row['IdProveedor'] . '</td>';
        $html .= '<td>' . $row['IdProducto'] . '</td>';
        $html .= '<td>' . $row['IdEmpleado'] . '</td>';
        $html .= '<td>' . $row['CantidadComprada'] . '</td>';
        $html .= '<td>' . $row['PrecioUnidad'] . '</td>';
        $html .= '<td>' . $row['PrecioTotal'] . '</td>';
        $html .= '<td>' . $row['FechaCompra'] . '</td>';
        $html .= '<td>' . $row['Observación'] . '</td>';
        $html .= '</tr>';

        // Sumar el precio total de cada compra
        $totalCompras += $row['PrecioTotal'];
    }

    $html .= '</table>';

    // Añadir el total de compras al final de la tabla
    $html .= '<h2>Total de Compras: ' . number_format($totalCompras, 2) . '</h2>';

    // Escribir contenido HTML en el documento PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Cerrar y generar el PDF
    $pdf->Output('InformeCompras.pdf', 'I');
    exit;
} else {
    // Redirigir si no se recibieron las fechas
    header('Location: ../../index.php');
    exit();
}
?>
