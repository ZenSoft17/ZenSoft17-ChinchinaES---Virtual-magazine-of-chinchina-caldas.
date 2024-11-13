<?php
// edit schedules

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $init_date = $_POST['init_date'];
    $end_date = $_POST['end_date'];
    $text = $_POST['text'];
    
    $sql = "UPDATE schedules SET sch_date_init = ?, sch_date_end = ?, sch_text = ? WHERE sch_id = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ssss', $init_date, $end_date, $text, $id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=fair&p2=introduction");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_information'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=schedules-edit&id=$id");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_information'] = "error en la preparacion de la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=schedules-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=schedules");
    exit;
};
