<?php
// delete video bank

if (isset($_GET['id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $id = $_GET['id'];
    $con = Connect_DB();

    $sql = "DELETE FROM video_bank WHERE vib_id = ?";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s',$id);
        if($stmt->execute()){
            header("Location: ../../pages/admin/admin.php?p=video-bank");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_users'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=video-bank");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_users'] = "error al preparar la consulta";
        header("Location: ../../pages/admin/admin.php?p=video-bank");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=video-bank");
    exit;
}
