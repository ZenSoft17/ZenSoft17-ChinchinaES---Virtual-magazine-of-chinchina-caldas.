<?php
// edit video bank
if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/video_filter.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $video = processVideo($_FILES['video']);

    if ($video) {
        $videoContent = $video['content'];
        $videoMimeType = $video['mime_type'];
        $videoSize = $video['size'];
        $extension = $video['extension'];

        $sql = "UPDATE video_bank SET vib_video = ?, vib_size = ?, vib_type = ?, vib_extension = ? WHERE vib_id = ?";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('bissi', $videoContent, $videoSize, $videoMimeType, $extension, $id);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=video-bank");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_video_bank'] = "Error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=video-bank-edit&id=$id");
                exit;
            }
        } else {
            session_start();
            $_SESSION['error_video_bank'] = "Error en la preparación de la consulta";
            header("Location: ../../pages/admin/admin.php?p=video-bank-edit&id=$id");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_video_bank'] = "El archivo no es un video o es muy grande (MAXIMO 128 MB)";
        header("Location: ../../pages/admin/admin.php?p=video-bank-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=video-bank");
    exit;
}
