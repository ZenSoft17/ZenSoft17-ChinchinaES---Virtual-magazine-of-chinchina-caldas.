<?php
// delete event

if (isset($_GET['id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $id = $_GET['id'];
    $con = Connect_DB();

    $sql = "DELETE FROM collection_genders WHERE col_id = ?";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s', $id);
        if ($stmt->execute()) {
            $sql = "DELETE FROM collection WHERE col_id = ?";
            $stmt = $con->prepare($sql);

            if ($stmt) {
                $stmt->bind_param('s', $id);
                if ($stmt->execute()) {
                    header("Location: ../../pages/admin/admin.php?p=collection&p2=collection");
                    $stmt->close();
                    $con->close();
                    exit;
                } else {
                    session_start();
                    $_SESSION['error_collection'] = "error en la consulta";
                    header("Location: ../../pages/admin/admin.php?p=collection&p2=collection");
                    exit;
                }
            } else {
                session_start();
                $_SESSION['error_collection'] = "error al preparar la consulta";
                header("Location: ../../pages/admin/admin.php?p=collection&p2=collection");
                exit;
            }
        } else {
            session_start();
            $_SESSION['error_collection'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=collection&p2=collection");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_collection'] = "error al preparar la consulta";
        header("Location: ../../pages/admin/admin.php?p=collection&p2=collection");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=collection&p2=collection");
    exit;
}
