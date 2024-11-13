<?php
// edit stripe

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $direct = $_POST['direct'];
    $view = $_POST['view'];    

    $sql = "UPDATE stripe_dfc SET stp_title = ?, stp_description = ?, stp_live = ?, vie_id = ? WHERE stp_id = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('sssss', $title, $description, $direct, $view, $id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_stripe'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe-edit&id=$id");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_stripe'] = "error en la preparación de la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe");
    exit;
};
