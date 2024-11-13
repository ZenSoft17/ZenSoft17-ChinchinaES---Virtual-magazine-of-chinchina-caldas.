<?php
// edit calendar days

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id = $_POST['cal_id'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    


    $sql = "UPDATE calendar_activities_days SET cald_title = ?, cald_text = ? WHERE cald_id = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('sss', $title, $text, $id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar-days");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_stripe'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar-days-edit&id=$id");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_stripe'] = "error en la preparación de la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar-days-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar-days");
    exit;
};
