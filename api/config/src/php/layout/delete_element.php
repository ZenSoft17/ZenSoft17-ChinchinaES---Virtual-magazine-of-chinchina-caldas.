<?php
// delete publications

if (isset($_GET['id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $id = $_GET['id'];
    $con = Connect_DB();

    $sql = "DELETE FROM elements WHERE ele_id = ?";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s', $id);
        if ($stmt->execute()) {
            header("Location: ../../pages/layout/layout.php?p=publication");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_layout'] = "error en la consulta";
            header("Location: ../../pages/layout/layout.php?p=publication");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_layout'] = "error al preparar la consulta";
        header("Location: ../../pages/layout/layout.php?p=publication");
        exit;
    }
} else {
    header("Location: ../../pages/layout/layout.php?p=publication");
    exit;
}
