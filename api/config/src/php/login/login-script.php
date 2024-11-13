<?php

//  submit 1
if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/mailer.php';
    $con = Connect_DB();
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $sql = "SELECT use_password, use_name, use_id FROM users WHERE use_email = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('s', $email);
        if ($stmt->execute()) {
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($hash, $name, $use_id);
                $stmt->fetch();
                if (password_verify($password, $hash)) {
                    $code = str_pad(random_int(0, 99999999), 6, '0', STR_PAD_LEFT);
                    $subject = 'Codigo de verificacion';
                    if (Mailer($email, $name, $subject, $code)) {
                        $sql_code = "INSERT INTO codes(cod_id,use_id) VALUES (?,?)";
                        $stmt_insert = $con->prepare($sql_code);
                        if ($stmt_insert) {
                            $stmt_insert->bind_param('ss', $code, $use_id);
                            if ($stmt_insert->execute()) {
                                session_start();
                                $_SESSION['login_status'] = true;
                                $con->close();
                                $stmt_insert->close();
                                $stmt->close();
                                header("Location: ../../pages/login.php");
                                exit;
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
                        $_SESSION['error'] = "No se encontro el correo y no envio el código de verificación";
                        $con->close();
                        header("Location: ../../pages/login.php");
                        exit;
                    }
                } else {
                    session_start();
                    $_SESSION['error'] = "La contraseña es incorrecta.";
                    $con->close();
                    header("Location: ../../pages/login.php");
                    exit;
                }
            } else {
                session_start();
                $_SESSION['error'] = "El usuario no existe.";
                $con->close();
                header("Location: ../../pages/login.php");
                exit;
            }
        } else {
            session_start();
            $_SESSION['error'] = "Error en la operacion.";
            $con->close();
            header("Location: ../../pages/login.php");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error'] = "El usuario no existe.";
        $con->close();
        header("Location: ../../pages/login.php");
        exit;
    }
} else {
    session_start();
    $_SESSION['error'] = "No se envio el formulario.";
    $con->close();
    header("Location: ../../pages/login.php");
    exit;
}
