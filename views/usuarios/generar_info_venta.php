<?php
session_start();
if (!isset($_SESSION['Correo'])) {
    header('Location: ../../includes/_sesion/login.php');
    exit();
}

// Incluir el archivo TCPDF
require_once('tcpdf/tcpdf.php');

// Incluir el archivo de conexión a la base de datos
require_once '../../includes/conexionBD.php';

// Obtener las fechas de inicio y fin del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fechaInicio']) && isset($_POST['fechaFin'])) {
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];

    // Validar las fechas (puedes implementar una validación más robusta si es necesario)
    if ($fechaInicio > $fechaFin) {
        die('La fecha de inicio no puede ser mayor que la fecha de fin.');
    }

    // Consulta SQL para obtener las ventas dentro del rango de fechas
    $sql = "SELECT * FROM tblventas WHERE FechaVenta BETWEEN '$fechaInicio' AND '$fechaFin'";
    $result = mysqli_query($conn, $sql);

    // Crear instancia de TCPDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Establecer información del documento
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nombre del Autor');
    $pdf->SetTitle('Informe de Ventas');
    $pdf->SetSubject('Informe de Ventas');
    $pdf->SetKeywords('TCPDF, PDF, informe, ventas');

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
    $html = '<h1>Informe de Ventas</h1>';
    $html .= '<p>Fecha de inicio: ' . $fechaInicio . '</p>';
    $html .= '<p>Fecha de fin: ' . $fechaFin . '</p>';

    // Crear tabla para mostrar los datos de ventas
    $html .= '<table border="1" cellpadding="5" cellspacing="0">';
    $html .= '<tr><th>ID Venta</th><th>ID Producto</th><th>Cantidad Vendida</th><th>Precio Unitario</th><th>Total</th><th>Fecha Venta</th></tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>';
        $html .= '<td>' . $row['IdVenta'] . '</td>';
        $html .= '<td>' . $row['IdProducto'] . '</td>';
        $html .= '<td>' . $row['CantidadVendida'] . '</td>';
        $html .= '<td>' . $row['PrecioUnidad'] . '</td>';
        $html .= '<td>' . $row['PrecioTotal'] . '</td>';
        $html .= '<td>' . $row['FechaVenta'] . '</td>';
        $html .= '</tr>';
    }

    $html .= '</table>';

    // Escribir contenido HTML en el documento PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Cerrar y generar el PDF
    $pdf->Output('InformeVentas.pdf', 'I');
    exit;
} else {
    // Redirigir si no se recibieron las fechas
    header('Location: ../../index.php');
    exit();
}
?>
