<?php
// delete inscriptions

if (isset($_GET['id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $id = $_GET['id'];
    $con = Connect_DB();

    $sql = "DELETE FROM registrations_dfc WHERE reg_id = ?";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s',$id);
        if($stmt->execute()){
            header("Location: ../../pages/admin/admin.php?p=fair&p2=inscriptions");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_inscriptions'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=inscriptions");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_inscriptions'] = "error al preparar la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=inscriptions");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=event");
    exit;
}
