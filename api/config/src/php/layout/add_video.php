<?php
// add video

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/video_filter.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $type = 8;
    $pub_id = mysqli_real_escape_string($con, $_POST['pub_id']);
    $video = processVideo($_FILES['video']);
    $datetime = date('Y-m-d H:i:s');

    if ($video) {
        $videoContent = $video['content'];
        $sql = "INSERT INTO elements(ele_id,pub_id,typ_id,ele_video,ele_datetime) VALUES(?,?,?,?,?)";
        $stmt = $con->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('sssss', $id, $pub_id, $type, $videoContent, $datetime);
            if ($stmt->execute()) {
                header("Location: ../../pages/layout/layout.php?p=publication");
                exit;
            } else {
                session_start();
                $_SESSION['error_layout'] = "Error en la consulta";
                header("Location: ../../pages/layout/layout.php?p=video-add");
                exit;
            }
        } else {
            session_start();
            $_SESSION['error_layout'] = "Error en la consulta";
            header("Location: ../../pages/layout/layout.php?p=video-add");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_layout'] = "El archivo no es un video o es muy grande (MAXIMO 128 MB)";
        header("Location: ../../pages/layout/layout.php?p=video-add");
        exit;
    }
} else {
    session_start();
    $_SESSION['error_layout'] = "no se envio el formulario";
    header("Location: ../../pages/layout/layout.php");
    exit;
}
