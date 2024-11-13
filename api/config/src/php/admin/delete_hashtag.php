<?php 
// delete hashtag

if (isset($_GET['id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $id = $_GET['id'];
    $con = Connect_DB();

    $sql = "DELETE FROM hashtags WHERE has_id = ?";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s',$id);
        if($stmt->execute()){
            header("Location: ../../pages/admin/admin.php?p=hashtag");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_hashtag'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=hashtag");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_hashtag'] = "error al preparar la consulta";
        header("Location: ../../pages/admin/admin.php?p=hashtag");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=hashtag");
    exit;
}
