<?php
// add themes

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $fair_id = $_POST['fai_id'];
    $theme = $_POST['theme'];
    
    $sql_select = "SELECT * FROM themes WHERE fai_id = '$fair_id'";
    $query = mysqli_query($con, $sql_select);
    if ($query->num_rows > 2) {
        session_start();
        $_SESSION['error_themes'] = "No se puede crear mas elementos de informacion";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=themes");
        exit;
    } else {
        $sql = "INSERT INTO themes(the_id,fai_id,the_theme) VALUES(?,?,?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('sss', $id, $fair_id, $theme);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=fair&p2=themes");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_themes'] = "error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=fair&p2=themes-add");
                exit;
            };
        } else {
            session_start();
            $_SESSION['error_themes'] = "error en la preparacion de la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=themes-add");
            exit;
        }
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=themes");
    exit;
};
