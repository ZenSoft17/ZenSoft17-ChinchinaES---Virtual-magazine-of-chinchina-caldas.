<?php

// edit publication

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/imagen_filter.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/video_filter.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $title = $_POST['title'];    
    $image = !empty($_FILES['image']) ? processImage($_FILES['image']) : false;

    if ($image) {
        if ($image) {
            $sql = "UPDATE publications SET pub_image = ?, pub_name = ? WHERE pub_id = ?";
            $stmt = $con->prepare($sql);
            if ($stmt) {
                $stmt->bind_param('sss', $image, $title, $id);
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
            $_SESSION['error_layout'] = "El archivo no es una imagen";
            header("Location: ../../pages/layout/layout.php?p=publication");
            exit;
        }
    } else {
        $sql = "UPDATE publications SET pub_name = ? WHERE pub_id = ?";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('ss', $title, $id);
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
    }
} else {
    session_start();
    $_SESSION['error_layout'] = "no se envio el formulario";
    header("Location: ../../pages/layout/layout.php");
    exit;
}
