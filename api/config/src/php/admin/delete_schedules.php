<?php
// delete stripe

if (isset($_GET['id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $id = $_GET['id'];
    $con = Connect_DB();

    $sql = "DELETE FROM schedules WHERE sch_id = ?";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s', $id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=fair&p2=introduction");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_stripe'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=introduction");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_stripe'] = "error al preparar la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=introduction");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=introduction");
    exit;
}