<?php
// add location

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/imagen_filter.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $fair_id = $_POST['fai_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];    
    $image = processImage($_FILES['image']);


    if ($image) {
        $sql_select = "SELECT * FROM location WHERE fai_id = '$fair_id'";
        $query = mysqli_query($con, $sql_select);
        if ($query->num_rows > 1) {
            session_start();
            $_SESSION['error_location'] = "No se puede crear mas elementos de informacion";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=location");
            exit;
        } else {
            $sql = "INSERT INTO location(loc_id,fai_id,loc_title,loc_text,loc_image) VALUES(?,?,?,?,?)";
            $stmt = $con->prepare($sql);
            if ($stmt) {
                $stmt->bind_param('sssss', $id, $fair_id, $title, $description, $image);
                if ($stmt->execute()) {
                    header("Location: ../../pages/admin/admin.php?p=fair&p2=location");
                    $stmt->close();
                    $con->close();
                    exit;
                } else {
                    session_start();
                    $_SESSION['error_location'] = "error en la consulta";
                    header("Location: ../../pages/admin/admin.php?p=fair&p2=location-add");
                    exit;
                };
            } else {
                session_start();
                $_SESSION['error_location'] = "error en la preparacion de la consulta";
                header("Location: ../../pages/admin/admin.php?p=fair&p2=location-add");
                exit;
            }
        }
    } else {
        session_start();
        $_SESSION['error_location'] = "no es una imagen";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=location-add");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=location");
    exit;
};
