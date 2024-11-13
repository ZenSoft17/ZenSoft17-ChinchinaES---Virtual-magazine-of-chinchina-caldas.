<?php
// add element

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/imagen_filter.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/video_filter.php';
    $con = Connect_DB();
    $id =  mysqli_real_escape_string($con, $_POST['id']);
    $type =  mysqli_real_escape_string($con, $_POST['type']);

    if ($type === 'title' || $type === 'subtitle' || $type === 'text') {
        $text = $_POST['text'];
        $sql = "UPDATE elements SET ele_text = ? WHERE ele_id = ?";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('ss', $text, $id);
            if ($stmt->execute()) {
                header("Location: ../../pages/layout/layout.php?p=publication");
                echo "echo!";
                exit;
            } else {
                session_start();
                $_SESSION['error_layout'] = "Error en la consulta";
                header("Location: ../../pages/layout/layout.php?p=publication");
                exit;
            }
        } else {
            session_start();
            $_SESSION['error_layout'] = "Error en la consulta";
            header("Location: ../../pages/layout/layout.php?p=publication");
            exit;
        }
    }

    if ($type === 'imagen') {
        $image = processImage($_FILES['image']);
        if ($image) {
            $sql = "UPDATE elements SET ele_image = ? WHERE ele_id = ?";
            $stmt = $con->prepare($sql);
            if ($stmt) {
                $stmt->bind_param('ss', $image, $id);
                if ($stmt->execute()) {
                    header("Location: ../../pages/layout/layout.php?p=publication");
                    exit;
                } else {
                    session_start();
                    $_SESSION['error_layout'] = "Error en la consulta";
                    header("Location: ../../pages/layout/layout.php?p=publication");
                    exit;
                }
            } else {
                session_start();
                $_SESSION['error_layout'] = "Error en la consulta";
                header("Location: ../../pages/layout/layout.php?p=publication");
                exit;
            }
        } else {
            session_start();
            $_SESSION['error_layout'] = "No se ha selecionado una imagen, No es una imagen o El archivo es muy pasado (MAXIMO 128 MB)";
            header("Location: ../../pages/layout/layout.php?p=publication");
            exit;
        }
    }

    if ($type === 'video') {
        $video = processVideo($_FILES['video']);
        if ($video) {
            $videoContent = $video['content'];

            $sql = "UPDATE elements SET ele_video = ? WHERE ele_id = ?";
            $stmt = $con->prepare($sql);
            if ($stmt) {
                $stmt->bind_param('ss', $videoContent, $id);
                if ($stmt->execute()) {
                    header("Location: ../../pages/layout/layout.php?p=publication");
                    exit;
                } else {
                    session_start();
                    $_SESSION['error_layout'] = "Error en la consulta";
                    header("Location: ../../pages/layout/layout.php?p=publication");
                    exit;
                }
            } else {
                session_start();
                $_SESSION['error_layout'] = "Error en la consulta";
                header("Location: ../../pages/layout/layout.php?p=publication");
                exit;
            }
        } else {
            session_start();
            $_SESSION['error_video_bank'] = "El archivo no es un video o es muy grande (MAXIMO 128 MB)";
            header("Location: ../../pages/layout/layout.php?p=publication");
            exit;
        }
    }
} else {
    session_start();
    $_SESSION['error_layout'] = "no se envio el formulario";
    header("Location: ../../pages/layout/layout.php");
    exit;
}
