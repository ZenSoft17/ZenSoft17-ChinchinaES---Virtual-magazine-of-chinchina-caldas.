<?php
// add inscriptions

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $fair_id = $_POST['fai_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $info_general = $_POST['info-general'];
    $start_date = $_POST['start-date'];
    $end_date = $_POST['end-date'];
    $view = $_POST['view'];    

    $sql_select = "SELECT * FROM registrations_dfc WHERE fai_id = '$fair_id'";
    $query = mysqli_query($con, $sql_select);
    if ($query->num_rows !== 0) {
        session_start();
        $_SESSION['error_inscriptions'] = "No se puede crear mas elementos de informacion";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=inscriptions");
        exit;
    } else {
        $sql = "INSERT INTO registrations_dfc(reg_id,fai_id,reg_title,reg_description,reg_general_info,reg_start_date,reg_end_date,vie_id) VALUES(?,?,?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('ssssssss', $id, $fair_id,$title,$description,$info_general,$start_date,$end_date,$view);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=fair&p2=inscriptions");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_inscriptions'] = "error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=fair&p2=inscriptions-add");
                exit;
            };
        } else {
            session_start();
            $_SESSION['error_inscriptions'] = "error en la preparacion de la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=inscriptions-add");
            exit;
        }
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=inscriptions");
    exit;
};
