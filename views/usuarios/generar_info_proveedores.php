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

    // Consulta SQL para obtener los proveedores dentro del rango de fechas
    $sql = "SELECT IdProveedor, NombreEmpresa, NombreProveedor, Direccion, Telefono, Correo, fechaRegistroPro 
            FROM tblproveedores 
            WHERE fechaRegistroPro BETWEEN '$fechaInicio' AND '$fechaFin' 
            ORDER BY fechaRegistroPro";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die('Error en la consulta: ' . mysqli_error($conn));
    }


    // Crear instancia de TCPDF con tamaño de página personalizado
    $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Establecer información del documento
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nombre del Autor');
    $pdf->SetTitle('Informe de Proveedores');
    $pdf->SetSubject('Informe de Proveedores');
    $pdf->SetKeywords('TCPDF, PDF, informe, proveedores');

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
    $html = '<h1>Informe de Proveedores</h1>';
    $html .= '<p>Fecha de inicio: ' . $fechaInicio . '</p>';
    $html .= '<p>Fecha de fin: ' . $fechaFin . '</p>';

    // Crear tabla para mostrar los datos de proveedores
    $html .= '<table border="1" cellpadding="5" cellspacing="0">';
    $html .= '<tr>
                <th>ID Proveedor</th>
                <th>Nombre Empresa</th>
                <th>Nombre Proveedor</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Fecha de Registro</th>
              </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>';
        $html .= '<td>' . $row['IdProveedor'] . '</td>';
        $html .= '<td>' . $row['NombreEmpresa'] . '</td>';
        $html .= '<td>' . $row['NombreProveedor'] . '</td>';
        $html .= '<td>' . $row['Direccion'] . '</td>';
        $html .= '<td>' . $row['Telefono'] . '</td>';
        $html .= '<td>' . $row['Correo'] . '</td>';
        $html .= '<td>' . $row['fechaRegistroPro'] . '</td>';
        $html .= '</tr>';
    }

    $html .= '</table>';

    // Escribir contenido HTML en el documento PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Cerrar y generar el PDF
    $pdf->Output('InformeProveedores.pdf', 'I');
    exit;
} else {
    // Redirigir si no se recibieron las fechas
    header('Location: ../../index.php');
    exit();
}
?>
