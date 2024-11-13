<?php
// edit calendar

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $title = $_POST['title'];
    

    $sql = "UPDATE calendar_activities SET cal_title = ? WHERE cal_id = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ss', $title, $id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_calendar'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar-edit&id=$id");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_calendar'] = "error en la preparación de la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar");
    exit;
};
