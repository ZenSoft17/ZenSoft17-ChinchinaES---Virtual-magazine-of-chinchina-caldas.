<?php
// add invited

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $fair_id = $_POST['fai_id'];
    $modality = $_POST['modality'];
    $name = $_POST['name'];
    $profession = $_POST['profession'];    

    $sql_select = "SELECT * FROM invited WHERE fai_id = '$fair_id'";
    $query = mysqli_query($con, $sql_select);
    if ($query->num_rows !== 0) {
        session_start();
        $_SESSION['error_stripe'] = "No se puede crear mas elementos de informacion";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe");
        exit;
    } else {
        $sql = "INSERT INTO invited(inv_id,fai_id,mod_id,inv_name,inv_profession) VALUES(?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('sssss', $id, $fair_id, $modality, $name, $profession);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_stripe'] = "error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe-invited-add");
                exit;
            };
        } else {
            session_start();
            $_SESSION['error_stripe'] = "error en la preparacion de la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe-invited-add");
            exit;
        }
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=stripe");
    exit;
};
