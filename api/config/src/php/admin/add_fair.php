<?php
// add fair

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $name = $_POST['fair-name'];
    $view = $_POST['fair-view'];
    

    if ($view === '1') {
        $sql_select = "SELECT * FROM fair WHERE vie_id = '1'";
        $query = mysqli_query($con, $sql_select);
        if ($query) {
            if ($query->num_rows > 0) {
                session_start();
                $_SESSION['error_fair'] = "Ya existe una feria con la vista activa";
                header("Location: ../../pages/admin/admin.php?p=fair-add");
                exit;
            } else {
                $sql = "INSERT INTO fair(fai_id,fai_fair,vie_id) VALUES(?,?,?)";
                $stmt = $con->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param('sss', $id, $name, $view);
                    if ($stmt->execute()) {
                        header("Location: ../../pages/admin/admin.php?p=fair");
                        $stmt->close();
                        $con->close();
                        exit;
                    } else {
                        session_start();
                        $_SESSION['error_fair'] = "Error en la consulta";
                        header("Location: ../../pages/admin/admin.php?p=fair-add");
                        exit;
                    }
                } else {
                    session_start();
                    $_SESSION['error_fair'] = "Error en la preparación de la consulta";
                    header("Location: ../../pages/admin/admin.php?p=fair-add");
                    exit;
                }
            }
        } else {
            session_start();
            $_SESSION['error_fair'] = "Error en la consulta de verificación";
            header("Location: ../../pages/admin/admin.php?p=fair-add");
            exit;
        }
    }

    if ($view !== '1') {
        $sql = "INSERT INTO fair(fai_id,fai_fair,vie_id) VALUES(?,?,?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('sss', $id, $name, $view);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=fair");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_fair'] = "Error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=fair-add");
                exit;
            }
        } else {
            session_start();
            $_SESSION['error_fair'] = "Error en la preparación de la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair-add");
            exit;
        }
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair");
    exit;
}
