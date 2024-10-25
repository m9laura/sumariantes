<?php

namespace App\Http\Controllers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Facades\Storage;
use App\Models\caso;
use App\Models\persona; //sumario
use App\Models\tipo_persona; //sumariio
//
use TCPDF;
use Illuminate\Http\Request;

class RepspdfController extends Controller
{
    
    public function exportarsumarios()
    {
         // Obtener todos los registros de personas
    $personas = Persona::all(); // Asegúrate de que el modelo Persona esté correctamente configurado

    // Crear un nuevo objeto Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Título del informe
    $sheet->setCellValue('A1', 'INFORME DE TODAS LAS PERSONAS');
    $sheet->mergeCells('A1:T1'); // Cambiar a 'T1' ya que se usan hasta la columna T
    $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF0000')); // Color rojo
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

    // Configuración de encabezados de columnas
    $headers = [
        'Nombre', 'Apellido Paterno', 'Apellido Materno', 'CI', 'Extensión', 'Expedido',
        'DNI', 'Género', 'Nacionalidad', 'Fecha de Nacimiento', 'WhatsApp', 'Institución',
        'Tipo de Persona', 'Unidad', 'Cargo', 'Domicilio Real', 'Domicilio Legal',
        'Domicilio Convencional', 'Gmail', 'Fecha'
    ];

    // Establecer encabezados a partir de la fila 3
    $sheet->fromArray($headers, null, 'A3');
    $sheet->getStyle('A3:T3')->getFont()->setBold(true)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FFFFFF')); // Letras en blanco
    $sheet->getStyle('A3:T3')->getFill()->setFillType(Fill::FILL_SOLID);
    $sheet->getStyle('A3:T3')->getFill()->getStartColor()->setARGB('0070C0'); // Color de fondo azul
    $sheet->getStyle('A3:T3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto
    $sheet->getStyle('A3:T3')->getAlignment()->setWrapText(true); // Ajustar texto en los encabezados

    // Iterar sobre todos los registros de personas y agregarlos al archivo Excel
    $row = 4; // Comenzar en la fila 4 para los datos
    foreach ($personas as $persona) {
        $sheet->setCellValue('A' . $row, (string)$persona->nombre);
        $sheet->setCellValue('B' . $row, (string)$persona->apellidop);
        $sheet->setCellValue('C' . $row, (string)$persona->apellidom);
        $sheet->setCellValue('D' . $row, (string)$persona->ci);
        $sheet->setCellValue('E' . $row, (string)$persona->extension);
        $sheet->setCellValue('F' . $row, (string)$persona->expedido);
        $sheet->setCellValue('G' . $row, (string)$persona->dni);
        $sheet->setCellValue('H' . $row, (string)$persona->genero);
        $sheet->setCellValue('I' . $row, (string)$persona->nacionalidad);
        $sheet->setCellValue('J' . $row, (string)$persona->fnacimiento);
        $sheet->setCellValue('K' . $row, (string)$persona->whatsapp);
        $sheet->setCellValue('L' . $row, (string)$persona->institucion);
        $sheet->setCellValue('M' . $row, (string)$persona->tipo_persona_id);
        $sheet->setCellValue('N' . $row, (string)$persona->unidad);
        $sheet->setCellValue('O' . $row, (string)$persona->cargo);
        $sheet->setCellValue('P' . $row, (string)$persona->domicilioreal);
        $sheet->setCellValue('Q' . $row, (string)$persona->domiciliolegal);
        $sheet->setCellValue('R' . $row, (string)$persona->domicilioconvencional);
        $sheet->setCellValue('S' . $row, (string)$persona->gmail);
        $sheet->setCellValue('T' . $row, (string)$persona->fecha);

    }

    // Ajustar el ancho de las columnas automáticamente
    foreach (range('A', 'U') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true); // Ajustar el ancho automáticamente
    }

    // Aplicar bordes a las celdas de la tabla
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ],
        ],
    ];
    $sheet->getStyle('A3:T' . ($row - 1))->applyFromArray($styleArray);

    // Estilo para filas de datos
    for ($i = 4; $i < $row; $i++) {
        $sheet->getStyle('A' . $i . ':T' . $i)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        // Alternar colores de fila
        if ($i % 2 == 0) {
            $sheet->getStyle('A' . $i . ':T' . $i)->getFill()->setFillType(Fill::FILL_SOLID);
            $sheet->getStyle('A' . $i . ':T' . $i)->getFill()->getStartColor()->setARGB('F2F2F2'); // Color de fondo gris claro
        }
    }

    // Crear un escritor para el archivo Excel
    $writer = new Xlsx($spreadsheet);

    // Enviar el archivo Excel al navegador
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="lista_personas.xlsx"');
    $writer->save('php://output');

    // Terminar la ejecución
    exit;

    }



    public function imprimirTodossumarios()
    {
        $personas = Persona::all(); // Obtener todos los registros de personas
        // Crear instancia de TCPDF con tamaño carta
        $pdf = new TCPDF('P', 'mm', array(215.9, 279.4), true, 'UTF-8');
        // Configurar encabezado con solo el título "INFORME DE PERSONAS"
        $PDF_HEADER_TITLE = 'INFORME DE TODOS LOS SUMARIOS';
        $pdf->setHeaderData('', 0, $PDF_HEADER_TITLE, '', array(0, 128, 0), array(0, 81, 119));
        // Configurar pie de página
        $pdf->setFooterData(array(0, 64, 0), array(0, 81, 119));
        // Configuración de fuentes para encabezado y pie de página
        $pdf->setHeaderFont(array('times', 'I', 14));
        $pdf->setFooterFont(array('times', 'I', 12));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // Configuración de márgenes
        $pdf->SetMargins(10, 20, 10);
        $pdf->SetHeaderMargin(10); // Margen del encabezado
        $pdf->SetFooterMargin(15);
        // Agregar una página
        $pdf->AddPage();
        // --- Establecer las imágenes a la izquierda y derecha ---
        $imageFilePathLeft = storage_path('app/public/imagenes/lodomodif.png'); // Ajusta según tu archivo
        $imageFilePathRight = storage_path('app/public/imagenes/gamea_logo.png'); // Ajusta según tu segundo archivo
        // Dimensiones de la imagen en milímetros
        $imageWidth = 43.6; // 4.36 cm en mm
        $imageHeight = 25.4; // 2.54 cm en mm
        $yPosition = 20; // Ajustar según sea necesario para centrar verticalmente

        // Establecer la imagen de fondo a la izquierda
        if (file_exists($imageFilePathLeft)) {
            $pdf->Image($imageFilePathLeft, 10, $yPosition, $imageWidth, $imageHeight, '', '', '', false, 300, '', false, false, 0);
        }
        // Establecer la imagen de fondo a la derecha
        if (file_exists($imageFilePathRight)) {
            $pageWidth = $pdf->getPageWidth();
            $pdf->Image($imageFilePathRight, $pageWidth - $imageWidth - 10, $yPosition, $imageWidth, $imageHeight, '', '', '', false, 300, '', false, false, 0);
        }
        // --- Encabezado ajustado: "DETALLES DEL SUMARIO" a la izquierda y fecha y hora a la derecha ---
        // Obtener la fecha y hora actual
        $fechaHoraActual = date('d-m-Y H:i:s');

        // Altura de la letra
        $alturaLetra = 5;

        // Posicionar "DETALLES DEL SUMARIO" a la izquierda
        $pdf->SetFont('times', 'B', 12); // Tamaño 12
        $pdf->SetXY(10, $yPosition + $imageHeight + 10); // Posicionar a la izquierda
        $pdf->Cell(120, $alturaLetra, 'LISTADO    SUMARIOS ', 0, 0, 'L'); // A la izquierda

        // Mostrar la fecha y hora a la derecha
        $pdf->SetXY(150, $yPosition + $imageHeight + 10); // Posicionar a la derecha
        $pdf->Cell(0, $alturaLetra, 'Fecha y Hora: ' . $fechaHoraActual, 0, 1, 'R'); // A la derecha

        // Agregar una línea horizontal justo arriba del encabezado
        $pdf->Line(10, $yPosition + $imageHeight + 10 - 1, 200, $yPosition + $imageHeight + 10 - 1); // Línea alineada

        // Agregar una línea horizontal justo debajo del encabezado
        $pdf->Line(10, $yPosition + $imageHeight + 10 + $alturaLetra, 200, $yPosition + $imageHeight + 10 + $alturaLetra); // Línea inferior alineada

        // Puedes añadir un espacio antes de continuar con el contenido
        $pdf->Ln(5); // Espacio entre el encabezado y el contenido

        // --- Bajar la tabla con los detalles de las personas ---
        $pdf->SetY($yPosition + $imageHeight + 30); // Colocar la tabla justo debajo de las imágenes
        // Configuración de la tabla para las personas
        $pdf->SetFont('times', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        // Iterar sobre todos los registros de personas y generar una tabla por cada persona
        foreach ($personas as $persona) {
            $html = '<h2>Detalles de la Persona ' . $persona->id . '</h2>';
            $html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse; width: 100%;">
                <tr><th style="width: 30%;">Nombre</th><td style="width: 70%;">' . (is_string($persona->nombre) ? $persona->nombre : '') . '</td></tr>
                <tr><th style="width: 30%;">Apellido Paterno</th><td style="width: 70%;">' . (is_string($persona->apellidop) ? $persona->apellidop : '') . '</td></tr>
                <tr><th style="width: 30%;">Apellido Materno</th><td style="width: 70%;">' . (is_string($persona->apellidom) ? $persona->apellidom : '') . '</td></tr>
                 <tr><th style="width: 30%;">C.I.</th><td style="width: 70%;">' . ($persona->ci !== null ? $persona->ci : 'No disponible') . '</td></tr>
                <tr><th style="width: 30%;">Extensión</th><td style="width: 70%;">' . (is_string($persona->extension) ? $persona->extension : '') . '</td></tr>
                <tr><th style="width: 30%;">Expedido</th><td style="width: 70%;">' . (is_string($persona->expedido) ? $persona->expedido : '') . '</td></tr>
                <tr><th style="width: 30%;">DNI</th><td style="width: 70%;">' . (is_string($persona->dni) ? $persona->dni : '') . '</td></tr>
                <tr><th style="width: 30%;">Género</th><td style="width: 70%;">' . ($persona->genero ? 'Masculino' : 'Femenino') . '</td></tr>
                <tr><th style="width: 30%;">Nacionalidad</th><td style="width: 70%;">' . (is_string($persona->nacionalidad) ? $persona->nacionalidad : '') . '</td></tr>
                <tr><th style="width: 30%;">Fecha de Nacimiento</th><td style="width: 70%;">' . (is_string($persona->fnacimiento) ? $persona->fnacimiento : '') . '</td></tr>
                <tr><th style="width: 30%;">Whatsapp</th><td style="width: 70%;">' . (is_string($persona->whatsapp) ? $persona->whatsapp : '') . '</td></tr>
                <tr><th style="width: 30%;">Institución</th><td style="width: 70%;">' . (is_string($persona->institucion) ? $persona->institucion : '') . '</td></tr>
                <tr><th style="width: 30%;">Tipo de Persona</th><td style="width: 70%;">' . (is_string($persona->tipo_persona_id) ? $persona->tipo_persona_id : '') . '</td></tr>
                <tr><th style="width: 30%;">Unidad</th><td style="width: 70%;">' . (is_string($persona->unidad) ? $persona->unidad : '') . '</td></tr>
                <tr><th style="width: 30%;">Cargo</th><td style="width: 70%;">' . (is_string($persona->cargo) ? $persona->cargo : '') . '</td></tr>
                <tr><th style="width: 30%;">Domicilio Real</th><td style="width: 70%;">' . (is_string($persona->domicilioreal) ? $persona->domicilioreal : '') . '</td></tr>
                <tr><th style="width: 30%;">Domicilio Legal</th><td style="width: 70%;">' . (is_string($persona->domiciliolegal) ? $persona->domiciliolegal : '') . '</td></tr>
                <tr><th style="width: 30%;">Domicilio Convencional</th><td style="width: 70%;">' . (is_string($persona->domicilioconvencional) ? $persona->domicilioconvencional : '') . '</td></tr>
                <tr><th style="width: 30%;">Gmail</th><td style="width: 70%;">' . (is_string($persona->gmail) ? $persona->gmail : '') . '</td></tr>
                <tr><th style="width: 30%;">Fecha</th><td style="width: 70%;">' . (is_string($persona->fecha) ? $persona->fecha : '') . '</td></tr>        
<tr><th style="width: 30%;">DNI</th><td style="width: 70%;">' . ($persona->dni !== null ? $persona->dni : 'No disponible') . '</td></tr>

            </table>';
            // Insertar la tabla en el PDF
            $pdf->writeHTML($html, true, false, false, false, '');
            // Añadir espacio entre personas
            $pdf->Ln(10); // Saltar 10 mm después de cada tabla de persona
        }
        // Mostrar el PDF en el navegador
        $pdf->Output('lista_personas.pdf', 'I');
        // Redirigir de vuelta (esto no se ejecutará ya que el PDF se mostrará)
        return redirect()->back();
    }



    public function imprimirPorIds($ids)
    {
        // Recuperar las personas por ID

        $personas = Persona::findMany($ids);

        // Verifica si la colección está vacía
        if ($personas->isEmpty()) {
            return redirect()->back()->withErrors('No se encontraron personas con los IDs proporcionados.');
        }

        // Crear instancia de TCPDF con tamaño carta
        $pdf = new TCPDF('P', 'mm', array(215.9, 279.4), true, 'UTF-8');

        // Configurar encabezado
        $PDF_HEADER_TITLE = 'INFORME DEL SUMARIO';
        $pdf->setHeaderData('', 0, $PDF_HEADER_TITLE, '', array(0, 128, 0), array(0, 81, 119));

        // Configurar pie de página
        $pdf->setFooterData(array(0, 64, 0), array(0, 81, 119));

        // Fuentes para encabezado y pie de página
        $pdf->setHeaderFont(array('times', 'I', 14));
        $pdf->setFooterFont(array('times', 'I', 12));

        // Configuración de márgenes
        $pdf->SetMargins(10, 20, 10);
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(15);

        // Agregar una página
        $pdf->AddPage();

        // --- Establecer las imágenes de encabezado ---
        $imageFilePathLeft = storage_path('app/public/imagenes/lodomodif.png');
        $imageFilePathRight = storage_path('app/public/imagenes/gamea_logo.png');
        $imageWidth = 43.6;
        $imageHeight = 25.4;
        $yPosition = 30;

        if (file_exists($imageFilePathLeft)) {
            $xPositionLeft = 10;
            $pdf->Image($imageFilePathLeft, $xPositionLeft, $yPosition, $imageWidth, $imageHeight, '', '', '', false, 300, '', false, false, 0);
        }
        if (file_exists($imageFilePathRight)) {
            $pageWidth = $pdf->getPageWidth();
            $xPositionRight = $pageWidth - $imageWidth - 10;
            $pdf->Image($imageFilePathRight, $xPositionRight, $yPosition, $imageWidth, $imageHeight, '', '', '', false, 300, '', false, false, 0);
        }
        // --- Encabezado ajustado: Solo "DETALLES DEL SUMARIO" y fecha y hora a la derecha ---
        // Obtener la fecha y hora actual
        $fechaHoraActual = date('d-m-Y H:i:s');

        // Posicionar "DETALLES DEL SUMARIO" en la parte superior izquierda
        $pdf->SetFont('times', 'B', 12); // Tamaño 12
        $pdf->SetXY(10, $yPosition + $imageHeight + 10); // Posicionar a la izquierda
        $pdf->Cell(0, 5, 'DETALLES DEL SUMARIO', 0, 1, 'L');

        // Mostrar la fecha y hora en la esquina superior derecha
        $pdf->SetXY(150, $yPosition + $imageHeight + 10); // Posicionar en la esquina superior derecha
        $pdf->Cell(0, 5, 'Fecha y Hora: ' . $fechaHoraActual, 0, 1, 'R');

        foreach ($personas as $persona) {
            // Añadir espacio vertical
            $pdf->Ln(10);
            // Definir posición inicial para la imagen
            $imageX = 120; // Posición en X para que aparezca en el lado derecho
            $imageY = $pdf->GetY(); // Tomar la posición actual en Y
            $imageWidth = 30; // Ancho de la imagen
            $imageHeight = 30; // Altura de la imagen
            // Mostrar la foto (si está disponible) en el lado derecho
            if (!empty($persona->foto)) {
                $fotoPath = storage_path('app/public/' . $persona->foto);
                if (file_exists($fotoPath)) {
                    $pdf->Image($fotoPath, $imageX, $imageY, $imageWidth, $imageHeight, '', '', '', false, 300, '', false, false, 0);
                }
            }
            // Posicionar el cursor para el texto después de la imagen
            $pdf->SetY($imageY); // Mantener el nivel vertical donde comienza la imagen
            // Configurar el tamaño de la fuente
            $pdf->SetFont('times', 'B', 11); // Negrita para los nombres de los campos
            // Primera columna: Nombre y Cargo
            $pdf->Cell(40, 6, 'Nombre:', 0, 0, 'L'); // Campo sin borde
            $pdf->SetFont('times', '', 11); // Texto normal para el valor
            $pdf->Cell(60, 6, $persona->nombre, 0, 1, 'L'); // Valor sin borde y salto de línea
            $pdf->SetFont('times', 'B', 11); // Negrita para el campo
            $pdf->Cell(40, 6, 'Cargo:', 0, 0, 'L');
            $pdf->SetFont('times', '', 11);
            $pdf->Cell(60, 6, $persona->cargo, 0, 1, 'L'); // Salto de línea
            // Segunda columna: Apellidos y CI
            $pdf->SetFont('times', 'B', 11);
            $pdf->Cell(40, 6, 'Apellido Paterno:', 0, 0, 'L');
            $pdf->SetFont('times', '', 11);
            $pdf->Cell(60, 6, $persona->apellidop, 0, 1, 'L');
            $pdf->SetFont('times', 'B', 11);
            $pdf->Cell(40, 6, 'Apellido Materno:', 0, 0, 'L');
            $pdf->SetFont('times', '', 11);
            $pdf->Cell(60, 6, $persona->apellidom, 0, 1, 'L');
            $pdf->SetFont('times', 'B', 11);
            $pdf->Cell(40, 6, 'Ci:', 0, 0, 'L');
            $pdf->SetFont('times', '', 11);
            $pdf->Cell(60, 6, $persona->ci, 0, 1, 'L');
            // Espacio entre personas
            $pdf->Ln(15);
        }
        // --- Detalles adicionales de la persona ---
        $html = '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse;">
             <tr><th>Expedido</th><td>' . $persona->expedido . '</td></tr>
             <tr><th>Género</th><td>' . ($persona->genero ? 'Masculino' : 'Femenino') . '</td></tr>
             <tr><th>Nacionalidad</th><td>' . $persona->nacionalidad . '</td></tr>
             <tr><th>Fecha de Nacimiento</th><td>' . $persona->fnacimiento . '</td></tr>
             <tr><th>WhatsApp</th><td>' . $persona->whatsapp . '</td></tr>
             <tr><th>Institución</th><td>' . $persona->institucion . '</td></tr>
             <tr><th>Unidad</th><td>' . $persona->unidad . '</td></tr>
             <tr><th>Cargo</th><td>' . $persona->cargo . '</td></tr>
             <tr><th>Domicilio Real</th><td>' . $persona->domicilioreal . '</td></tr>
             <tr><th>Domicilio Legal</th><td>' . $persona->domiciliolegal . '</td></tr>
             <tr><th>Domicilio Convencional</th><td>' . $persona->domicilioconvencional . '</td></tr>
             <tr><th>Gmail</th><td>' . $persona->gmail . '</td></tr>
             <tr><th>Fecha</th><td>' . $persona->fecha . '</td></tr>
         </table>';
        // Insertar la tabla en el PDF
        $pdf->writeHTML($html, true, false, false, false, '');
        // Salida del archivo PDF
        $pdf->Output('Detalles_personas.pdf', 'I');

        // Redirigir al usuario de vuelta
        return redirect()->back();
    }
    public function imprimirPorId($id)
    {
        // Obtener el caso por ID
        $caso = Caso::findOrFail($id);
        // Crear instancia de TCPDF con tamaño carta (215.9 mm x 279.4 mm)
        $pdf = new TCPDF('P', 'mm', array(215.9, 279.4), true, 'UTF-8');
        // Configurar encabezado con solo el título "INFORME DEL CASO"
        $PDF_HEADER_TITLE = 'INFORME DEL CASO';
        $pdf->setHeaderData('', 0, $PDF_HEADER_TITLE, '', array(0, 128, 0), array(0, 81, 119));
        // Configurar pie de página
        $pdf->setFooterData(array(0, 64, 0), array(0, 81, 119));
        // Fuentes para encabezado y pie de página
        $pdf->setHeaderFont(array('times', 'I', 14));
        $pdf->setFooterFont(array('times', 'I', 12));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // Configuración de márgenes
        $pdf->SetMargins(10, 20, 10);
        $pdf->SetHeaderMargin(10); // Margen del encabezado
        $pdf->SetFooterMargin(15);
        // Agregar una página
        $pdf->AddPage();
        // --- Establecer la imagen a la izquierda ---
        $imageFilePathLeft = storage_path('app/public/imagenes/lodomodif.png'); // Ajusta según tu archivo
        $imageFilePathRight = storage_path('app/public/imagenes/gamea_logo.png'); // Ajusta según tu segundo archivo
        // Dimensiones de la imagen en milímetros
        $imageWidth = 43.6; // 4.36 cm en mm
        $imageHeight = 25.4; // 2.54 cm en mm
        $yPosition = 30; // Ajustar según sea necesario para centrar verticalmente
        // Verificar y establecer la imagen izquierda
        if (file_exists($imageFilePathLeft)) {
            $xPositionLeft = 10; // 10 mm de margen a la izquierda
            $pdf->Image($imageFilePathLeft, $xPositionLeft, $yPosition, $imageWidth, $imageHeight, '', '', '', false, 300, '', false, false, 0);
        }
        // Verificar y establecer la imagen derecha
        if (file_exists($imageFilePathRight)) {
            $pageWidth = $pdf->getPageWidth();
            $xPositionRight = $pageWidth - $imageWidth - 10; // 10 mm de margen a la derecha
            $pdf->Image($imageFilePathRight, $xPositionRight, $yPosition, $imageWidth, $imageHeight, '', '', '', false, 300, '', false, false, 0);
        }
        // --- Centrar el título "DETALLES DEL CASO" ---
        $pdf->SetY($yPosition + $imageHeight + 10); // Debajo de las imágenes
        $pdf->SetFont('times', 'B', 16);
        $pdf->Cell(0, 10, 'DETALLES DEL CASO', 0, 1, 'C'); // Título centrado
        // --- Bajar la tabla con los detalles del caso (exp_adm y registro_auxiliar) ---
        $pdf->SetY($pdf->GetY() + 10); // Colocar la tabla justo debajo del título
        $pdf->SetFont('times', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        // Crear el HTML de la tabla con solo exp_adm y registro_auxiliar
        $html = '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse; width: 50%;"> 
    <tr>
        <th style="width: 50%;">Exp Adm</th>
        <td style="width: 50%;">' . $caso->exp_adm . '</td>
    </tr>
    <tr>
        <th style="width: 50%;">Registro Auxiliar</th>
        <td style="width: 50%;">' . $caso->registro_auxiliar . '</td>
    </tr>
    </table>';
        // Insertar la tabla en el PDF
        $pdf->writeHTML($html, true, false, false, false, '');
        // --- Bajar la tabla con todos los detalles del caso ---
        $pdf->SetY($pdf->GetY() + 3); // Colocar la siguiente tabla a una distancia de 10 mm de la anterior
        $pdf->SetFont('times', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        // Crear el HTML de la tabla con los detalles del caso
        $html = '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse;">
        <tr><th>Identificación de caso</th><td>' . $caso->identificacion_caso . '</td></tr>
        <tr><th>Apertura inicial</th><td>' . $caso->apertura_inicial . '</td></tr>
        <tr><th>Resolución final</th><td>' . $caso->resolucion_final . '</td></tr>
        <tr><th>Hoja de ruta</th><td>' . $caso->hoja_ruta . '</td></tr>
        <tr><th>Recurso de revocatoria</th><td>' . $caso->recurso_revocatoria . '</td></tr>
        <tr><th>Recurso jerárquico</th><td>' . $caso->recurso_jerarquico . '</td></tr>
        <tr><th>Ejecutoria</th><td>' . $caso->ejecutoria . '</td></tr>
        <tr><th>Antecedentes</th><td>' . $caso->antecedentes . '</td></tr>
        <tr><th>Estado del caso</th><td>' . $caso->estado_proceso . '</td></tr>
        <tr><th>Fecha de registro</th><td>' . $caso->fecha . '</td></tr>
    </table>';
        // Insertar la tabla en el PDF
        $pdf->writeHTML($html, true, false, false, false, '');
        // Salida del archivo PDF
        $pdf->Output('Detalles_caso_' . $caso->id . '.pdf', 'I');
        // Redirigir al usuario de vuelta
        return redirect()->back();
    }
    //  /*********************************************************************************** *
    // / TODO LOS CASOS GENERATE PDF  
    public function imprimirTodos()
    {
        $casos = Caso::all(); // Obtener todos los casos
        // Crear instancia de TCPDF con tamaño carta
        $pdf = new TCPDF('P', 'mm', array(215.9, 279.4), true, 'UTF-8');
        // Configurar encabezado con solo el título "INFORME DEL CASO"
        $PDF_HEADER_TITLE = 'INFORME DE TODOS LOS CASO';
        $pdf->setHeaderData('', 0, $PDF_HEADER_TITLE, '', array(0, 128, 0), array(0, 81, 119));
        // Configurar pie de página
        $pdf->setFooterData(array(0, 64, 0), array(0, 81, 119));
        // Configuración de fuentes para encabezado y pie de página
        $pdf->setHeaderFont(array('times', 'I', 14));
        $pdf->setFooterFont(array('times', 'I', 12));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // Configuración de márgenes
        $pdf->SetMargins(10, 20, 10);
        $pdf->SetHeaderMargin(10); // Margen del encabezado
        $pdf->SetFooterMargin(15);
        // Agregar una página
        $pdf->AddPage();
        // --- Establecer las imágenes a la izquierda y derecha ---
        $imageFilePathLeft = storage_path('app/public/imagenes/lodomodif.png'); // Ajusta según tu archivo
        $imageFilePathRight = storage_path('app/public/imagenes/gamea_logo.png'); // Ajusta según tu segundo archivo
        // Dimensiones de la imagen en milímetros
        $imageWidth = 43.6; // 4.36 cm en mm
        $imageHeight = 25.4; // 2.54 cm en mm
        $yPosition = 20; // Ajustar según sea necesario para centrar verticalmente

        // Establecer la imagen de fondo a la izquierda
        if (file_exists($imageFilePathLeft)) {
            $pdf->Image($imageFilePathLeft, 10, $yPosition, $imageWidth, $imageHeight, '', '', '', false, 300, '', false, false, 0);
        }
        // Establecer la imagen de fondo a la derecha
        if (file_exists($imageFilePathRight)) {
            $pageWidth = $pdf->getPageWidth();
            $pdf->Image($imageFilePathRight, $pageWidth - $imageWidth - 10, $yPosition, $imageWidth, $imageHeight, '', '', '', false, 300, '', false, false, 0);
        }
        // --- Bajar la tabla con los detalles de los casos ---
        $pdf->SetY($yPosition + $imageHeight + 30); // Colocar la tabla justo debajo de las imágenes
        // Configuración de la tabla para los casos
        $pdf->SetFont('times', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        // Iterar sobre todos los casos y generar una tabla por cada caso
        //l error strlen(): Argument #1 ($string) must be of type string, array given Este error ocurre porque estás intentando usar una función que espera un valor de tipo string, pero en cambio, está recibiendo un array
        //ara cada propiedad, puedes usar is_string() para asegurarte de que es una cadena. Si no lo es, puedes convertirla a una cadena o manejarla de otra manera (como dejarla vacía)
        foreach ($casos as $caso) {
            $html = '<h2>Detalles del Caso  ' . $caso->id . '</h2>';
            $html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse; width: 100%;">
            <tr><th style="width: 30%;">Fecha de registro</th><td style="width: 70%;">' . (is_string($caso->fecha) ? $caso->fecha : '') . '</td></tr>
            <tr><th style="width: 30%;">Exp Adm</th><td style="width: 70%;">' . (is_string($caso->exp_adm) ? $caso->exp_adm : '') . '</td></tr>
            <tr><th style="width: 30%;">Registro Auxiliar</th><td style="width: 70%;">' . (is_string($caso->registro_auxiliar) ? $caso->registro_auxiliar : '') . '</td></tr>
            <tr><th style="width: 30%;">Identificación de caso</th><td style="width: 70%;">' . (is_string($caso->identificacion_caso) ? $caso->identificacion_caso : '') . '</td></tr>
            <tr><th style="width: 30%;">Apertura inicial</th><td style="width: 70%;">' . (is_string($caso->apertura_inicial) ? $caso->apertura_inicial : '') . '</td></tr>
            <tr><th style="width: 30%;">Resolución final</th><td style="width: 70%;">' . (is_string($caso->resolucion_final) ? $caso->resolucion_final : '') . '</td></tr>
            <tr><th style="width: 30%;">Hoja de ruta</th><td style="width: 70%;">' . (is_string($caso->hoja_ruta) ? $caso->hoja_ruta : '') . '</td></tr>
            <tr><th style="width: 30%;">Recurso de revocatoria</th><td style="width: 70%;">' . (is_string($caso->recurso_revocatoria) ? $caso->recurso_revocatoria : '') . '</td></tr>
            <tr><th style="width: 30%;">Recurso jerárquico</th><td style="width: 70%;">' . (is_string($caso->recurso_jerarquico) ? $caso->recurso_jerarquico : '') . '</td></tr>
            <tr><th style="width: 30%;">Ejecutoria</th><td style="width: 70%;">' . (is_string($caso->ejecutoria) ? $caso->ejecutoria : '') . '</td></tr>
            <tr><th style="width: 30%;">Antecedentes</th><td style="width: 70%;">' . (is_string($caso->antecedentes) ? $caso->antecedentes : '') . '</td></tr>
            <tr><th style="width: 30%;">Estado del caso</th><td style="width: 70%;">' . (is_string($caso->estado_proceso) ? $caso->estado_proceso : '') . '</td></tr>
            
        </table>';
            // Insertar la tabla en el PDF
            $pdf->writeHTML($html, true, false, false, false, '');
            // Añadir espacio entre casos
            $pdf->Ln(10); // Saltar 10 mm después de cada tabla de caso
        }
        // Mostrar el PDF en el navegador
        $pdf->Output('lista_casos.pdf', 'I');
        // Redirigir de vuelta (esto no se ejecutará ya que el PDF se mostrará)
        return redirect()->back();
    }
    ///pdf casos todo fin 
    // /*********************EXCEL TODOS */
    public function exportar()
    {
        $casos = Caso::all(); // Obtener todos los casos

        // Crear un nuevo objeto Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Título del informe
        $sheet->setCellValue('A1', 'INFORME DE TODOS LOS CASOS');
        $sheet->mergeCells('A1:L1'); // Combinar celdas para el título
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF0000')); // Color rojo
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        // Configuración de encabezados de columnas
        $headers = [
            'Exp Adm',
            'Registro Auxiliar',
            'Identificación de Caso',
            'Apertura Inicial',
            'Resolución Final',
            'Hoja de Ruta',
            'Recurso de Revocatoria',
            'Recurso Jerárquico',
            'Ejecutoria',
            'Antecedentes',
            'Estado del Caso',
            'Fecha de Registro'
        ];

        // Establecer encabezados a partir de la fila 3
        $sheet->fromArray($headers, null, 'A3');
        $sheet->getStyle('A3:L3')->getFont()->setBold(true)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FFFFFF')); // Letras en blanco
        $sheet->getStyle('A3:L3')->getFill()->setFillType(Fill::FILL_SOLID);
        $sheet->getStyle('A3:L3')->getFill()->getStartColor()->setARGB('0070C0'); // Color de fondo azul
        $sheet->getStyle('A3:L3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar texto

        // Aplicar ajuste de texto a los encabezados
        $sheet->getStyle('A3:L3')->getAlignment()->setWrapText(true);

        // Iterar sobre todos los casos y agregarlos al archivo Excel
        $row = 4; // Comenzar en la fila 4 para los datos
        foreach ($casos as $caso) {
            $sheet->setCellValue('A' . $row, (string)$caso->exp_adm);
            $sheet->setCellValue('B' . $row, (string)$caso->registro_auxiliar);
            $sheet->setCellValue('C' . $row, (string)$caso->identificacion_caso);
            $sheet->setCellValue('D' . $row, (string)$caso->apertura_inicial);
            $sheet->setCellValue('E' . $row, (string)$caso->resolucion_final);
            $sheet->setCellValue('F' . $row, (string)$caso->hoja_ruta);
            $sheet->setCellValue('G' . $row, (string)$caso->recurso_revocatoria);
            $sheet->setCellValue('H' . $row, (string)$caso->recurso_jerarquico);
            $sheet->setCellValue('I' . $row, (string)$caso->ejecutoria);

            // Verificar el contenido del campo "Antecedentes" y aplicar el color correspondiente
            $antecedentesCell = 'J' . $row;
            $antecedentesValue = (string)$caso->antecedentes;
            $sheet->setCellValue($antecedentesCell, $antecedentesValue);

            if (empty($antecedentesValue)) {
                $sheet->getStyle($antecedentesCell)->getFill()->setFillType(Fill::FILL_SOLID);
                $sheet->getStyle($antecedentesCell)->getFill()->getStartColor()->setARGB('FF00FF00'); // Verde si está vacío
            } else {
                $sheet->getStyle($antecedentesCell)->getFill()->setFillType(Fill::FILL_SOLID);
                $sheet->getStyle($antecedentesCell)->getFill()->getStartColor()->setARGB('FFFFCC00'); // Amarillo dorado si tiene datos
            }

            $sheet->setCellValue('K' . $row, (string)$caso->estado_proceso);
            $sheet->setCellValue('L' . $row, (string)$caso->fecha);
            $row++; // Ir a la siguiente fila
        }

        // Ajustar el ancho de las columnas según el contenido
        foreach (range('A', 'L') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(false); // Desactivar el ajuste automático
            $sheet->getColumnDimension($columnID)->setWidth(20); // Establecer un ancho fijo para todas las columnas
            // Aplicar ajuste de texto a cada columna
            $sheet->getStyle($columnID . '4:' . $columnID . ($row - 1))->getAlignment()->setWrapText(true);
        }

        // Aplicar bordes a las celdas de la tabla
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        $sheet->getStyle('A3:L' . ($row - 1))->applyFromArray($styleArray);

        // Estilo para filas de datos
        for ($i = 4; $i < $row; $i++) {
            $sheet->getStyle('A' . $i . ':L' . $i)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
            // Alternar colores de fila
            if ($i % 2 == 0) {
                $sheet->getStyle('A' . $i . ':L' . $i)->getFill()->setFillType(Fill::FILL_SOLID);
                $sheet->getStyle('A' . $i . ':L' . $i)->getFill()->getStartColor()->setARGB('F2F2F2'); // Color de fondo gris claro
            }
        }

        // Crear un escritor para el archivo Excel
        $writer = new Xlsx($spreadsheet);

        // Enviar el archivo Excel al navegador
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="lista_casos.xlsx"');
        $writer->save('php://output');

        // Terminar la ejecución
        exit;
    }
}

