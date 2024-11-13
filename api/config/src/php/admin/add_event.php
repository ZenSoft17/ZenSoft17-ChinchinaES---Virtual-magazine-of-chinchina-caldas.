<?php
// add event

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $title = $_POST['title'];
    $fair_id = $_POST['fai_id'];
    $date = $_POST['date'];
    $direct = $_POST['direct'];
    $view = $_POST['view'];    

    $sql_select = "SELECT * FROM event_dfc WHERE fai_id = '$fair_id'";
    $query = mysqli_query($con, $sql_select);
    if ($query->num_rows !== 0) {
        session_start();
        $_SESSION['error_event'] = "No se puede crear mas elementos de informacion";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=introduction");
        exit;
    } else {
        $sql = "INSERT INTO event_dfc(eve_id,fai_id,eve_title,eve_date,eve_live,vie_id) VALUES(?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('ssssss', $id, $fair_id, $title, $date, $direct, $view);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=fair&p2=event");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_event'] = "error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=fair&p2=event-add");
                exit;
            };
        } else {
            session_start();
            $_SESSION['error_event'] = "error en la preparacion de la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=event-add");
            exit;
        }
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=event");
    exit;
};
