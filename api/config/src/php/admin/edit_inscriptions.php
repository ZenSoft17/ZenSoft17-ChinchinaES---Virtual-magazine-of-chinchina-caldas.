<?php
// edit inscriptions

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $info_general = $_POST['info-general'];
    $start_date = $_POST['start-date'];
    $end_date = $_POST['end-date'];
    $view = $_POST['view'];    

    $sql = "UPDATE registrations_dfc SET reg_title = ?, reg_description = ?, reg_general_info = ?, reg_start_date = ?, reg_end_date = ?, vie_id = ? WHERE reg_id = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('sssssss', $title, $description,$info_general,$start_date,$end_date, $view, $id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=fair&p2=inscriptions");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_inscriptions'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=inscriptions-edit&id=$id");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_inscriptions'] = "error en la preparación de la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=inscriptions-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=inscriptions");
    exit;
};
