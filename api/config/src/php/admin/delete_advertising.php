<?php
// delete advertising

if (isset($_GET['id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $id = $_GET['id'];
    $con = Connect_DB();

    $sql = "DELETE FROM contributors WHERE con_id = ?";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s',$id);
        if($stmt->execute()){
            header("Location: ../../pages/admin/admin.php?p=advertising");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_users'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=advertising");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_users'] = "error al preparar la consulta";
        header("Location: ../../pages/admin/admin.php?p=advertising");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=advertising");
    exit;
}
