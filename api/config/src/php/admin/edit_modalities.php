<?php
// edit modalities

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $modality = $_POST['modality'];
    

    $sql = "UPDATE modalities SET mod_modality = ? WHERE mod_id = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ss', $modality, $id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=fair&p2=modalities");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_modalities'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=modalities-edit&id=$id");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_modalities'] = "error en la preparación de la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=modalities-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=modalities");
    exit;
};
