<?php
// add video bank
if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/video_filter.php';
    $con = Connect_DB();
    $id = str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $video = processVideo($_FILES['video']);

    if ($video) {
        $videoContent = $video['content'];
        $videoMimeType = $video['mime_type'];
        $videoSize = $video['size'];
        $extension = $video['extension'];

        $sql = "INSERT INTO video_bank (vib_id, vib_video, vib_size, vib_type, vib_extension) VALUES (?, ?, ?, ?,?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('isiss', $id, $videoContent, $videoSize, $videoMimeType, $extension);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=video-bank");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_video_bank'] = "error";
                header("Location: ../../pages/admin/admin.php?p=video-bank-add");
                exit;
            }
        } else {
            session_start();
            $_SESSION['error_video_bank'] = "Error en la preparación de la consulta";
            header("Location: ../../pages/admin/admin.php?p=video-bank-add");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_video_bank'] = "El archivo no es un video o el formato no es permitido";
        header("Location: ../../pages/admin/admin.php?p=video-bank-add");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=video-bank");
    exit;
}
