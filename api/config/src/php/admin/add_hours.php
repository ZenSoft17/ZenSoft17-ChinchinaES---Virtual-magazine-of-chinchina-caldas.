<?php
// add hours

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $fair_id = $_POST['fai_id'];
    $init = $_POST['init'];
    $end = $_POST['end'];
    
    $sql_select = "SELECT * FROM cast_time WHERE fai_id = '$fair_id'";
    $query = mysqli_query($con, $sql_select);
    if ($query->num_rows !== 0) {
        session_start();
        $_SESSION['error_stripe'] = "No se puede crear mas elementos de informacion";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe");
        exit;
    } else {
        $sql = "INSERT INTO cast_time(cas_id,fai_id,cas_hour_init,cas_hour_end) VALUES(?,?,?,?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('ssss', $id, $fair_id, $init, $end);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_stripe'] = "error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe-schedules-add");
                exit;
            };
        } else {
            session_start();
            $_SESSION['error_stripe'] = "error en la preparacion de la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe-schedules-add");
            exit;
        }
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe");
    exit;
};
