<?php
// code script 

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $code = mysqli_real_escape_string($con, $_POST['code']);

    $sql_select = "SELECT cod_id, use_id FROM codes WHERE cod_id = ?";
    $stmt_select = $con->prepare($sql_select);
    if ($stmt_select) {
        $stmt_select->bind_param('s', $code);
        if ($stmt_select->execute()) {
            $stmt_select->store_result();
            if ($stmt_select->num_rows > 0) {
                $stmt_select->bind_result($code, $use_id);
                $stmt_select->fetch();

                $sql_user = "SELECT roles.rol_role FROM users 
                             INNER JOIN roles ON  users.rol_id = roles.rol_id
                             WHERE use_id = ?";
                $stmt_user = $con->prepare($sql_user);
                if ($stmt_user) {
                    $stmt_user->bind_param('s', $use_id);
                    if ($stmt_user->execute()) {
                        $stmt_user->store_result();
                        $stmt_user->bind_result($role);
                        $stmt_user->fetch();
                        $sql_delete = "DELETE FROM codes WHERE cod_id = ?";
                        $stmt_delete = $con->prepare($sql_delete);
                        if ($stmt_delete) {
                            $stmt_delete->bind_param('s', $code);
                            if ($stmt_delete->execute()) {
                                if ($role === 'Administrador') {
                                    session_start();
                                    unset($_SESSION['login_status']);
                                    $_SESSION['use_id'] = $use_id;
                                    $_SESSION['role'] = $role;
                                    $con->close();
                                    $stmt_select->close();
                                    $stmt_user->close();
                                    header("Location: ../../pages/admin/admin.php");
                                    exit;
                                }

                                if ($role === 'Autor') {
                                    session_start();
                                    $_SESSION['use_id'] = $use_id;
                                    $_SESSION['role'] = $role;
                                    $con->close();
                                    $stmt_select->close();
                                    $stmt_user->close();
                                    header("Location: ../../pages/layout/layout.php");
                                    exit;
                                }
                            } else {
                                session_start();
                                $_SESSION['error'] = "Error en la consulta";
                                $con->close();
                                header("Location: ../../pages/login.php");
                                exit;
                            }
                        } else {
                            session_start();
                            $_SESSION['error'] = "Error en la consulta";
                            $con->close();
                            header("Location: ../../pages/login.php");
                            exit;
                        }
                    } else {
                        session_start();
                        $_SESSION['error'] = "Error en la consulta";
                        $con->close();
                        header("Location: ../../pages/login.php");
                        exit;
                    }
                } else {
                    session_start();
                    $_SESSION['error'] = "Error en la consulta";
                    $con->close();
                    header("Location: ../../pages/login.php");
                    exit;
                }
            } else {
                session_start();
                $_SESSION['error'] = "El codigo es incorrecto";
                $con->close();
                header("Location: ../../pages/login.php");
                exit;
            }
        } else {
            session_start();
            $_SESSION['error'] = "Error en la consulta";
            $con->close();
            header("Location: ../../pages/login.php");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error'] = "Error en la consulta";
        $con->close();
        header("Location: ../../pages/login.php");
        exit;
    }
} else {
    session_start();
    $_SESSION['error'] = "No se envio el formulario.";
    header("Location: ../../pages/login.php");
    exit;
}
