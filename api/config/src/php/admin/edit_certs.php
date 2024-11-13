<?php
// edit certs

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    

    $sql = "UPDATE certifications SET cer_title = ?, cer_text = ? WHERE cer_id = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('sss', $title, $text, $id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=fair&p2=certs");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_certs'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=certs-edit&id=$id");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_certs'] = "error en la preparación de la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=certs-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=certs");
    exit;
};
