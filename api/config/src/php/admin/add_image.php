<?php
// delete hashtag
if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/imagen_filter.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $image = processImage($_FILES['image']);

    $sql = "INSERT INTO image_bank(imb_id,imb_image) VALUES(?,?)";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ss', $id, $image);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=image-bank");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_image_bank'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=image-bank-add");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_image_bank'] = "error en la preparacion de la consulta";
        header("Location: ../../pages/admin/admin.php?p=image-bank-add");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=image-bank");
    exit;
};
