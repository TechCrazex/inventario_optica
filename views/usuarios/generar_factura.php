<?php
require_once '../../includes/conexionBD.php';
require_once 'tcpdf/tcpdf.php';

class PDF extends TCPDF {
    public function Header() {
        $this->SetFont('helvetica', 'B', 18);
        $this->Cell(0, 15, 'Factura', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
}

// Definir la zona horaria de Bogotá, Colombia
date_default_timezone_set('America/Bogota');

// Define el ancho y largo de la página
$ancho = 140;
$largo = 120;

$pdf = new PDF('P', 'mm', array($ancho, $largo), true, 'UTF-8', false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('helvetica', '', 10);
$pdf->AddPage();

// Verificar si se ha enviado el IdVenta desde el formulario
if(isset($_POST['generar_informe']) && $_POST['generar_informe'] === 'compras' && isset($_POST['IdVenta'])) {
    $idVenta = $_POST['IdVenta'];

    // Consulta SQL para obtener los detalles de la venta
    $sql = "SELECT v.IdVenta, CONCAT(c.Nombres, ' ', c.Apellidos) AS Cliente, p.NombreProducto, v.CantidadVendida, v.PrecioUnidad, v.PrecioTotal, v.FechaVenta, v.Observación, cp.Categoria 
            FROM tblventas v 
            JOIN tblclientes c ON v.IdCliente = c.IdCliente 
            JOIN tblproductos p ON v.IdProducto = p.IdProducto
            JOIN tblcategoriasproductos cp ON v.IdCategoria = cp.IdCategoria
            WHERE v.IdVenta = '$idVenta'";
    
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $fechaHora = date('Y-m-d', strtotime($row["FechaVenta"]));
        $fechaHoraBogota = date('Y-m-d', strtotime("$fechaHora -5 hours"));

        // Construir el contenido HTML de la factura
        $html = '';
        $html .= '<p>';
        $html .= 'Hora actual: ' . date('H:i:s') . '<br>';
        $html .= '</p>';

        $html .= '<h3>Venta</h3>';
        $html .= '<p>';
        $html .= 'ID Venta: ' . $row["IdVenta"] . '<br>';
        $html .= 'Cliente: ' . $row["Cliente"] . '<br>';
        $html .= 'Producto: ' . $row["NombreProducto"] . '<br>';
        $html .= 'Cantidad: ' . $row["CantidadVendida"] . '<br>';
        $html .= 'Precio Unidad: ' . $row["PrecioUnidad"] . '<br>';
        $html .= 'Precio Total: ' . $row["PrecioTotal"] . '<br>';
        $html .= 'Fecha Venta: ' . $fechaHoraBogota . '<br>';
        $html .= 'Observación: ' . $row["Observación"] . '<br>';
        $html .= 'Categoría: ' . $row["Categoria"] . '<br>';
        $html .= '</p>';

        // Escribir el contenido HTML en el PDF
        $pdf->writeHTML($html);

        // Mostrar el PDF al usuario
        $pdf->Output('factura.pdf', 'I');
    } else {
        echo "No se encontraron datos para el IdVenta proporcionado.";
    }
} else {
    echo "No se ha proporcionado un IdVenta válido o no se ha solicitado generar la factura.";
}
?>
