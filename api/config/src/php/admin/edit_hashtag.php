<?php 
// edit hastag

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $hashtag = $_POST['hashtag'];    

    $sql = "UPDATE hashtags SET has_hashtag = ? WHERE has_id = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ss',$hashtag,$id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=hashtag");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_hashtag'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=hashtag-edit&id=$id");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_hashtag'] = "error en la preparacion de la consulta";
        header("Location: ../../pages/admin/admin.php?p=hashtag-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=hashtag");
    exit;
};
