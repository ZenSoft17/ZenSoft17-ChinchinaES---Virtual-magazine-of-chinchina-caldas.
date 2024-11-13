<?php
// add advertising

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/imagen_filter.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $type = $_POST['type'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $description = $_POST['description'];
    $imagen = processImage($_FILES['image']);

    if ($imagen) {
        $sql = "INSERT INTO contributors(con_id,typ_id,con_person_name,con_nickname,con_description,con_image) 
        VALUES(?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('ssssss', $id, $type, $name, $username, $description, $imagen);
            if ($stmt->execute()) {
                header("Location: ../../pages/admin/admin.php?p=advertising");
                $stmt->close();
                $con->close();
                exit;
            } else {
                session_start();
                $_SESSION['error_advertising'] = "error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=advertising-add");
                exit;
            }
        } else {
            session_start();
            $_SESSION['error_advertising'] = "error al preparar la consulta";
            header("Location: ../../pages/admin/admin.php?p=advertising-add");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_advertising'] = "error el archivo no es una imagen";
        header("Location: ../../pages/admin/admin.php?p=advertising-add");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=advertising");
    exit;
}
