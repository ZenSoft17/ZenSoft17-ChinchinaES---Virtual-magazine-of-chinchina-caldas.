<?php
// add modalities

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $fair_id = $_POST['fai_id'];
    $modality = $_POST['modality'];
    

    $sql_select = "SELECT * FROM modalities WHERE fai_id = '$fair_id'";
    $query = mysqli_query($con, $sql_select);
    if ($query->num_rows > 2) {
        session_start();
        $_SESSION['error_modalities'] = "No se puede crear mas elementos de informacion";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=modalities");
        exit;
    } else {
        $sql = "INSERT INTO modalities(mod_id,fai_id,mod_modality) VALUES(?,?,?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('sss', $id, $fair_id, $modality);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=fair&p2=modalities");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_modalities'] = "error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=fair&p2=modalities-add");
                exit;
            };
        } else {
            session_start();
            $_SESSION['error_modalities'] = "error en la preparacion de la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=modalities-add");
            exit;
        }
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=modalities");
    exit;
};
