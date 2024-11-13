<?php
// edit event

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $direct = $_POST['direct'];
    $view = $_POST['view'];    

    $sql = "UPDATE event_dfc SET eve_title = ?, eve_date = ?, eve_live = ?, vie_id = ? WHERE eve_id = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('sssss', $title, $date, $direct, $view, $id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=fair&p2=event");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_event'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=event-edit&id=$id");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_event'] = "error en la preparación de la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=event-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=event");
    exit;
};
