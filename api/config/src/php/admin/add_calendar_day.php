<?php
// add calendar days

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $cal_id = $_POST['cal_id'];
    $title = $_POST['title'];
    $text = $_POST['text'];    

    $sql_select = "SELECT * FROM calendar_activities_days WHERE cal_id = '$cal_id'";
    $query = mysqli_query($con, $sql_select);
    if ($query->num_rows > 30) {
        session_start();
        $_SESSION['error_calendar'] = "No se puede crear mas elementos de informacion";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar");
        exit;
    } else {
        $sql = "INSERT INTO calendar_activities_days(cald_id,cal_id,cald_title,cald_text) VALUES(?,?,?,?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('ssss', $id, $cal_id, $title, $text);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar-days");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_calendar'] = "error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar-days-add");
                exit;
            };
        } else {
            session_start();
            $_SESSION['error_calendar'] = "error en la preparacion de la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar-days-add");
            exit;
        }
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=calendar-days");
    exit;
};
