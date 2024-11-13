<?php
// accept project request

if (isset($_GET['pro_id']) && isset($_GET['fai_id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $pro_id = $_GET['pro_id'];
    $fai_id = $_GET['fai_id'];
    $con = Connect_DB();
    $id = str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $status = 3;
    $view = 2;
    $modality = 65214268;

    // Select query
    $sql = "SELECT prj_project_name, prj_project_leader, prj_project_image FROM project_registrations WHERE prj_id = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('s', $pro_id);
        if ($stmt->execute()) {
            $stmt->bind_result($project_name, $project_leader, $project_image);
            if ($stmt->fetch()) {
                $image = addslashes($project_image);
                $stmt->close();

                // Insert query
                $sql_insert = "INSERT INTO projects(pro_id,fai_id,mod_id,sta_id,pro_title,pro_author,pro_view,pro_image) VALUES (?,?,?,?,?,?,?,?)";
                $stmt_insert = $con->prepare($sql_insert);
                if ($stmt_insert) {
                    $stmt_insert->bind_param('ssssssss', $id, $fai_id, $modality, $status, $project_name, $project_leader, $view, $image);
                    if ($stmt_insert->execute()) {
                        $stmt_insert->close();

                        // Delete query
                        $sql_delete = "DELETE FROM project_registrations WHERE prj_id = ?";
                        $stmt_delete = $con->prepare($sql_delete);
                        if ($stmt_delete) {
                            $stmt_delete->bind_param('s', $pro_id);
                            if ($stmt_delete->execute()) {
                                $stmt_delete->close(); 
                                $con->close();
                                header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-request");
                                exit;
                            } else {
                                $stmt_delete->close();
                                session_start();
                                $_SESSION['error_projects'] = "Error al ejecutar la consulta de eliminación";
                                header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-request");
                                exit;
                            }
                        } else {
                            $stmt_insert->close();
                            session_start();
                            $_SESSION['error_projects'] = "Error al preparar la consulta de eliminación";
                            header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-request");
                            exit;
                        }
                    } else {
                        $stmt_insert->close();
                        session_start();
                        $_SESSION['error_projects'] = "Error al ejecutar la consulta de inserción";
                        header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-request");
                        exit;
                    }
                } else {
                    session_start();
                    $_SESSION['error_projects'] = "Error al preparar la consulta de inserción";
                    header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-request");
                    exit;
                }
            } else {
                $stmt->close();
                session_start();
                $_SESSION['error_projects'] = "No se encontraron resultados para el proyecto especificado";
                header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-request");
                exit;
            }
        } else {
            $stmt->close();
            session_start();
            $_SESSION['error_projects'] = "Error al ejecutar la consulta de selección";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-request");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_projects'] = "Error al preparar la consulta de selección";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-request");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-request");
    exit;
}
