<?php
// add calendar

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $fair_id = $_POST['fai_id'];
    $title = $_POST['title'];    

    $sql_select = "SELECT * FROM calendar_activities WHERE fai_id = '$fair_id'";
    $query = mysqli_query($con, $sql_select);
    if ($query->num_rows !== 0) {
        session_start();
        $_SESSION['error_calendar'] = "No se puede crear mas elementos de informacion";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar");
        exit;
    } else {
        $sql = "INSERT INTO calendar_activities(cal_id,fai_id,cal_title) VALUES(?,?,?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('sss', $id, $fair_id, $title);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_calendar'] = "error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar-add");
                exit;
            };
        } else {
            session_start();
            $_SESSION['error_calendar'] = "error en la preparacion de la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar-add");
            exit;
        }
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar");
    exit;
};
