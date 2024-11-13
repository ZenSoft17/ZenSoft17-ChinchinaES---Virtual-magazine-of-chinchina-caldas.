<?php
// delete location

if (isset($_GET['id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $id = $_GET['id'];
    $con = Connect_DB();

    $sql = "DELETE FROM location WHERE loc_id = ?";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s', $id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=fair&p2=location");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_location'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=location");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_location'] = "error al preparar la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=location");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=themes");
    exit;
}
