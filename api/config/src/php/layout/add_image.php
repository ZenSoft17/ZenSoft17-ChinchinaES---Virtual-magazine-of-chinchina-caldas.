<?php
// add imagen

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/imagen_filter.php';
    $image = processImage($_FILES['image']);
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $type = 7;
    $pub_id = mysqli_real_escape_string($con, $_POST['pub_id']);
    $datetime = date('Y-m-d H:i:s');

    if ($image) {
        $sql = "INSERT INTO elements(ele_id,pub_id,typ_id,ele_image,ele_datetime) VALUES(?,?,?,?,?)";
        $stmt = $con->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('sssss', $id, $pub_id, $type, $image, $datetime);
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
        $_SESSION['error_layout'] = "El archivo no es una imagen";
        header("Location: ../../pages/layout/layout.php?p=video-add");
        exit;
    }
} else {
    session_start();
    $_SESSION['error_layout'] = "no se envio el formulario";
    header("Location: ../../pages/layout/layout.php");
    exit;
}
