<?php
// add users

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/imagen_filter.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $date = date("Y-m-d");
    $name = $_POST['username'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $imagen = processImage($_FILES['image']);
    
    if ($imagen) {
        $sql_select  = "SELECT * FROM users WHERE use_email = '$email'";
        $query_select = mysqli_query($con, $sql_select);
        if ($query->num_rows > 0) {
            session_start();
            $_SESSION['error_users'] = "error el correo ya existe";
            header("Location: ../../pages/admin/admin.php?p=users-add");
            exit;
        } else {
            $sql = "INSERT INTO users(use_id,rol_id,use_name,use_password,use_email,use_date,use_image) 
            VALUES (?,?,?,?,?,?,?)";
            $stmt = $con->prepare($sql);
            if ($stmt) {
                $stmt->bind_param('sssssss', $id, $role, $name, $pass, $email, $date, $imagen);
                if ($stmt->execute()) {
                    header("Location: ../../pages/admin/admin.php?p=users");
                    $stmt->close();
                    $con->close();
                    exit;
                } else {
                    session_start();
                    $_SESSION['error_users'] = "error en la consulta";
                    header("Location: ../../pages/admin/admin.php?p=users-add");
                    exit;
                };
            } else {
                session_start();
                $_SESSION['error_users'] = "error en la preparacion de la consulta";
                header("Location: ../../pages/admin/admin.php?p=users-add");
                exit;
            }
        }
    } else {
        session_start();
        $_SESSION['error_users'] = "error el archivo no es una imagen";
        header("Location: ../../pages/admin/admin.php?p=users-add");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=users");
    exit;
};
