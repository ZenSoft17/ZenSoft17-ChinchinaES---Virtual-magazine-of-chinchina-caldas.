<?php
// edit projects

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/imagen_filter.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $modality = $_POST['modality'];
    $status = $_POST['status'];
    $view = $_POST['view'];    
    $image = processImage($_FILES['image']);

    if ($image) {
        $sql = "UPDATE projects SET pro_title = ?, pro_author = ?, mod_id = ?, sta_id = ?, vie_id = ?, pro_image = ? WHERE pro_id = ?";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('sssssss', $title, $author, $modality, $status, $view, $image, $id);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=fair&p2=projects");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_projects'] = "error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-edit&id=$id");
                exit;
            };
        } else {
            session_start();
            $_SESSION['error_projects'] = "error en la preparación de la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-edit&id=$id");
            exit;
        }
    } else {
        $sql = "UPDATE projects SET pro_title = ?, pro_author = ?, mod_id = ?, sta_id = ?, vie_id = ? WHERE pro_id = ?";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('ssssss', $title, $author, $modality, $status, $view,  $id);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=fair&p2=projects");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_projects'] = "error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-edit&id=$id");
                exit;
            };
        } else {
            session_start();
            $_SESSION['error_projects'] = "error en la preparación de la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-edit&id=$id");
            exit;
        }
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=projects");
    exit;
};
