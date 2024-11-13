<?php
// edit invited

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $name = $_POST['name'];
    $modality = $_POST['modality'];
    $profession = $_POST['profession'];    

    $sql = "UPDATE invited SET inv_name = ?, mod_id = ?, inv_profession = ? WHERE inv_id = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ssss', $name, $modality, $profession, $id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_stripe'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe-invited-edit&id=$id");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_stripe'] = "error en la preparación de la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe-invited-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe");
    exit;
};
