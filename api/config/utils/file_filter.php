<?php
/**
 * Procesa un archivo subido y devuelve su contenido.
 *
 * @param array $file Información del archivo subido, como se recibe en $_FILES.
 * @return string El contenido del archivo.
 * @throws Exception Si ocurre algún error al procesar el archivo.
 */
function proccessFile($file) {
    // Verificar si el archivo ha sido subido sin errores
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    // Verificar que el archivo se haya subido correctamente
    if (!is_uploaded_file($file['tmp_name'])) {
        return null;
    }

    // Leer el contenido del archivo
    $fileContent = file_get_contents($file['tmp_name']);
    if ($fileContent === false) {
        return null;
    }

    return $fileContent;
}