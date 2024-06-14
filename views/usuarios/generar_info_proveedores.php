<?php
$fecha_actual = date('Y-m-d H:i:s');
date_default_timezone_set('Etc/GMT+5');
require('tcpdf/tcpdf.php');

class TCPDF_Tabla extends TCPDF {
    private $customWidth; // Ancho personalizado del PDF

    function __construct($orientation='P', $unit='mm', $size='A4', $customWidth = 450) {
        parent::__construct($orientation, $unit, array(380, 100), true, 'UTF-8', false);
        $this->customWidth = $customWidth;
    }

    function Table($header, $data, $tableWidth = null) {
        $this->SetFont('helvetica', 'B', 12);

        // Si se proporciona un ancho de tabla personalizado, lo usamos; de lo contrario, usamos el ancho predeterminado del PDF
        $tableWidth = ($tableWidth !== null) ? $tableWidth : $this->customWidth;
        // Inicializar los arrays para almacenar el ancho máximo de cada columna en el encabezado
        $maxWidthHeader = array_fill(0, count($header), 0);

        // Calcular el ancho máximo de cada columna en el encabezado
        foreach ($header as $key => $value) {
            $columnWidth = $this->GetStringWidth($value);
            $maxWidthHeader[$key] = max($maxWidthHeader[$key], $columnWidth);
        }

        // Inicializar los arrays para almacenar el ancho máximo de cada columna en los datos
        $maxWidthData = array_fill(0, count($header), 0);

        // Calcular el ancho máximo de cada columna en los datos
        foreach ($data as $row) {
            foreach ($row as $key => $value) {
                $columnWidth = $this->GetStringWidth($value);
                $maxWidthData[$key] = max($maxWidthData[$key], $columnWidth);
            }
        }

        // Calcular el ancho máximo entre el encabezado y los datos para cada columna
        $maxWidthColumns = array_map(function($headerWidth, $dataWidth) {
            return max($headerWidth, $dataWidth);
        }, $maxWidthHeader, $maxWidthData);

        // Ancho máximo para la columna 'Observacion'
        // Puedes ajustar este valor según tus necesidades

        // Encabezado
        foreach ($header as $key => $value) {
            $this->Cell($maxWidthColumns[$key] + 10, 8, $value, 1, 0, 'C'); // Aumenta el valor del ancho de la celda
        }
        $this->Ln();

        // Datos
        foreach ($data as $row) {
            foreach ($row as $key => $value) {
                if ($header[$key]=== 'Observación') {
                    // Aplicar text wrapping a toda la columna 'Observacion'
                    $this->MultiCell($maxWidthColumns[$key] + 10, 10, $value, 1, 'C');
                    $maxWidthObservación = 10;
                } else {
                    $this->Cell($maxWidthColumns[$key] + 10, 10, $value, 1, 0, 'C'); // Aumenta el valor del ancho de la celda
                }
            }
            $this->Ln();
        }
    }

    function GetCustomWidth() {
        return $this->customWidth;
    }
}

// Función para obtener datos de la base de datos
function fetchData($sql) {
    global $mysqli;
    $result = $mysqli->query($sql);
    if ($result && $result->num_rows > 0) {
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = array_values($row); // Utilizar solo los valores de las filas
        }
        return $rows;
    } else {
        echo 'Error al obtener datos de la base de datos: ' . $mysqli->error;
        return false;
    }
}

if (isset($_POST['generar_informe'])) {
    $tipo_informe = $_POST['generar_informe'];

    // Establecer una conexión con la base de datos usando MySQLi
    $mysqli = new mysqli('localhost', 'id21981269_crudoptica', 'Sena2617515.', 'id21981269_bdoptica');
    if ($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }

    // Define el ancho personalizado del PDF, por ejemplo, 250 mm
    $customWidth = 250;

    // Crear el PDF con el ancho personalizado
    $pdf = new TCPDF_Tabla('L', 'mm', 'A4', $customWidth); // Ajustar el ancho y alto de la página (en este caso, tamaño A4)
    $pdf->SetFont('helvetica', '', 12);

    // Agregar una nueva página al PDF
    $pdf->AddPage();

    // Obtener los datos de la base de datos
    $data = fetchData("SELECT IdProveedor, Nit, NombreEmpresa, NombreProveedor, Direccion, Telefono, Correo FROM tblproveedores");

    if ($data) {
        $fecha_formateada = date('Y-m-d H:i:s', time());
        // Mostrar la fecha de creación en tiempo real con la zona horaria especificada
        $pdf->Cell(0, 10, 'Fecha de Creación: ' . $fecha_formateada, 0, 1);
        $pdf->Cell(40, 10, 'Tabla de Proveedores');
        $pdf->Ln();
        $pdf->SetFont('helvetica', '', 12);

        // Crear encabezado de la tabla
        $header = array('IdProveedor', 'Nit', 'NombreEmpresa', 'NombreProveedor', 'Direccion', 'Telefono', 'Correo');

        // Mostrar la tabla con el ancho personalizado (380 mm)
        $pdf->Table($header, $data, 380);

        // Mostrar la fecha de creación en tiempo real
    } else {
        $pdf->Cell(40, 10, 'No se encontraron datos');
    }

    // Limpiar el búfer de salida
    ob_clean(); 

    // Salida del PDF
    $pdf->Output();
}
?>
