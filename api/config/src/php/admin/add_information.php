<?php
// add information

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $title = $_POST['title'];
    $fair_id = $_POST['fai_id'];
    $description = $_POST['description'];
    $general_objective = $_POST['general_objective'];
    $view = $_POST['view'];    

    $sql_select = "SELECT * FROM info_dfc WHERE fai_id = '$fair_id'";
    $query = mysqli_query($con, $sql_select);
    if ($query->num_rows !== 0) {
        session_start();
        $_SESSION['error_information'] = "No se puede crear mas elementos de informacion";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=introduction");
        exit;
    } else {
        $sql = "INSERT INTO info_dfc(inf_id,fai_id,inf_title,inf_description,inf_general_objective,vie_id) VALUES(?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('ssssss', $id, $fair_id, $title, $description, $general_objective, $view);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=fair&p2=introduction");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_information'] = "error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=fair&p2=introduction-add");
                exit;
            };
        } else {
            session_start();
            $_SESSION['error_information'] = "error en la preparacion de la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=introduction-add");
            exit;
        }
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=introduction");
    exit;
};
