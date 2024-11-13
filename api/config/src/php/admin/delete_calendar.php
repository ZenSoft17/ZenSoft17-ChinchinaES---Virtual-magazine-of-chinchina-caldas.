<?php
// delete calendar

if (isset($_GET['id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $id = $_GET['id'];
    $con = Connect_DB();

    $sql = "DELETE FROM calendar_activities WHERE cal_id = ?";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s', $id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_calendar'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_calendar'] = "error al preparar la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar");
    exit;
}
