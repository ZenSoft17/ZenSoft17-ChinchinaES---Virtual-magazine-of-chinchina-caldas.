<?php
// add fair

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $name = $_POST['fair-name'];
    $view = $_POST['fair-view'];    

    if ($view === '1') {
        $sql_select = "SELECT * FROM fair WHERE vie_id = '1'";
        $query = mysqli_query($con, $sql_select);
        if ($query) {
            if ($query->num_rows > 0) {
                session_start();
                $_SESSION['error_fair'] = "Ya existe una feria con la vista activa";
                header("Location: ../../pages/admin/admin.php?p=fair-edit&id=$id");
                exit;
            } else {
                $sql = "UPDATE fair SET fai_fair = ?, vie_id = ? WHERE fai_id = ?";
                $stmt = $con->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param('sss', $name, $view, $id);
                    if ($stmt->execute()) {
                        header("Location: ../../pages/admin/admin.php?p=fair");
                        $stmt->close();
                        $con->close();
                        exit;
                    } else {
                        session_start();
                        $_SESSION['error_fair'] = "error en la consulta";
                        header("Location: ../../pages/admin/admin.php?p=fair-edit&id$id");
                        exit;
                    };
                } else {
                    session_start();
                    $_SESSION['error_fair'] = "error en la preparacion de la consulta";
                    header("Location: ../../pages/admin/admin.php?p=fair-edit&id$id");
                    exit;
                }
            }
        } else {
            session_start();
            $_SESSION['error_fair'] = "error en la preparacion de la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair-edit&id$id");
            exit;
        }
    }

    if ($view === '2') {
        $sql = "UPDATE fair SET fai_fair = ?, vie_id = ? WHERE fai_id = ?";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('sss', $name, $view, $id);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=fair");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_fair'] = "error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=fair-edit&id$id");
                exit;
            };
        } else {
            session_start();
            $_SESSION['error_fair'] = "error en la preparacion de la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair-edit&id$id");
            exit;
        }
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair");
    exit;
};
