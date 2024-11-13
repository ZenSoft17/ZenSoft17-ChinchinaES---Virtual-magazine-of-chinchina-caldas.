<?php

// add users

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $hashtag = $_POST['hashtag'];


    $sql = "INSERT INTO hashtags(has_id,has_hashtag) VALUES(?,?)";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ss',$id,$hashtag);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=hashtag");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_hashtag'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=hashtag-add");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_hashtag'] = "error en la preparacion de la consulta";
        header("Location: ../../pages/admin/admin.php?p=hashtag-add");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=hashtag");
    exit;
};
