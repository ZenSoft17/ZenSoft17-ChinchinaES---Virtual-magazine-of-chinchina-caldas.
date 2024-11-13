<?php 
// delete genders

if (isset($_GET['id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $id = $_GET['id'];
    $con = Connect_DB();

    $sql = "DELETE FROM gender WHERE gen_id = ?";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s',$id);
        if($stmt->execute()){
            header("Location: ../../pages/admin/admin.php?p=collection&p2=genders");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_genders'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=collection&p2=genders");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_genders'] = "error al preparar la consulta";
        header("Location: ../../pages/admin/admin.php?p=collection&p2=genders");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=collection&p2=genders");
    exit;
}