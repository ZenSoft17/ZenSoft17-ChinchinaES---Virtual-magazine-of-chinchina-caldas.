<?php

// download project 
if (isset($_GET['id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/utils/librarys/fpdf.php';

    // Conectar a la base de datos
    $con = Connect_DB();
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // Consultar la base de datos de manera segura
    $stmt = $con->prepare("SELECT * FROM project_registrations WHERE prj_id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Crear directorio cache si no existe
        $cacheDir = __DIR__ . '/cache/';
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0777, true);
        }

        // Crear el PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Detalles del Proyecto', 0, 1, 'C');
        $pdf->Ln(10);

        // Agregar datos al PDF
        foreach ($row as $key => $value) {
            if ($key !== 'prj_project_image' && $key !== 'prj_institution_logo' && $key !== 'prj_project_evidences') {
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(0, 10, ucfirst(str_replace('prj_', ' ', $key)) . ': ' . $value, 0, 1);
            }
        }

        // Guardar el PDF en la carpeta cache
        $pdfOutput = $cacheDir . 'proyecto_detalles.pdf';
        $pdf->Output('F', $pdfOutput);

        // Crear un archivo ZIP
        $zip = new ZipArchive();
        $project_name = $row['prj_project_name'];
        $zip_name = "proyecto_$project_name.zip";
        $zipFile = $cacheDir . $zip_name;

        if ($zip->open($zipFile, ZipArchive::CREATE) !== TRUE) {
            exit("No se pudo abrir el archivo ZIP.");
        }

        // Agregar el PDF al ZIP
        $zip->addFile($pdfOutput, 'proyecto_detalles.pdf');

        // Agregar la imagen 1 al ZIP
        if (!empty($row['prj_project_image'])) {
            $imageData = $row['prj_project_image'];
            $imageFileName = 'logo_institucion' . $id . '.jpg';
            // Decode the image data from binary format
            $imageData1 = imagecreatefromstring($imageData);
            // Encode the image data as a JPEG string
            ob_start();
            imagejpeg($imageData1);
            $imageString = ob_get_clean();
            // Add the image string to the ZIP
            $zip->addFromString($imageFileName, $imageString);
            // Remove the temporary image resource
            imagedestroy($imageData1);
        }

        // Agregar la imagen 2 al ZIP 
        if (!empty($row['prj_project_image'])) {
            $imageData = $row['prj_project_image'];
            $imageFileName = 'imagen_proyecto' . $id . '.jpg';
            // Decode the image data from binary format
            $imageData1 = imagecreatefromstring($imageData);
            // Encode the image data as a JPEG string
            ob_start();
            imagejpeg($imageData1);
            $imageString = ob_get_clean();
            // Add the image string to the ZIP
            $zip->addFromString($imageFileName, $imageString);
            // Remove the temporary image resource
            imagedestroy($imageData1);
        }

        // Consultar el archivo ZIP desde el BLOB en la base de datos
        $stmt = $con->prepare("SELECT prj_project_evidences FROM project_registrations WHERE prj_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($fileBlob);
        $stmt->fetch();

        if (!empty($fileBlob)) {
            $zip->addFromString('evidence.zip', $fileBlob);
        }

        // Cerrar el archivo ZIP
        $zip->close();

        // Enviar el archivo ZIP al navegador
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $zip_name . '"');
        header('Content-Length: ' . filesize($zipFile));
        readfile($zipFile);

        // Eliminar archivos temporales
        unlink($pdfOutput);
        unlink($zipFile);
    } else {
        echo "No se encontraron datos.";
    }
} else {
    echo "ID no proporcionado.";
}
