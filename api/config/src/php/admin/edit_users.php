<?php
// edit users

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/imagen_filter.php';

    $con = Connect_DB();

    $id = $_POST['id'];
    $name = $_POST['username'];
    $role = $_POST['role'];
    $email = $_POST['email'];    

    $imagen = !empty($_FILES['image']['tmp_name']) ? processImage($_FILES['image']) : null;

    if ($imagen) {
        $sql = "UPDATE users SET use_name = ?, use_email = ?, rol_id = ?, use_image = ? WHERE use_id = ?";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('ssssi', $name, $email, $role, $imagen, $id);
        }
    } else {
        $sql = "UPDATE users SET use_name = ?, use_email = ?, rol_id = ? WHERE use_id = ?";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('sssi', $name, $email, $role, $id);
        }
    }

    if ($stmt && $stmt->execute()) {
        header("Location: ../../pages/admin/admin.php?p=users");
        $stmt->close();
        $con->close();
        exit;
    } else {
        session_start();
        $_SESSION['error_users'] = "Error al ejecutar la consulta";
        header("Location: ../../pages/admin/admin.php?p=users-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=users");
    exit;
}
