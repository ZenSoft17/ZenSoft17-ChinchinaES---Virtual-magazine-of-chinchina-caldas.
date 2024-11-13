<?php
// edit collection

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/imagen_filter.php';
    $con = Connect_DB();
    
    $id = $_POST['id'];
    $title = $_POST['title'];
    $year = $_POST['year'];
    $author = $_POST['author'];
    $synopsis = $_POST['synopsis'];
    $front = processImage($_FILES['front']);
    $back = processImage($_FILES['back']);

    // Preparar la consulta de actualización dependiendo de si se suben imágenes
    if ($front && $back) {
        $sql = "UPDATE collection SET col_front = ?, col_back = ?, col_title = ?, col_author = ?, col_synopsis = ? WHERE col_id = ?";
    } else if ($front) {
        $sql = "UPDATE collection SET col_front = ?, col_title = ?, col_author = ?, col_synopsis = ? WHERE col_id = ?";
    } else if ($back) {
        $sql = "UPDATE collection SET col_back = ?, col_title = ?, col_author = ?, col_synopsis = ? WHERE col_id = ?";
    } else {
        $sql = "UPDATE collection SET col_title = ?, col_author = ?, col_synopsis = ? WHERE col_id = ?";
    }

    $stmt = $con->prepare($sql);

    if ($stmt) {
        // Enlazar parámetros según las imágenes subidas
        if ($front && $back) {
            $stmt->bind_param('sssssi', $front, $back, $title, $author, $synopsis, $id);
        } else if ($front) {
            $stmt->bind_param('ssssi', $front, $title, $author, $synopsis, $id);
        } else if ($back) {
            $stmt->bind_param('ssssi', $back, $title, $author, $synopsis, $id);
        } else {
            $stmt->bind_param('sssi', $title, $author, $synopsis, $id);
        }

        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=collection&p2=collection");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_collection'] = "Error en la ejecución de la consulta";
            header("Location: ../../pages/admin/admin.php?p=collection&p2=collection-edit&id=$id");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_collection'] = "Error en la preparación de la consulta";
        header("Location: ../../pages/admin/admin.php?p=collection&p2=collection-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=collection&p2=collection");
    exit;
};
