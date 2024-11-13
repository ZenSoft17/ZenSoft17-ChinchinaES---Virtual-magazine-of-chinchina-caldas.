<?php
// edit location

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/imagen_filter.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];    
    $image = !empty($_FILES['image']) ? processImage($_FILES['image']) : false;

    if ($image) {
        $sql = "UPDATE location SET loc_title = ?, loc_text = ?, loc_image = ? WHERE loc_id = ?";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('ssss', $title, $description, $image, $id);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=fair&p2=location");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_location'] = "error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=fair&p2=location-edit&id=$id");
                exit;
            };
        } else {
            session_start();
            $_SESSION['error_location'] = "error en la preparación de la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=location-edit&id=$id");
            exit;
        }
    } else {
        $sql = "UPDATE location SET loc_title = ?, loc_text = ? WHERE loc_id = ?";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('sss', $title, $description, $id);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=fair&p2=location");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_location'] = "error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=fair&p2=location-edit&id=$id");
                exit;
            };
        } else {
            session_start();
            $_SESSION['error_location'] = "error en la preparación de la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=location-edit&id=$id");
            exit;
        }
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=location");
    exit;
};
