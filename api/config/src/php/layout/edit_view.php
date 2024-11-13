<?php
// view publications

if (isset($_GET['id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $id = $_GET['id'];
    $con = Connect_DB();

    $sql_select = "SELECT view_.vie_view FROM publications
                    INNER JOIN view_ ON publications.vie_id = view_.vie_id
                    WHERE pub_id = ?";
    $stmt_select = $con->prepare($sql_select);
    if ($stmt_select) {
        $stmt_select->bind_param('s', $id);
        if ($stmt_select->execute()) {
            $stmt_select->store_result();
            if ($stmt_select->num_rows > 0) {
                $stmt_select->bind_result($view);
                $stmt_select->fetch();
                if ($view === 'si') {
                    $view = 2;
                }
                if ($view === 'no') {
                    $view = 1;
                }
                $sql = "UPDATE publications SET vie_id = ? WHERE pub_id = ?";
                $stmt = $con->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param('ss', $view, $id);
                    if ($stmt->execute()) {
                        header("Location: ../../pages/layout/layout.php");
                        $stmt->close();
                        $con->close();
                        exit;
                    } else {
                        session_start();
                        $_SESSION['error_layout'] = "error en la consulta";
                        header("Location: ../../pages/layout/layout.php");
                        exit;
                    }
                } else {
                    session_start();
                    $_SESSION['error_layout'] = "error en la consulta";
                    header("Location: ../../pages/layout/layout.php");
                    exit;
                }
            } else {
                session_start();
                $_SESSION['error_layout'] = "error en la consulta";
                header("Location: ../../pages/layout/layout.php");
                exit;
            }
        } else {
            session_start();
            $_SESSION['error_layout'] = "error en la consulta";
            header("Location: ../../pages/layout/layout.php");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_layout'] = "error al preparar la consulta";
        header("Location: ../../pages/layout/layout.php");
        exit;
    }
} else {
    header("Location: ../../pages/layout/layout.php");
    exit;
}
