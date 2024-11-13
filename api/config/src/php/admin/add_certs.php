<?php
// add certs

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $fair_id = $_POST['fai_id'];
    $title = $_POST['title'];
    $text = $_POST['text'];    

    $sql = "INSERT INTO certifications(cer_id,fai_id,cer_title,cer_text) VALUES(?,?,?,?)";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ssss', $id, $fair_id, $title, $text);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=fair&p2=certs");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_certs'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=certs-add");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_certs'] = "error en la preparacion de la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=certs-add");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=certs");
    exit;
};
