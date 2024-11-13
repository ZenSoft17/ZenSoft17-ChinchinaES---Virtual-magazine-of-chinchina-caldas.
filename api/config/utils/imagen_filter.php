<?php 

function processImage($file) {
    if (isset($file['tmp_name']) && $file['error'] === UPLOAD_ERR_OK) {
        $mime = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file['tmp_name']);
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed_mimes = ['image/svg+xml', 'image/png', 'image/jpeg'];
        $allowed_exts = ['svg', 'png', 'jpeg', 'jpg'];

        if (in_array($mime, $allowed_mimes) && in_array($ext, $allowed_exts)) {
            return file_get_contents($file['tmp_name']);
        }
    }
    return null;
}