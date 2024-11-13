<?php
// edit advertising

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/imagen_filter.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $type = $_POST['type'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $description = $_POST['description'];
    $imagen = processImage($_FILES['image']);    

    $imagen = !empty($_FILES['image']['tmp_name']) ? processImage($_FILES['image']) : null;

    if ($imagen) {
        $sql = "UPDATE contributors SET con_person_name = ?, con_nickname = ?, con_description = ?, typ_id = ?, con_image = ? WHERE con_id = ?";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('sssssi', $name, $username, $description, $type, $imagen, $id);
        }
    } else {
        $sql = "UPDATE contributors SET con_person_name = ?, con_nickname = ?, con_description = ?, typ_id = ? WHERE con_id = ?";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('ssssi', $name, $username,$description,$type,$id);
        }
    }

    if ($stmt && $stmt->execute()) {
        header("Location: ../../pages/admin/admin.php?p=advertising");
        $stmt->close();
        $con->close();
        exit;
    } else {
        session_start();
        $_SESSION['error_advertising'] = "Error al ejecutar la consulta";
        header("Location: ../../pages/admin/admin.php?p=advertising-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=advertising");
    exit;
}
