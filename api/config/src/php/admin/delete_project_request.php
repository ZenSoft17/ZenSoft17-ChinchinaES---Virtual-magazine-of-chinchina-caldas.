<?php
// delete stripe

if (isset($_GET['id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $id = $_GET['id'];
    $con = Connect_DB();

    $sql = "DELETE FROM project_registrations WHERE prj_id = ?";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s', $id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-request");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_projects'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-request");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_projects'] = "error al preparar la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-request");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-request");
    exit;
}
