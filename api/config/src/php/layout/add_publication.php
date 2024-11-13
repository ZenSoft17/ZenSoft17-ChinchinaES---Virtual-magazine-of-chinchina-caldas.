<?php
// add publication 

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/imagen_filter.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $date = date("Y-m-d");
    $user_id = $_POST['user_id'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $category_other = $_POST['category_other'];
    $image = processImage($_FILES['image']);
    $view = $_POST['view'];    
    if($category !== '8'){
        $category_other = null;
    }
    if ($image) {
        $sql = "INSERT INTO publications(pub_id,cat_id,use_id,pub_category_other,pub_name,pub_date,pub_image,vie_id) VALUES(?,?,?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('ssssssss', $id, $category,$user_id,$category_other,$title,$date,$image,$view);
            if($stmt->execute()){
                header("Location: ../../pages/layout/layout.php");
                exit;
            } else {
                session_start();
                $_SESSION['error_layout'] = "Error en la consulta";
                header("Location: ../../pages/layout/layout.php?p=add");
                exit;
            }
        } else {
            session_start();
            $_SESSION['error_layout'] = "Error en la consulta";
            header("Location: ../../pages/layout/layout.php?p=add");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_layout'] = "El archivo no es una imagen";
        header("Location: ../../pages/layout/layout.php?p=add");
        exit;
    }
} else {
    session_start();
    $_SESSION['error_layout'] = "no se envio el formulario";
    header("Location: ../../pages/layout/layout.php");
    exit;
}
