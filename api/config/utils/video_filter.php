<?php
// video filter
function processVideo($file)
{
    // Define el tamaño máximo permitido en bytes (128 MB)
    $maxFileSize = 128 * 1024 * 1024; // 128 MB en bytes

    // Verifica si el archivo fue subido sin errores
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Obtiene el tipo MIME del archivo
        $fileMimeType = mime_content_type($file['tmp_name']);

        // Obtiene el tamaño del archivo
        $fileSize = $file['size'];

        // Verifica si el archivo es un video por su prefijo MIME y si el tamaño es menor al límite
        if (strpos($fileMimeType, 'video/') === 0 && $fileSize <= $maxFileSize) {
            // Lee el contenido del archivo
            $fileContent = file_get_contents($file['tmp_name']);
            // Codifica el contenido en Base64
            $fileBase64 = base64_encode($fileContent);

            // Retorna el archivo codificado junto con el tamaño y el tipo MIME
            return [
                'content' => $fileBase64,
                'size' => $fileSize,
                'mime_type' => $fileMimeType
            ];
        }
    }

    // Retorna null si el archivo no es un video o el tamaño excede el límite
    return null;
}
