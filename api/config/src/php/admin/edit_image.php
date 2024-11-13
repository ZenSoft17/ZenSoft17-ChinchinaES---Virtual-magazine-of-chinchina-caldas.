<?php
// edit hashtag
if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/imagen_filter.php';
    $con = Connect_DB();
    $id =  mysqli_real_escape_string($con, $_POST['id']);
    $image = processImage($_FILES['image']);

    $sql = "UPDATE image_bank SET imb_image = ? WHERE imb_id = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('si', $image, $id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=image-bank");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_image_bank'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=image-bank-edit");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_image_bank'] = "error en la preparacion de la consulta";
        header("Location: ../../pages/admin/admin.php?p=image-bank-edit");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=image-bank");
    exit;
};
