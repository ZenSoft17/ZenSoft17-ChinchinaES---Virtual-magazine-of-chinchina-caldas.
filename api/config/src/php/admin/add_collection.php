<?php
// add collection

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/imagen_filter.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $title = $_POST['title'];
    $year = $_POST['year'];
    $author = $_POST['author'];
    $synopsis = $_POST['synopsis'];
    $front = processImage($_FILES['front']);
    $back = processImage($_FILES['back']);


    $sql = "INSERT INTO collection(col_id,col_front,col_back,col_title,col_year,col_author,col_synopsis) VALUES(?,?,?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('issssss', $id, $front, $back, $title, $year, $author, $synopsis);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=collection&p2=collection");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_collection'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=collection&p2=collection-add");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_collection'] = "error en la preparacion de la consulta";
        header("Location: ../../pages/admin/admin.php?p=collection&p2=collection-add");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=collection&p2=collection");
    exit;
};
