<?php
// edit hours

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $init = $_POST['init'];
    $end = $_POST['end'];
    
    $sql = "UPDATE cast_time SET cas_hour_init = ?, cas_hour_end = ? WHERE cas_id = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('sss', $init, $end, $id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_stripe'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe-schedules-edit&id=$id");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_stripe'] = "error en la preparación de la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe-schedules-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe");
    exit;
};
