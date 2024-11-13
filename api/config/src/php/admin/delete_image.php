<?php
// delete image bank

if (isset($_GET['id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $id = $_GET['id'];
    $con = Connect_DB();

    $sql = "DELETE FROM image_bank WHERE imb_id = ?";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s',$id);
        if($stmt->execute()){
            header("Location: ../../pages/admin/admin.php?p=image-bank");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_image_bank'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=image-bank");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_image_bank'] = "error al preparar la consulta";
        header("Location: ../../pages/admin/admin.php?p=image-bank");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=image-bank");
    exit;
}
