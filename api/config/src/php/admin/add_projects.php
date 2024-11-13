<?php
// add projects

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/imagen_filter.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $fair_id = $_POST['fai_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $modality = $_POST['modality'];
    $status = $_POST['status'];
    $view = $_POST['view'];
    $imagen = processImage($_FILES['image']);
    

    if ($imagen) {
        $sql = "INSERT INTO projects(pro_id, fai_id, mod_id, sta_id, pro_title, pro_author, vie_id, pro_image) VALUES(?,?,?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            // Adjusted type definition to match the number of variables
            $stmt->bind_param('ssssssss', $id, $fair_id, $modality, $status, $title, $author, $view, $imagen);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=fair&p2=projects");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_projects'] = "error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-add");
                exit;
            };
        } else {
            session_start();
            $_SESSION['error_projects'] = "error en la preparacion de la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-add");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_projects'] = "no es una imagen";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-add");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=projects");
    exit;
};
