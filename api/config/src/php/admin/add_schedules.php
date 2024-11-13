<?php
// add schedules

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $fair_id = $_POST['fai_id'];
    $init_date = $_POST['init_date'];
    $end_date = $_POST['end_date'];
    $text = $_POST['text'];


    $sql_select = "SELECT * FROM schedules WHERE fai_id = '$fair_id'";
    $query = mysqli_query($con, $sql_select);
    if ($query->num_rows > 2) {
        session_start();
        $_SESSION['error_information'] = "No se puede crear mas elementos de informacion";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=introduction");
        exit;
    } else {
        $sql = "INSERT INTO schedules(sch_id,fai_id,sch_date_init,sch_date_end,sch_text) VALUES(?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('sssss', $id, $fair_id, $init_date, $end_date, $text);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=fair&p2=introduction");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_information'] = "error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=fair&p2=schedules-add");
                exit;
            };
        } else {
            session_start();
            $_SESSION['error_information'] = "error en la preparacion de la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=schedules-add");
            exit;
        }
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=introduction");
    exit;
};
